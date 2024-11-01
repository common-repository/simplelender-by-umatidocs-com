<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class AdminSimplelenderMailchimpsController extends MvcAdminController {
    
    var $default_columns = array('id', 'name');
    public $before = ['domenu'];
		
	    public function domenu() {
	    	if(simplelender_fs()->is_plan('growth')){
		        $menu_html="";
		        $menu_html.="<div class='simplelender_menu_html'><center><ul class='subsubsub'>";
				$menu_html.='<div><span class="" >';
				$menu_html.= "<li> <a href=".mvc_admin_url(array('controller' => 'admin_simplelender_messages', 'action' => 'index',)).">Ticketing</a> </li>";
				$menu_html.= '<li>| <a href="'.mvc_admin_url(array("controller" => "simplelender_webhooks", "action" => "index", "id" =>"" )).'">All Custom Email(s)</a></li>';
	  			$menu_html.= "<li>| <a href=".mvc_admin_url(array('controller' => 'admin_simplelender_mailchimps', 'action' => 'index',)).">Mailchimp Settings</a></li>";
		        $menu_html.="</ul></div></center></div>";
		    }
		    else{
		    	$menu_html='';
		    }

	        echo $menu_html;
	}
    
	public function index() {
		do_action("simplelender_lender_quote");	
		do_action("simplelender_welcome_lender");				

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