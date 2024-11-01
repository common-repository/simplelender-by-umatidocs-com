<?php
class simplelender_borrower_tags{

	public function init(){
		
		add_filter('simplelender_account_no',array($this,'account_no'),1,1);
		add_filter('simplelender_first_name',array($this,'first_name'),1,1);
		add_filter('simplelender_middle_name',array($this,'middle_name'),1,1);
		add_filter('simplelender_last_name',array($this,'last_name'),1,1);
		add_filter('simplelender_email',array($this,'email'),1,1);
		add_filter('simplelender_phone_number',array($this,'phone_number'),1,1);
	}
	
	public function account_no($param=''){
		return mvc_model("simplelenderClientaccount")->find_by_id($param['borrower_id'])->acc_number;	
	}
	
	public function first_name($param=''){
		return mvc_model("simplelenderClientaccount")->find_by_id($param['borrower_id'])->firstname;	
	}
	
	public function middle_name($param=''){
		return mvc_model("simplelenderClientaccount")->find_by_id($param['borrower_id'])->middlename;
	
	}

	public function last_name($param=''){
		return mvc_model("simplelenderClientaccount")->find_by_id($param['borrower_id'])->lastname;
	}

	public function phone_number($param=''){
		return mvc_model("simplelenderClientaccount")->find_by_id($param['borrower_id'])->mobilenumber;
	}

	public function email($param=''){
		return mvc_model("simplelenderClientaccount")->find_by_id($param['borrower_id'])->email;
	}
//-----------------------------------------------------------------------------
	public function user_last_name(){
		$user_id = get_current_user_id();

		return get_user_meta($user_id,'last_name', true);
		}

	public function user_country(){
		$user_id = get_current_user_id();

		return get_user_meta($user_id,'country', true);
		}

	public function user_bio(){
		$user_id = get_current_user_id();

		return get_user_meta($user_id,'description', true);
		}

	public function user_url(){
		return get_userdata(get_current_user_id())->data->user_url;
		}

	public function user_registered(){
		return get_userdata(get_current_user_id())->data->user_registered;
		}

	public function user_roles(){
		return explode(",",get_userdata(get_current_user_id())->data->roles);
		}
}

?>