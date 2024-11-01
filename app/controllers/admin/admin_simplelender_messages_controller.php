<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class AdminSimplelenderMessagesController extends MvcAdminController {
    
    var $default_columns = array('id', 'name');
    public $before = ['domenu'];

    public function domenu() {
        
        if(simplelender_fs()->is_plan('growth')){
		        $menu_html="";
		        $menu_html.="<div class='sl_menu_html'><center><ul class='subsubsub'>";
		        $menu_html.= "<li> <a href=".mvc_admin_url(array('controller' => 'admin_simplelender_messages', 'action' => '',)).">Tickets</a></li>";
		        $menu_html.= "<li>| <a href=".mvc_admin_url(array('controller' => 'admin_simplelender_webhooks', 'action' => 'index',)).">Custom eMails</a></li>";
		        $menu_html.= "</li>| <a href=".mvc_admin_url(array('controller' => 'admin_simplelender_mailchimps', 'action' => 'index',)).">Mailchimp Settings</a></li>";
		        
		        $menu_html.="</center></div>";

		    }
		    else{
		    	$menu_html='';
		    }
		    
	        echo $menu_html;
    }
	
	public function index() {
		do_action("simplelender_welcome_lender");
		
		if ( simplelender_fs()->is_plan('growth') ) {
			$this->set('objects', mvc_model("simplelenderTicket")->find());
		}
		else{			
			$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'go_pro'));
			$this->flash('notice', 'We are happy to be of service to you, <b>Comminicate & follow up on leads like a pro.</b>');
			$this->redirect($url);
		}		
	}

	public function go_pro(){
			
	}

	public function unresolved_index() {
		$this->set('objects', mvc_model("simplelenderTicket")->find(['conditions'=>['status'=>1]]));	
	}

	public function message_room() {
		$simplelenderTicket=mvc_model("simplelenderTicket")->find_by_id($this->params['id']);
		$this->set(array(
				'objects'=> mvc_model("simplelenderMessage")->find(array('conditions'=>array('ticket_id'=>$this->params['id']))),
				'ticket'=>[
					'number'=>$simplelenderTicket->ticket_id,
					'id'=>$this->params['id'],
					'loan_id'=>$simplelenderTicket->loan_id,
					'status'=>$simplelenderTicket->status
				]
			));
	}
	
	public function add() {
		if (!empty($this->params['data']) && !empty($this->params['data'])) {
		  $object = $this->params['data'];
		  if (empty($object['id'])) {
			$this->model->create($this->params['data']);
			$id = $this->model->insert_id;
			$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'edit', 'id' => $id));
			$this->flash('notice', 'Successfully created!');
			$this->redirect($url);
		 }
		}
		$this->set('loan_setting',mvc_model('simplelenderLoansetting'));
		$this->set('client_id',mvc_model('MvcUser'));
	}
	
	public function mark_as_resolved() {
		if (mvc_model("simplelenderTicket")->save(['id'=>$this->params['id'],'status'=>2,'close_time'=>date("Y-m-d H:i:s")])) {
			$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'message_room', 'id' => $this->params['id']));
			$this->flash('notice', 'Ticket has been marked as resolved!');
			$this->redirect($url);
		} else {
			$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'message_room', 'id' => $this->params['id']));
			$this->flash('error', $this->model->validation_error_html);
			$this->redirect($url);
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