<?php
class simplelender_more_tags{

	public function init(){
		add_filter('simplelender_sl_more_infor_loan_application',array($this,'sl_more_infor_loan_application'));
	}

	public function sl_more_infor_loan_application($param=''){
		//sl_more_infor_loan_application
		$tag_name_var_key= trim($param['tag_custom_info'],"{sl_}");
		
		return mvc_model('simplelenderDatValue')->find_one(['conditions'=>[
			'key_id'=>$tag_name_var_key,
			'object_id'=>$param['loan_id'],
			'object_type'=>2,
			]])->data_value;
	}
	
}
?>