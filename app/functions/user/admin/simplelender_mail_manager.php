<?php
	if ( simplelender_fs()->is_plan('growth') ) {
	class simplelender_mail_manager{
		public function init(){
			add_action("wp_ajax_simplelender_delete_recipient",  array($this, "delete_recipient"))	;	
		}
		
		public function show_main_view($webhook_id){
	            $show_main_view=$this->list_recipients($webhook_id);
	            $show_main_view.=$this->add_recepient($webhook_id);
			
	            return $show_main_view;
		}
		
		
		public function delete_recipient(){
			
			echo json_encode(["deleted_recipient"=>mvc_model('simplelenderMailRecipient')->delete($_POST['simplelender_recipient_id'])]);
				
			wp_die();		
		}
		
		public function list_recipients($webhook_id=0){
			$simplelender_next_recipient_node=0;
			$simplelenderMailRecipient=[];
			if($webhook_id>0){
				$simplelenderMailRecipient = mvc_model('simplelenderMailRecipient')->find(array(
					'conditions'=>array(
						'webhook_id'=>$webhook_id,
					)));
			}
			
			$Recipientlist	=	'<table>';
			$Recipientlist .= 	'<tr><td><b>Recipient Type</b></td><td><b>Recipient Details</b></td></td><td></td></tr>';
	            
			if(count($simplelenderMailRecipient)>0){
	            foreach($simplelenderMailRecipient as $Recipient){
					$Recipientlist .= '<tr id="simplelender_main_row_recipient_'.$simplelender_next_recipient_node.'"><td>
					<select name="more_data[simplelenderMailRecipient]['.$simplelender_next_recipient_node.'][type]" type="text" value="'.$Recipient->type.'" class="simplelender_input_feild">
						<option value=""></option>
						<option value="email" selected="selected">Email</option>
					</select>
					</td><td><input id="" name="more_data[simplelenderMailRecipient]['.$simplelender_next_recipient_node.'][recipient]" type="text" value="'.$Recipient->recipient.'" class="simplelender_input_feild"><input id="simplelender_id_recipient_'.$simplelender_next_recipient_node.'" name="more_data[simplelenderMailRecipient]['.$simplelender_next_recipient_node.'][id]" type="hidden" value="'.$Recipient->id.'" class="simplelender_input_feild"></td><td><center><span class="simplelender_close_recipient_class" id="simplelender_close_recipient_'.$simplelender_next_recipient_node.'">[X]</span></center></td></tr><br>';
					$simplelender_next_recipient_node++;
	            }
			}
			else{
				$Recipientlist .= '<tr><td>Please add a recipient </td><td></td></tr>';
			}
			$Recipientlist .= '<tr id="simplelender_additional_mail_recipient"><script type="text/javascript">simplelender_next_recipient_node='.$simplelender_next_recipient_node.'</script></tr><br>';
			return $Recipientlist;
		}
		
		public function add_recepient($webhook_id){
			$Recipientform = '<tr><td></td><td></td></td><td><input type="submit" value="Add Recipient" id="simplelender_add_recipient_node" class="simplelender_add_node"></td></tr>';
			$Recipientform .= '</table><br>';
			return $Recipientform ;
		}
	}
}
?>