<?php
	class AdminSimplelenderWebhooksController extends MvcAdminController {
	    
	    var $default_columns = array('id', 'name');
		public $before = ['domenu'];
		
	    public function domenu() {
	    	if(simplelender_fs()->is_plan('growth')){
		        $menu_html="";
		        $menu_html.="<div class='simplelender_menu_html'><center>";
				$menu_html.='
					<div>
						<span class="" >';
						$menu_html.= " <a class='wp-core-ui button-primary' href=".mvc_admin_url(array('controller' => 'admin_simplelender_messages', 'action' => 'index',)).">Ticketing</a>";
						$menu_html.= ' <a class="wp-core-ui button-primary"  href="'.mvc_admin_url(array("controller" => "simplelender_webhooks", "action" => "index", "id" =>"" )).'">All Custom Email(s)</a>';
	  					$menu_html.= " <a class='wp-core-ui button-primary' href=".mvc_admin_url(array('controller' => 'admin_simplelender_mailchimps', 'action' => 'index',)).">Mailchimp Settings</a>";
		        $menu_html.="</div></center></div>";
		    }
		    else{
		    	$menu_html='';
		    }

	        echo $menu_html;
	    }
		
		public function index(){
			do_action("simplelender_welcome_lender");
		
			if ( simplelender_fs()->is_plan('growth') ) {
				$this->set('objects', mvc_model("simplelenderWebhook")->find());
			}
			else{			
				$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'go_pro'));
				$this->flash('notice', 'Wow! You have come this far, thank you for choosing us, so this is a paid area.<br> It helps us build cool features faster and better, your support to the work goes a long way');
				$this->redirect($url);
			}	
		}
		public function go_pro(){
			
		}

		public function add() {
			if (!empty($this->params['data']) && !empty($this->params['data'])) {
			  $object = $this->params['data'];
			  $more_data=$this->params['more_data'];
			  if (empty($object['id'])) {
				 
				$this->model->create($object);
				$id = $this->model->insert_id;
				$this->save_additional_data($more_data,$id );
				$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'edit', 'id' => $id));
				$this->flash('notice', 'Successfully created!');
				$this->redirect($url);
			 }
			}
		}
		
		public function save_additional_data($more_data,$id ){
			if (is_array($more_data)) {				
				foreach($more_data as $key=>$value){
						if (is_array($value)) {	
						foreach($value as $single){
							$single['webhook_id']=$id;
							mvc_model($key)->save($single);
						}
					}
				}
			}
		}
	  
		public function edit() {
			if (!empty($this->params['data'])) {
			  $object = $this->params['data'];
			  $object['simplelenderWebhook']['last_modified'] = date('Y-m-d H:i:s');
			  if ($this->model->save($object)) {
				$more_data=$this->params['more_data'];
				$id=$object['simplelenderWebhook']['id'];
				$this->save_additional_data($more_data,$id );
				
				$this->flash('notice', 'Successfully saved!');
				$this->refresh();
			  } else {
				$this->flash('error', $this->model->validation_error_html);
			  }
			}
			$this->set_object();		
		}
		
		public function resend_failed_webhook(){
			$id = $this->params['id'];
			$retry_processing_failed_events = simplelender_class('simplelender_events_manager')->retry_processing_failed_events($id);
			
			//redirect to edit with 
			$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'edit', 'id' => $id));
			$this->flash('notice', $retry_processing_failed_events );
			$this->redirect($url);
		}
		
		public function view_logs(){
			$this->set('objects', mvc_model('simplelenderWebhookLog')->find(array("conditions"=>array("webhook_id"=>$this->params['id'],))));
		}
		
	}
?>