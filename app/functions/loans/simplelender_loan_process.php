<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
class simplelender_loan_process{
	
	//Loan processing -> approved/ declined/ additional request(gravity form)

    public function approve_loan($Clientloan){
    	$Clientloan_id = $Clientloan['id'];
    	//$Clientloan_id = $Clientloan['client_id'];
    	$amount_needed=mvc_model('simplelenderClientloan')->find_by_id($Clientloan_id)->amount_needed;

		$dr_array = array( //dr loan ac for monay issued
				'bs_account'=>6,
				'dr_cr'		=>1,
				'trans_type'=>1, 	// loan
				'trans_id' 	=>$Clientloan_id,
				'parent_trans_id'=>$Clientloan_id,
				'trans_amount'=>$amount_needed,
		);
		
        $cr_array = array(//cr money ac
				'bs_account'=>'1',
				'dr_cr'	=>'2',
				'trans_type'=>'1', 	// loan
				'trans_id' 	=>$Clientloan_id,
				'trans_amount'=>$amount_needed,
		);
		
		$this->parent_double_entry($dr_array, $cr_array,$amount_needed);		
	}
	
	public function parent_double_entry( $dr_array , $cr_array , $amount='',$Clientloan_id=''){
		//do 'give loan' double enrty
        $trans_to_do = array();
		if(!isset($amount)){
			$simplelenderClientloan_amount_needed = mvc_model('simplelenderClientloan')->find_by_id($Clientloan_id)->amount_needed;
		}
		else{
			$simplelenderClientloan_amount_needed = $amount;
		}
		if(!isset($dr_array['trans_amount'])){
			$dr_array['trans_amount']=$simplelenderClientloan_amount_needed;
		}
		if(!isset($dr_array['trans_amount'])){
			$cr_array['trans_amount']=$simplelenderClientloan_amount_needed;
		}
        // money to lender
		array_push($trans_to_do, $cr_array );
		array_push($trans_to_do, $dr_array );
		$return_id_arr=array();
        foreach($trans_to_do as $trans){
            array_push($return_id_arr,$this->d_entry($trans));
		}
		do_action('simplelender_new_transaction', array('user_id' => $Clientloan_id , ));
		return array('rel_transaction_id'=>$return_id_arr[0],'secondary_transaction_id'=>$return_id_arr[1]);
	}
	
    public function decline_loan(){
		
    }
	
    public function make_request_before_processing_loan(){
		
    }
	
    public function charge_interest($itr_details){
		$trans_to_do = array();
			
		// money to lender
		array_push($trans_to_do, array(//cr interest ac
			'bs_account'=>5,
			'dr_cr'		=>2,
			'trans_type'=>1, 	// loan
			'trans_id' 	=>$itr_details['Clientloan_id'],
			'trans_amount' => $itr_details['amount'],
		));
		array_push($trans_to_do,  array( //dr loan ac for monay issued
				'bs_account'=>6,
				'dr_cr'		=>1,
				'trans_type'=>1, 	// loan
				'trans_id' 	=>$itr_details['Clientloan_id'],
				'trans_amount' => $itr_details['amount'],
		));
			
		foreach($trans_to_do as $trans){
				$this->d_entry($trans);
		}		
    }

	public function loan_repayment($param){

		//dr money acc		
		$dr_array = array( 
				'bs_account'=>1,
				'dr_cr'		=>1,
				'trans_type'=>2, 	// loan
				'trans_id' 	=>$param['trans_id'],
				'trans_amount'=>$param['trans_amount']
		);
		
		//cr loan acc
        $cr_array = array(
				'bs_account'=>6,
				'dr_cr'	=>2,
				'trans_type'=>2, 	// loan
				'trans_id'=>$param['trans_id'],
				'trans_amount'=>$param['trans_amount']
		);
		
		$entry_ids = $this->parent_double_entry($dr_array,$cr_array,$param['trans_amount']);	
			
		$loan_repayment_id = $entry_ids['rel_transaction_id'] ;
		
		return $loan_repayment_id;
	}
	
	//Double entry -
    public function d_entry($entry_d){	
		return mvc_model('simplelenderDentry')->create($entry_d);	
    }
}