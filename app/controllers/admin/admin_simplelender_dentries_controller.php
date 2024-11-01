<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class AdminSimplelenderDentriesController extends MvcAdminController {
    
    var $default_columns = array('id', 'name');
    
    public $before = ['domenu'];

    public function domenu() {
        $menu_html="";
        $menu_html.="<div class='sl_menu_html'><center>";
        $menu_html.= "<a class='wp-core-ui button-primary' href=".mvc_admin_url(array('controller' => 'admin_simplelender_dentries', 'action' => '',)).">Financial Transaction</a>";
        
        $menu_html.="</center></div>";

        echo $menu_html;
    }

    public function index() {
        do_action("simplelender_welcome_lender");
        $this->set('objects',$this->model->find(array('conditions'=>array('bs_account'=>6))));
    }

    public function transaction_list() {
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
	
        $this->set('objects',$this->model->find(array('conditions'=>array('trans_type'=>'1','trans_id'=>$this->params['id'],'bs_account'=>6))));
		$this->set('sl_loan_id',$this->params['id']);
    }
	
    public function edit() {
        if (!empty($this->params['data'])) {
            
			$this->model->save(["simplelenderDentry"=> ["id"=>$this->params['data']['simplelenderDentry']['parent_trans_id'],"trans_amount"=> $this->params['data']['simplelenderDentry']['trans_amount']]] );
			
            if ($this->model->save($this->params['data'])) {
                $this->flash('notice', 'Successfully saved!');
                $this->refresh();
            } else {
                $this->flash('error', $this->model->validation_error_html);
            }
        }
	
        $this->set_object();
        $this->set('loan_setting',mvc_model('simplelenderLoansetting'));
        $this->set('loan_stage',mvc_model('simplelenderClientloanstage'));	
		$this->set('client_id',mvc_model('MvcUser'));
    }

    public function process() {
	if (!empty($this->params['data'])) {
            //if approval do accounting
            $Clientloan_data = $this->params['data']['simplelenderClientloan'];
            $original_loan_stage = mvc_model('simplelenderClientloan')->find_by_id($Clientloan_data['id'])->loan_stage;
            if($Clientloan_data['loan_stage']!== $original_loan_stage){
		if($Clientloan_data['loan_stage']==4){
                    simplelender_class('simplelender_loan')->approve_loan($Clientloan_data["id"]);
		}
            }
		  
            if ($this->model->save($this->params['data'])) {
		$tell_them = [ //array of all people to be notified
                    ['user_id'=>2,'message_to_send'=>'your loan has been approved']
                ];

                $this->flash('notice', 'Successfully Processed!');			
                $this->refresh();
            } else {
		$this->flash('error', $this->model->validation_error_html);
            }
	}
		
	$this->set_object();
	$this->set('loan_stage',mvc_model('simplelenderClientloanstage'));
    }
	
    public function repay() {
		if (!empty($this->params['data']) && !empty($this->params['data'])) {
				$object = $this->params['data'];
				
				if (empty($object['id'])) {
					
					$id = simplelender_class('simplelender_loan_process')->loan_repayment($object['simplelenderDentry']);
					$url = MvcRouter::admin_url(array('controller' => $this->name, 'action' => 'payment_done', 'id' => $id));
					$this->flash('notice', 'Done!');
					$this->redirect($url);
				}
		}
		
		$this->set_object();
			
		$this->set( 'sl_parent_trans' , mvc_model('simplelenderDentry')->find_by_id(array($this->params['id'])) );
		$this->set('loan_setting',mvc_model('simplelenderLoansetting'));
		$this->set('loan_stage',mvc_model('simplelenderClientloanstage'));
    }
	
	public function payment_done(){
		
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