<?php
	if ( simplelender_fs()->is_plan('growth') ) {
	require_once dirname(__FILE__).'/simplelender_merge_tags.php';
	
	function simplelender_replace_tags($param=''){
	    return simplelender_class('simplelender_merge_tags')->replace_tags_with_values($param);
	}

	class simplelender_events_manager{
	    public function init(){
	            add_action('simplelender_process_pending_events', array($this, 'simplelender_process_pending_events'),1,1);
	            $this->initialize_triggers();            
	            simplelender_class('simplelender_merge_tags')->init();
		}
		
	    public function initialize_triggers(){
			$simplelenderWebhook = mvc_model('simplelenderWebhook')->find(array('conditions'=>array(
	                    'notification_is_active '=> true,
			)));
			
	        foreach($simplelenderWebhook as $single_hook){
	            if(isset($single_hook->webhook_trigger_action) && is_string($single_hook->webhook_trigger_action)){
	                $webhook_object = $single_hook;
	                //custom action runner e.g. simplelender_signup , Add the acion by adding a notification.
	                add_action($single_hook->webhook_trigger_action, function($sl_data) use ($webhook_object){
	                    $this->schedule_an_event($webhook_object,$sl_data);                             
	                }, 10,1);
	            }
			}
		}

	    public function set_up_hook_data($single_hook_object,$data){
	    	$args=[
				'mail'=>[
					'recipients'=> $this->get_mail_recipient($single_hook_object,$data),
					'content'=>[
						'subject'=>simplelender_replace_tags(array('data_text' => $single_hook_object->mail_subject, 'data'=> $data)),
						'content'=>simplelender_replace_tags(array('data_text' => $single_hook_object->mail_body, 'data'=> $data))
					],
					'mail_active'=>$single_hook_object->mail_active,
				]
			];
			
			return $args;
		}
		
	    public function schedule_an_event($single_hook='',$data=''){
	        
	        $number_of_times_event_was_trigger = $single_hook->number_of_times_event_was_trigger;
	        $number_of_times_event_was_trigger++;
	        //log when a webhook has run, e.g. 'simplelender_signup'
			mvc_model('simplelenderWebhook')->update( $single_hook->id,array(           
				'last_time_event_is_triggered'=> date('Y-m-d H:i:s'),
				'number_of_times_event_was_trigger' =>$number_of_times_event_was_trigger
				));
				
			$webhook_event_id = mvc_model('simplelenderWebhookEvent')->create(array(
				'webhook_id'=>$single_hook->id,
				'args'=>maybe_serialize($this->set_up_hook_data($single_hook,$data))
			));

			$single_hook_data=$this->set_up_hook_data($single_hook,$data);
			
			$simplelenderWebhookEventdata=maybe_unserialize(mvc_model('simplelenderWebhookEvent')->find_by_id($webhook_event_id)->args);
	        
	        $timestamp = time();
	        $hook = 'simplelender_process_pending_events';
	        $args = array($webhook_event_id);
	        $group = 'simplelender_pending_events';

	        as_schedule_single_action( $timestamp , $hook , $args , $group );
	    }
	    
	    public function retry_processing_failed_events() {
	        $webhook_events_to_be_retried = mvc_model('simplelenderWebhookEvent')->find(array('conditions'=>array(
				'processed_successfully'=>3
	        )));

	        $log_results='';
	        $number_of_failed_results=0;

	        foreach ($webhook_events_to_be_retried as $single_event) {
	            $arg = maybe_unserialize($single_event->args);
	            //retry notifications
	            if( $arg['mail']['mail_active'] > 0 ){
	                $send_mails_success = $this->send_mails($arg['mail']);
	            }
	            if( $arg['webhook']['webhook_active'] > 0 ){
	                $send_arg_success = $this->send_arg($arg['webhook']);
	            }
	            
	            if($send_mails_success == true && $send_arg_success == true){
	            	//create log - successful & update webhook event 3 -> successful	
	            
	                $log_results.='Webhook event id '.$single_event->id.': Successful <br>';
	            }
	            else {
	                $simplelenderWebhook = mvc_model('simplelenderWebhook')->find_by_id($single_event->webhook_id);
	                $unsuccessful_attempts_to_send_webhook=	$simplelenderWebhook->unsuccessful_attempts_to_send_webhook;
	                $unsuccessful_attempts_to_send_webhook++;
	                mvc_model('simplelenderWebhook')->save(array(
	                    'id'=> $simplelenderWebhook->id,
	                    'unsuccessful_attempts_to_send_webhook'=>$unsuccessful_attempts_to_send_webhook
	                    ));
	                $log_results.='Webhook event id '.$single_event->id.': Failed <br>';
	                $number_of_failed_results++;
	           }
	        }
	        
	        $number_of_failed_results= 'Resend succesfully executed, there are <b>'.$number_of_failed_results.'</b>  failed events<br>'.$log_results;

	        return $number_of_failed_results;
	    }
		
	    public function simplelender_process_pending_events($args=''){
	        //get webhook event
	        $webhook_event = mvc_model('simplelenderWebhookEvent')->find_by_id($args);
	    
			//if : successfully_processed is not processed or retry: -> process
	        //do process
	        $arg = maybe_unserialize($webhook_event->args);
	        if( $arg['mail']['mail_active'] > 0 ){
	            $send_mails_success = $this->send_mails($arg['mail']);
	        }
			
	        if($send_mails_success == true && $send_arg_success == true){
	        	//create log - successful & update webhook event 3 -> successful
				$this->record_success_attempt_to_do_notification(['webhook_event_object'=>$webhook_event]);
	        }
			else{
				//create log - failiar
				$this->record_failed_attempt_to_do_notification(['webhook_event_object'=>$webhook_event]);
			}
		}
		
	    public function record_failed_attempt_to_do_notification($specific_args){
			$args=[
				'success_log'=> false,
				'webhook_event_webhook_event_object'=> $specific_args['webhook_event_object'],
				'webhook_event_webhook_id'=> $specific_args['webhook_event_object']->webhook_id,
				'number_of_retrys' => mvc_model('simplelenderWebhookLog')->count(array('webhook_id'=>$specific_args['webhook_event_id']->webhook_id)),
				'simplelenderWebhookEvent_processed_successfully'=>3,
			];
		
			//update webhook event
			$this->record_webhook_event($args);
			//update webhook
			$this->record_webhook_stats($args);
			//create log - failed (new or update)
			$this->record_log($args);
		}
		
		public function record_success_attempt_to_do_notification($specific_args){
			$args=[
				'success_log'=> true,
				'webhook_event_webhook_event_object'=> $specific_args['webhook_event_object'],
				'webhook_event_webhook_id'=> $specific_args['webhook_event_object']->webhook_id,
				'number_of_retrys' => mvc_model('simplelenderWebhookLog')->count(array('webhook_id'=>$specific_args['webhook_event_id']->webhook_id)),
				'simplelenderWebhookEvent_processed_successfully'=>2,
			];
		
			//update webhook event
			$this->record_webhook_event($args);
			//update webhook
			$this->record_webhook_stats($args);
			//create log - failed (new or update)
			$this->record_log($args);
		}
		
		public function record_log($args){ 
			$retry=0;
			if( $args['number_of_retrys'] > 0 ){
					$retry=1;
				}
			
	        mvc_model('simplelenderWebhookLog')->create(array(
	            'webhook_event_id' => $webhook_event->id,
	            'successful'=>2,
	            'retry'=>$retry,
	            'log_type'=>1,
	            'timestamp'=>date('Y-m-d H:i:s'),
	            'finally_done'=>0,
				'webhook_id'=>$args['webhook_event_object']->webhook_id
	            ));
		}
		
		public function record_webhook_event($args){
			mvc_model('simplelenderWebhookEvent')->update($args['webhook_event_id'],array(
	                'processed_successfully'=>$args['simplelenderWebhookEvent_processed_successfully'] //failed 
	                )); 
		}
		
		public function record_webhook_stats($args){
			//unsuccessful_attempts_to_send_webhook
	        $simplelenderWebhook=mvc_model('simplelenderWebhook')->find_by_id($args['webhook_event_webhook_id']);
	        $unsuccessful_attempts_to_send_webhook=	$simplelenderWebhook->unsuccessful_attempts_to_send_webhook;
			$number_of_times_event_was_trigger =	$simplelenderWebhook->number_of_times_event_was_trigger ;
	        $number_of_times_event_was_trigger++;
			
			if(!$args['success_log']){
				$unsuccessful_attempts_to_send_webhook++;
			}
			
			mvc_model('simplelenderWebhook')->update($simplelenderWebhook->id,array(
				'unsuccessful_attempts_to_send_webhook'=>$unsuccessful_attempts_to_send_webhook,
				'last_time_event_is_triggered'=>date('Y-m-d H:i:s'),
				'number_of_times_event_was_trigger'=>$number_of_times_event_was_trigger
				));
		}
		
	    public function send_mails($single_hook_data_mail){
			$simplelenderMailRecipient = $single_hook_data_mail['recipients'];
			
			$recipient_arr=[];
			foreach($simplelenderMailRecipient as $single_recipient){
	        	array_push($recipient_arr,$single_recipient['recipient']);
			}
			
	        $recipient_arr=implode(',',$recipient_arr);
	        $headers  = 'MIME-Version: 1.0' . "\r\n";
	        $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
	        $headers .= 'From: no_reply@'.$_SERVER['HTTP_HOST'] . "\r\n";
			$email_sent= wp_mail( $recipient_arr, $single_hook_data_mail['content']['subject'] , $single_hook_data_mail['content']['content'],$headers);		
		}

		public function get_email_address($single_recipient){
			if( $single_recipient['type']=='email' ){
				return $single_recipient['recipient'];
			}
		}

		/*
		*
		*	 @todo : Add add a separate plugin to kep things light
		*
		*/
		public function send_arg($single_hook_data){
	        $response='';
	        foreach($single_hook_data['urls'] as $single_url){ 
	                $response= wp_remote_post($single_url['url'],array(
	                            'method'=>$single_url['type'],
	                            'timeout'=>45,
	                            'redirect'=>5,
	                            'httpversion'=>'1.0',
	                            'blocking'=>true,
	                            'headers'=> array(),
	                            'body'=>  $single_hook_data['body_args'],
	                    ));
	                    	
	                    if(is_wp_error($response)){
							$error_message = $response->get_error_message();
							error_log("Something went wrong: ". $error_message );
	                    }
			}
			if (isset($response)) {
				mvc_model('simplelenderWebhookEvent')->create(array(
				'webhook_id'=>88,
				'args'=> maybe_serialize($response)
				));
			}
		}
		
		/*
		*
		*	 Return an array of args - default type is body. the alternative would be a header.
		*
		*/
		public function get_webhook_args($single_hook,$type='body'){
			$simplelenderWebhookArgs = mvc_model('simplelenderWebhookArgs')->find(array('conditions'=>array(
				'webhook_id'=> $single_hook->id,
				'type'=>$type,
			)));
			$arr_args=[];
		
			foreach($simplelenderWebhookArgs as $single_arg){
				switch($single_hook->args_encoding){
					case '1':
						$single_arg_value = $single_arg->value;
					break;
					case '2':
						$single_arg_value = json_encode($single_arg->value);
					break;
					case '3':
						$single_arg_value='';
					break;
				}
				array_push($arr_args, array( $single_arg->key_name => $single_arg_value));
			}
			
			return $arr_args;
		}
		
		/*
		*
		*	 Return an array of webhook urls.
		*
		*/
		public function get_webhook_url($single_hook){
			$simplelenderWebhookUrl = mvc_model('simplelenderWebhookUrl')->find(array('conditions'=>array(
				'webhook_id'=> $single_hook->id,
			)));
			$arr_urls=[];
		
			foreach($simplelenderWebhookUrl as $single_url){
				array_push($arr_urls, array( "type"=>$single_url->type, "url" => $single_url->url));
			}
			
			return $arr_urls;
		}
		
		/*
		*
		*	 Return an array of webhook urls.
		*
		*/
		public function get_mail_recipient($single_hook, $data){
			$simplelenderMailRecipient = mvc_model('simplelenderMailRecipient')->find(array(
				'conditions'=>array(
					'webhook_id'=> $single_hook->id,
					)));
			$arr_mail_recipient=[];
		
			foreach($simplelenderMailRecipient as $single_mail_recipient){
				array_push($arr_mail_recipient, array( 
					'type'=>$single_mail_recipient->type,
					'recipient' => simplelender_replace_tags(array(
							'data_text' => $single_mail_recipient->recipient, 
							'data'=> $data
							)
						) 
					)
				);
			}
			
			return $arr_mail_recipient;
		}
	        
	    public function WebhookLog_unsuccessful_count($webhook_id) {
	        $simplelenderWebhookLog_unsuccessful_count=0;
	        
	        $simplelenderWebhookEvent_unsucessful = mvc_model('simplelenderWebhookEvent')->find(array('conditions'=>array(
	                'processed_successfully'=>3,
	                'webhook_id'=>$webhook_id,
	            )));

	        foreach ($simplelenderWebhookEvent_unsucessful as $value) {
	                $simplelenderWebhookLog_unsuccessful_count= 1+ mvc_model('simplelenderWebhookLog')->count(array('conditions'=>array(
	                    'webhook_event_id' => $value->id,
	                )));
	            }
	        
			return $simplelenderWebhookLog_unsuccessful_count;
	    }
	    
	} 
}
?>