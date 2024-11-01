<?php
class simplelender_loan_tags{
	
	
	public function init(){

		add_filter('simplelender_application_ID',array($this,'application_ID'),1,1);
		add_filter('simplelender_application_amount_needed',array($this,'application_amount_needed'),1,1);
		add_filter('simplelender_application_date',array($this,'application_date'),1,1);
		add_filter('simplelender_application_needed_by_date',array($this,'application_needed_by_date'),1,1);
		add_filter('simplelender_application_issue_date',array($this,'application_issue_date'),1,1);
		add_filter('simplelender_application_fully_settled_date',array($this,'application_fully_settled_date'),1,1);
		add_filter('simplelender_application_term',array($this,'application_term'),1,1);	
		add_filter('simplelender_application_term_period',array($this,'application_term_period'),1,1);
		add_filter('simplelender_application_product',array($this,'application_product'),1,1);
		add_filter('simplelender_application_stage',array($this,'application_stage'),1,1);

	}
	
	public function application_ID($param=''){
		return $param["loan_id"];
	}
	
	public function application_amount_needed($param=''){
		return mvc_model('simplelenderClientloan')->find_by_id($param["loan_id"])->amount_needed;
	}
	
	public function application_date($param=''){
		return mvc_model('simplelenderClientloan')->find_by_id($param["loan_id"])->application_date;
	}
	
	public function application_needed_by_date($param=''){
		return mvc_model('simplelenderClientloan')->find_by_id($param["loan_id"])->needed_by_date;
	}
	
	public function application_issue_date($param=''){
		return mvc_model('simplelenderClientloan')->find_by_id($param["loan_id"])->issue_date;
	}
	
	public function application_fully_settled_date($param=''){
		return mvc_model('simplelenderClientloan')->find_by_id($param["loan_id"])->fully_settled_date;
	}		
	
	public function application_term($param=''){
		return mvc_model('simplelenderClientloan')->find_by_id($param["loan_id"])->term;
	}

	public function application_term_period($param=''){
		return mvc_model('simplelenderClientloan')->find_by_id($param["loan_id"])->term_period;
	}

	public function application_product($param=''){
		$loan_setting_id = mvc_model('simplelenderClientloan')->find_by_id($param["loan_id"])->loan_setting_id;
		return mvc_model('simplelenderLoansetting')->find_by_id($loan_setting_id)->name;
	}
	
	public function application_stage($param=''){
		$loan_stage=[
			1=>'Application',
			2=>'Declined',
			3=>'Approved',
			4=>'Repayment',
			5=>'Closed'
		];
		return $loan_stage[mvc_model('simplelenderClientloan')->find_by_id($param["loan_id"])->loan_stage];
	}
}
?>