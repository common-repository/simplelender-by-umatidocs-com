<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class AdminSimplelenderClientloannotesController extends MvcAdminController {
    
    var $default_columns = array('id', 'name');
    
	public function index() {
		do_action("simplelender_lender_quote");	
		do_action("simplelender_welcome_lender");				
	}

	public function settings_one() {
		if (!empty($this->params['data']) && !empty($this->params['data'])) {
	            $object = $this->params['data'];
	        
			if (empty($object['id'])) {
				$this->model->create($this->params['data']);
				$id = $this->model->insert_id;
				$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'settings_two', 'id' => $id));
				$this->flash('notice', 'Almost Done...');
				$this->redirect($url);
	        }
		}				
	}

	public function settings_two() {
		if (!empty($this->params['data'])) {
           
           if ($this->model->save($this->params['data'])) {
			$this->flash('notice', 'Done!');
				$this->refresh();
		  } else {
			$this->flash('error', $this->model->validation_error_html);
		  }
		}

		$this->set_object();					
	}
	
}

?>