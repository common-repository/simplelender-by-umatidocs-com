<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class simplelenderClientloansController extends MvcPublicController {
	
	var $default_columns = array('id', 'name');
	var $before = array('form_manager');
	
	public function form_manager(){
		$this->load_helper('form');
	}
    
    public function index() {
		if(is_user_logged_in()){
			$client_id=mvc_model('simplelenderClientaccount')->find_one(['conditions'=>['wp_user_id'=>get_current_user_id()]])->id;
			if(isset($client_id)){
				if(simplelender_class('simplelender_gravity_form_manager')->there_is_an_active_session()){
					simplelender_class('simplelender_gravity_form_manager')->connect_loan_to_user();
				}
				
				$this->set([
					'objects'=> mvc_model("simplelenderClientloan")->find(['conditions'=>['client_id'=>$client_id]]),
					'client_id'=>$client_id
					]);
			}
			else{
				//create borrower account with details
				$client_id=simplelender_class('simplelender_account')->create_borrower_for_wp_user();
				
				$this->set([
					'objects'=> mvc_model("simplelenderClientloan")->find(['conditions'=>['client_id'=>$client_id]]),
					'client_id'=>$client_id
					]);
			}			
		}
		else{
			$this->set('objects','show_login');
		}
	}

	public function display_form(){

	}
	
	public function add() {		
		
		$url = mvc_public_url(array('controller' => $this , 'action' => 'display_gravity', 'id' => $id));			
		$this->redirect($url);
		
		$this->model=mvc_model("wploancrmClientloan");
		if (!empty($this->params['data'])) {
			var_dump($this->params['data']);
		  $object = $this->params['data'];
			$this->params['data']['simplelenderClientloan']['gravity_entry_id'] = 33;
			$this->params['data']['simplelenderClientloan']['loan_stage'] = 1 ;
			$this->params['data']['simplelenderClientloan']['client_id'] = "no_acc";
			
			$this->params['data']['simplelenderClientloan']['waiting_id'] = 1;
			
			$this->model->create($this->params['data']);
			$id = $this->model->insert_id;
			
			if(!isset($__SESSION["application_process"])){
				$__SESSION["application_process"]["id"]=$id;
				$__SESSION["application_process"]["stage"]=2;
			}
			
			$url = mvc_public_url(array('controller' => $this , 'action' => 'edit', 'id' => $id));			
			
			$this->flash('notice', 'Successfully created!');
			$this->redirect($url);
		
		}		
		
		$this->set('loan_setting_id',1);
		$this->set('loan_setting',mvc_model('simplelenderLoansetting'));
		$this->set('loan_stage',mvc_model('simplelenderClientloanstage'));
		$this->set('client_id',mvc_model('MvcUser'));
	}
	
	public function transaction() {
		$this->set("loan_id_transaction",$this->params['id']);
		$this->set("objects", mvc_model("simplelenderDentry")->find(array('conditions'=>array('trans_type'=>'1','trans_id'=>$this->params['id'],'bs_account'=>6))));
	}
	
	public function notification(){
		if(is_user_logged_in()){
			$client_id = mvc_model('simplelenderClientaccount')->find_one(['conditions'=>['wp_user_id'=>get_current_user_id()]])->id;
			$objects = mvc_model('simplelenderNotification')->find([
				'conditions'=>[
					'status'=>1 ,
					'user_id'=>$client_id],
				'order' => 'id DESC',

				]);
			foreach ($objects as $key => $value) {
				mvc_model('simplelenderNotification')->update($value->id,['status'=>2]);
			}
			
			$this->set([
				'objects'=>$objects,
				'client_id'=>$client_id,
			]);
		}
		else{
			$this->set('objects','show_login');
		}
	}

	public function complete_application(){
		$this->set('loan_product_id', $this->params['id']);		
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