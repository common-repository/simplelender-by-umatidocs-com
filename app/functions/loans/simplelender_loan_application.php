<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class simplelender_loan_application extends simplelender_loan_process{
	
    public function submit_form_with_accounts($param){
            
        // to gravity form: login -or- sign up
        if($Current_user_id > 0){
            $url = mvc_public_url(array('controller' => $this , 'action' => 'edit', 'id' => $id));			
		}		    
    }
	
}