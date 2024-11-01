<?php
class simplelender_calculator_default_theme{
	public static $filter_to_show_calculator = 'simplelender_calculator_default_theme';
	public static $calculator_title = 'Basic loan theme';

	public function init(){
		add_filter('sl_get_calculator_themes',[$this,'do_menu_themes']);
		add_filter(simplelender_calculator_default_theme::$filter_to_show_calculator, [$this,'default_loan_calc']);
	}

	public function do_menu_themes($simplelender_calculator_themes=[]){
		//array_push($simplelender_calculator_themes,[simplelender_calculator_default_theme::$filter_to_show_calculator=>'']);
		$simplelender_calculator_themes[simplelender_calculator_default_theme::$filter_to_show_calculator]=simplelender_calculator_default_theme::$calculator_title;
	
		return $simplelender_calculator_themes;
	}

	public function default_loan_calc($param_product_id=''){
		$simplelenderLoansetting = mvc_model('simplelenderLoansetting')->find_by_id($param_product_id);        
		$primary_form = '
		<form enctype="application/x-www-form-urlencoded" action="" method="post">
            <div class="sl_loan_ap_primary_title_feild">Loan Amount</div>
            <div class="max_amount">
    			<center>
					<span class="sl_loan_app_amount_slider_output_'.$simplelenderLoansetting->id.'  input_option_selector_'.$simplelenderLoansetting->id.'"></span>
					<input type="number" min="0" placeholder="Enter a number" max="'.$simplelenderLoansetting->max_amount .'" id="sl_loan_app_amount_'.$simplelenderLoansetting->id.'" value="'.$simplelenderLoansetting->max_amount .'" class="sl_loan_app_amount sl_loan_app_amount_'.$simplelenderLoansetting->id.' input_option_selector_'.$simplelenderLoansetting->id.' sl_loan_ap_primary_input_feild large-text">
				</center>
    		</div>
            <div class="sl_loan_ap_primary_title_feild">Loan Term</div>
            <div class="max_amount">
    			<center>
					<span class="sl_loan_app_period_slider_output_'.$simplelenderLoansetting->id.' input_option_selector_'.$simplelenderLoansetting->id.'"></span>
					<input type="number" placeholder="Enter a number" id="sl_loan_app_period_'.$simplelenderLoansetting->id.'"  value="'.$simplelenderLoansetting->max_period_number.'" class="sl_loan_app_period sl_loan_app_period_'.$simplelenderLoansetting->id.' input_option_selector_'.$simplelenderLoansetting->id.' sl_loan_ap_primary_input_feild large-text ">
				</center>
    		</div>
             <div class="sl_loan_ap_primary_title_feild">
                What will you be spending it on?(e.g. car, home)
            </div>
	        <div>
                <input id="sl_loan_app_goal_'.$simplelenderLoansetting->id.'" name="sl_loan_app_goal" aria-required="true" class="sl_loan_app_goal_'.$simplelenderLoansetting->id.' input_option_selector_'.$simplelenderLoansetting->id.'  sl_loan_ap_primary_input_feild" type="text">
            </div>
            <input id="sl_loan_app_goal_description" aria-required="true" type="hidden" name="sl_loan_app_goal_description" class="input_option_selector_'.$simplelenderLoansetting->id.'  sl_loan_ap_primary_input_feild">
            <input id="sl_loan_app_email" name="sl_loan_app_email" aria-required="true" class="input_option_selector_'.$simplelenderLoansetting->id.'  sl_loan_ap_primary_input_feild" type="hidden">
        </form>
		<script type="text/javascript">
		sl_calc_more_info = "basic_caclulator";
		</script>
		';
        
        return $primary_form;
	}

	public function frontend($param=[]){
        $ses_dat = $_SESSION["simplelender"]["pending_processes"]["loan_application_process"];
		$simplelenderLoansetting = mvc_model('simplelenderLoansetting')->find_by_id($param['product_id']);
        $param_product_id=$param['product_id'];
        $sl_repayment_htm='';

        if ($simplelenderLoansetting->show_repayment==1 && $simplelenderLoansetting->calculator_theme == 'simplelender_calculator_default_theme') {
            $sl_repayment_htm= '<div class="sl_repayment_results_'.$simplelenderLoansetting->id.' sl_repayment_amount_subtitle input_option_selector_'.$simplelenderLoansetting->id.'"></div>';
        }
        else{
            $sl_repayment_htm='<div class="sl_repayment_results_'.$simplelenderLoansetting->id.' sl_repayment_amount_subtitle sl_repayment_amount_subtitle_hide input_option_selector_'.$simplelenderLoansetting->id.' "></div>';
        }

        $primary_form =
            '<div id="sl_loan_app_body" class="calculator-loan">
                <div class="sl_main_title">                    
                    <div class="sl_main_title_text">
                        <center> '.$simplelenderLoansetting->main_title_text.' </center>             
                    </div>
                    <div class="sl_main_title_description">
                        '.$simplelenderLoansetting->main_title_description.'
                    </div>
                </div>
                <div class="sl_main_content_area ">
                <div class="sl_main_content_area_input"> 
                    '.$sl_repayment_htm.'
                <div class="sl_mainf">';

        $primary_form .= apply_filters($simplelenderLoansetting->calculator_theme,$param_product_id);
        $primary_form .= $this->submit_from_fields(['simplelenderLoansetting'=>$simplelenderLoansetting]);
        $primary_form .='</div></div></div></div>
                    <script type="text/javascript">
                        if(typeof(sl_product_constants) == "undefined"){
                            var sl_product_constants=[];
                        }
                        if(typeof(sl_product_constants_a) == "undefined"){
                            var sl_product_constants_a=[];
                        }
                        sl_product_constants_a.push('.$simplelenderLoansetting->id.');
                    	sl_product_constants['.$simplelenderLoansetting->id.']={
                            "currency" : "'.$simplelenderLoansetting->currency .'",
                            "period" :"'.$simplelenderLoansetting->period_unit.'",
                            "product_id": '.$simplelenderLoansetting->id.'
                        }
                        var sl_default_product='.$simplelenderLoansetting->id.';
                        var sl_secondary_destination_for_calclation="'.mvc_public_url(array('controller' => 'simplelender_clientloans' , 'action' => 'complete_application','id'=>'1')).'";
                    </script>                
                ';
        return $primary_form;
	}

	public function submit_from_fields($param=''){
		$simplelenderLoansetting=$param['simplelenderLoansetting'];
		$primary_form = '
                    <form enctype="application/x-www-form-urlencoded" action="" method="post" class="">
                        <input type="hidden" class="sl_loan_app_amount_h_'.$simplelenderLoansetting->id.' input_option_selector_'.$simplelenderLoansetting->id.'" value="1223">
    					<input type="hidden" class="sl_loan_app_period_h_'.$simplelenderLoansetting->id.' input_option_selector_'.$simplelenderLoansetting->id.'"  value="0">
    					<input type="hidden" class="sl_loan_app_rate_h_'.$simplelenderLoansetting->id.' input_option_selector_'.$simplelenderLoansetting->id.'"  value="'.$simplelenderLoansetting->interest_rate.'%">

                        <br>
                        <center><div class="sl_calc_loader"></div></center>
                        <div>
                            <center>
                                <input value=" '.$simplelenderLoansetting->button_text.' " class="input_option_selector_'.$simplelenderLoansetting->id.' sl_repayment_button" type="submit" id="sl_repayment_submit_button">
                            </center>
                        </div>
                    </form>
                ';

        return $primary_form;
	}
}