<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class AdminSimplelenderClientaccountsController extends MvcAdminController {
    
    var $default_columns = array('id', 'name');
    public $before = ['domenu'];

    public function domenu() {
        $menu_html="";
        $menu_html.="<div class='sl_menu_html'><ul class='subsubsub'>";
        $menu_html.= "<li> <a href=".mvc_admin_url(array('controller' => 'admin_simplelender_clientaccounts', 'action' => '',)).">All Borrower(s)</a></li>";
        $menu_html.= "<li> | <a href=".mvc_admin_url(array('controller' => 'admin_simplelender_clientaccounts', 'action' => 'add',)).">Create a Borrower</a> </li>";
        $menu_html.= "<li> | <a href=".mvc_admin_url(array('controller' => 'admin_simplelender_clientloans', 'action' => '',)).">All Loan Applications</a> </li>";
        $menu_html.="</ul></div>";

        echo $menu_html;
    }
	
	public function index() {
		do_action("simplelender_welcome_lender");
		$objects = $this->model->find();
		$this->set_objects();
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
	
	public function edit() {
		if (!empty($this->params['data']) ) {
		  $object = $this->params['data']['traffic_managers'];
		  if ($this->model->save($this->params['data'])) {
			$this->flash('notice', 'Successfully saved!');
			$this->refresh();
		  } else {
			$this->flash('error', $this->model->validation_error_html);
		  }
		}
		$this->set_object();
		
		$this->set('loan_setting',mvc_model('simplelenderLoansetting'));
		$this->set('client_id',mvc_model('MvcUser'));
	}
	
	public function process() {
		if (!empty($this->params['data']) ) {
		  //if approval do accounting
		  $Clientloan_data = $this->params['data']['simplelenderClientloan'];
		  $original_loan_stage = mvc_model('simplelenderClientloan')->find_by_id($Clientloan_data['id'])->loan_stage;
		  if($Clientloan_data['loan_stage']!== $original_loan_stage){
			if($Clientloan_data['loan_stage']==4){
                            simplelender_class('simplelender_loan')->approve_loan($Clientloan_data["id"]);
			}
		  }
		  
		  if ($this->model->save($this->params['data'])) {
			$tell_them = '';
			simplelender_class('simplelender_talk')->notity($tell_them);
			$this->flash('notice', 'Successfully Processed!');			
			$this->refresh();
		  } else {
			$this->flash('error', $this->model->validation_error_html);
		  }
		  
		}
		
		$this->set_object();
		$this->set('loan_stage',mvc_model('simplelenderClientloanstage'));
	}
	
	public function grouplink() {
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