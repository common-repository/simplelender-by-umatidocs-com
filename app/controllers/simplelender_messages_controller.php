<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class simplelenderMessagesController extends MvcPublicController {
    
    var $default_columns = array('id', 'name');
    
	
	public function index() {
		do_action("simplelender_welcome_lender");
		$this->set('objects', mvc_model("simplelenderTicket")->find([
				'conditions'=>['client_id'=>mvc_model('simplelenderClientaccount')->find_one(['conditions'=>['wp_user_id'=>get_current_user_id()]])->id
			]]));
		
	}

	public function message_room() {
		if(is_user_logged_in()){
			$simplelenderTicket=mvc_model("simplelenderTicket")->find_by_id($this->params['id']);
			$this->set(array(
					'objects'=> mvc_model("simplelenderMessage")->find(array('conditions'=>array('ticket_id'=>$this->params['id']))),
					'ticket'=>[
						'number'=>$simplelenderTicket->ticket_id,
						'id'=>$this->params['id'],
						'loan_id'=>$simplelenderTicket->loan_id,
						'status'=>$simplelenderTicket->status,
						'sender_id'=>mvc_model('simplelenderClientaccount')->find_one(['conditions'=>['wp_user_id'=>get_current_user_id()]])->id
					]
			));
		}
		else{
			$this->set('objects','show_login');
		}
	} 
	
	public function create_ticket() {
		if(is_user_logged_in()){
			$id = mvc_model("simplelenderTicket")->create(['simplelenderTicket'=>[
					'loan_id'=>$this->params['id'],
					'ticket_id'=>'T'.time(),
					'status'=>1,
					'creation_time'=>date("Y-m-d H:i:s"),
					'client_id'=>mvc_model('simplelenderClientaccount')->find_one(['conditions'=>['wp_user_id'=>get_current_user_id()]])->id
				]]);
			$url = MvcRouter::public_url(array('controller' => 'simplelender_messages', 'action' => 'message_room', 'id' => $id));
			$this->flash('notice', 'Leave admin a note :)');
			$this->redirect($url);
		}
		else{
			$this->set('objects','show_login');
		}
	}
	
	public function delete() {
		$this->set_object();
		if (!empty($this->object)) {
		  $this->model->delete($this->params['id']);
		  $this->flash('notice', 'Successfully deleted!');
		} else {
		  $this->flash('warning', 'An Error Message with ID "'.$id.'" couldn\'t be found.');
		}
		$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'index'));
		$this->redirect($url);
	}
    
}

?>