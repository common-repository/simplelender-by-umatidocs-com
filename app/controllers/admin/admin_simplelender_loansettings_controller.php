<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class AdminSimplelenderLoansettingsController extends MvcAdminController {
    
    var $default_columns = array('id', 'name');
    public $before = ['domenu'];

    public function domenu() {
        $menu_html="";
        $menu_html.="<div class='sl_menu_html'>";
        $menu_html.= "<ul class='subsubsub'><li><a class='' href=".mvc_admin_url(array('controller' => 'admin_simplelender_loansettings', 'action' => '',)).">All Products</a> ";
        $menu_html.= " </li><li> |<a class='' href=".mvc_admin_url(array('controller' => 'admin_simplelender_loansettings', 'action' => 'add',)).">New Product</a></li></ul>";
        $menu_html.="</div>";

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
				$this->flash('notice', 'Successfully saved! <br>IMPORTANT: You need to go to Settings > Permalinks and click “save” to avoid getting a 404 page. <br>Use the shortcodes below to start accepting loan applications and user account creation<br> Getting started documentation <b>:</b> <a href = "https://wordpress.org/support/?post_type=topic&p=11352130" >Click Here</a>');
				$this->redirect($url);
	        }
		}
		
    }
	
    public function edit() {
        if (!empty($this->params['data']) ) {
           
           if ($this->model->save($this->params['data'])) {
			$this->flash('notice', 'Successfully saved! <br>IMPORTANT: You need to go to Settings > Permalinks and click “save” to avoid getting a 404 page. <br>Use the shortcodes to start accepting loan applications and user account creation<br> Getting started documentation https://wordpress.org/support/?post_type=topic&p=11352130');
				$this->refresh();
		  } else {
			$this->flash('error', $this->model->validation_error_html);
		  }
		}
		$this->set_object();			
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