<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ 

require_once dirname(__FILE__).'/admin/simplelender_settings.php';
require_once dirname(__FILE__).'/coms/load_coms.php';

class simplelender_account{
	
    public function init(){	
	   $this->load_hooks();	
    }
	
    public function load_hooks(){
        add_shortcode('sl_user_gate',array($this, 'user_gate'));
        add_shortcode('sl_user_login',array($this, 'user_gate'));
        add_action("wp_ajax_nopriv_sl_submit_registration_form" , array( $this, "create_account_from_ajax"));
        add_action("simplelender_welcome_lender",array($this, 'welcome_to_simplelender'));
        add_action("simplelender_signup_starter",array($this, 'signup_starter')); 
        add_action("simplelender_lender_quote",array($this, 'lender_quotes'));
        add_action("simplelender_build_by",array($this, 'build_by'));
    }

    public function welcome_to_simplelender(){
        if(mvc_model("simplelenderLoansetting")->count(array())==0){
            //create loan product redirect
            $MvcAdminController=new MvcAdminController();
            $url = MvcRouter::admin_url(array('controller' =>'simplelender_loansettings', 'action' => 'add'));
            $MvcAdminController->flash('notice', 'Let us start by creating a new loan product :)');
            $MvcAdminController->redirect($url);

            //set up gravity form link
        }
    }

    public function build_by(){
        echo "<div class ='simplelender_build_by'><center><a href='https://wordpress.org/plugins/simplelender-by-umatidocs-com/'>Proudly Powered by Simplelender</a></center></div>";
    }
    //--------------------------------------------------------------------------------------------- 
    
    public function lender_quotes(){
        $sl_lender_quote=sl_lender_quote;
        $sl_lender_quote=maybe_unserialize($sl_lender_quote);
        $random_quote=count($sl_lender_quote);

        if ($random_quote>0) {
            $random_quote=$random_quote-1;
        }
        
        $random_quote = random_int(0,$random_quote);
        echo "<center>".$sl_lender_quote[$random_quote]."</center>";
    }

//----------------------user details---------------------------------------------------------------
    public function get_user_id(){
    	if (is_user_logged_in()){
            $user_id = get_current_user_id();
        }
        else{
            $user_id = 'loan_interime_'.random_int(0, 99999);
        }
    	

    	return $user_id;
    }

    public function get_user_name_from_acc_no($client_acc_no){
		$myClientaccount = mvc_model("simplelenderClientaccount")->find_one(
            array("conditions"=>array(
			"acc_number"=>$client_acc_no
		)));
        return mvc_model('MvcUser')->find_by_id($myClientaccount->wp_user_id)->user_login;
    }	
	
    public function get_user_name_from_sl_user_id($sl_user_id){
		return mvc_model("MvcUser")->find_by_id(mvc_model("simplelenderClientaccount")->find_by_id($sl_user_id)->wp_user_id)->user_login;
    }

    public function get_user_ac_from_sl_user_id($sl_user_id){
		return mvc_model("simplelenderClientaccount")->find_by_id($sl_user_id)->acc_number;
    }
	
	public function get_current_user_sl_id(){
		return mvc_model('simplelenderClientaccount')->find_one(['conditions'=>['wp_user_id'=>get_current_user_id()]])->id;
	}
	
    public function loan_transaction_user($trans_id){
		
		$myClientloan = mvc_model("simplelenderClientloan")->find_by_id($trans_id);
		$myClientaccount = mvc_model("simplelenderClientaccount")->find_one(
				array("conditions"=>array(
					"acc_number"=>$myClientloan->client_id
			)));
			
		if(mvc_model("MvcUser")->count($myClientaccount->user_id )>0){
			return mvc_model("MvcUser")->find_by_id($myClientaccount->user_id );
		}
		else{
		/*
			$nouser_all=wploancrm_class("simplelender_nouser_allocated");
			//$nouser_all->display_name = "No user";
			return  $nouser_all; 
		*/
		}
    }
    
    public function new_user($param=[]) {
        //create account on sl
        $user_acc_dat=  array(
            'user_login'=>$param['sl_username_d'],
            'user_email'=>$param['sl_mail_d'],
            'user_pass'=>$param['sl_pass_d'],
            'role'=>'Subscriber'
        );
        $new_user_id = wp_insert_user($user_acc_dat);
        $Clientaccount_feedback = mvc_model('simplelenderClientaccount')->create( array(
            'email'=>$param['sl_mail_d'],
            'firstname'=>$param['sl_username_d'],
            'acc_number'=>'AC'.time(),
            'status'=>1,
            'wp_user_id'=> $new_user_id //create an account on wordpress
        ));

        if ( simplelender_fs()->is_plan('growth') ) {
            $number_signup_actions_created = mvc_model('simplelenderWebhook')->count(array('conditions'=>array(
                        'webhook_trigger_action '=> 'simplelender_signup',
            )));

            if ($number_signup_actions_created>0) {
                do_action('simplelender_signup',array('user_id' => $Clientaccount_feedback ));
            }
            //else{
                //do_action('simplelender_signup_starter',array('user_id' => $Clientaccount_feedback ));
            //}
            //$interest_name = mvc_model('simplelenderLoansetting')->find_by_id($_SESSION["simplelender"]["pending_processes"]["loan_application_process"]["product_id"])->mailchimp_group;
            simplelender_send_to_mailchimp([
                'email'=>$param['sl_mail_d'],
                'status'=>"subscribed",
                'firstname'=>$param['sl_username_d'],
                'lastname'=>$param['sl_username_d']//,
                //'interest'=>$interest_name
            ]);
            do_action('simplelender_signup_starter',array('user_id' => $Clientaccount_feedback ));
        }
        else{
            do_action('simplelender_signup_starter',array('user_id' => $Clientaccount_feedback ));
        }
        
        $this->return_success_signup(array('logins'=>array("login"=>$param['sl_username_d'],"pass"=>$param['sl_pass_d']),"feadback"=>$Clientaccount_feedback));
    }

    public function sl_user_login(){

        if (mvc_model('simplelenderClientaccount')->count(array('conditions' => array('wp_user_id'=>get_current_user_id()))) > 0) {
            $new_user_id = mvc_model('simplelenderClientaccount')->find_one(array('conditions' => array('wp_user_id'=>get_current_user_id())));
            do_action('simplelender_login',array('user_id' => $new_user_id, ));
        }
    }

    public function update_user($param){
        
    }
    
    public function return_signup_error($param) {
        $respose_data=  array(
            "signup_status"=>false,
            "error_list"=>$param
           );
        
        echo json_encode($respose_data);
        
        wp_die();
    }
    
    public function return_success_signup($param) {
        $respose_data=  array(
            "signup_status"=>true,
            "additional_info"=>$param,
           );
        
           echo json_encode($respose_data);
           wp_die();
    }
    
    public function needed_feilds_are_set($create_user_data) {
        
        $error_log =  array();
        //verify all needed feilds are set
        if(empty($create_user_data['sl_username_d'])){
            array_push($error_log, array('sl_username_e'=>'Username is needed<br>'));
        }
        if(empty($create_user_data['sl_mail_d'])){
            array_push($error_log, array('sl_mail_e'=>'Correct Email is needed<br>'));
        }
        
        if(empty($create_user_data['sl_pass_d'])){
            array_push($error_log, array('sl_pass_e'=>'Enter an Email<br>'));
        }
        
        return $error_log;
    }
    
    public function verify_there_is_no_duplicate($create_user_data) {
        
        $error_log =  array();
        
        //verify there is no duplicate - username, email
        $mail_exists = mvc_model('simplelenderClientaccount')->count(array('conditions' => array('email'=>$create_user_data['sl_mail_d'])));
        //$username_exists=mvc_model('simplelenderClientaccount')->count(array('conditions' => array('username'=>$create_user_data['sl_user_d'])));
        
        if($mail_exists>0){
            array_push($error_log, array('sl_mail_e'=>'Email '.$create_user_data['sl_mail_d'].' exists, try recovering password.<br>'));
        }
        //if($username_exists){
            //array_push($error_log, array('sl_username_e'=>'Email exists, try recovering password.<br>'));
        //}
        
        return $error_log;
    }
    
    public function create_account_from_ajax() {
        
        $create_user_data=$_POST;
        array_push($create_user_data, array('ac_no'=>'AC'.time()));
        
        $needed_feilds_are_set = $this->needed_feilds_are_set($create_user_data);
        $verify_there_is_no_duplicate = $this->verify_there_is_no_duplicate($create_user_data);
        
        $error_log=  array();
        if(count($needed_feilds_are_set)>0){
            array_push($error_log, $needed_feilds_are_set );
        }
        if(count($verify_there_is_no_duplicate)>0){
            array_push($error_log, $verify_there_is_no_duplicate );
        }
        
        //if there is an error return error and die
        if(count($error_log)>0){
            $this->return_signup_error($error_log);
        }
        
        //if all requirements are passed -> create account
        $this->new_user($create_user_data);
    }

    public function user_gate($redirect_url ='undefined'){
    	$redirect_url=mvc_public_url(array('controller' => "simplelender_clientloans" , 'action' => 'index'));    	

        if (is_user_logged_in()){
            $redirect_url=mvc_public_url(array('controller' => "simplelender_clientloans" , 'action' => 'index'));
            return '<div id="sl_user_gate_main">
                    <div id="sl_user_gate_login">
                    <script type="text/javascript">
                        jQuery(document).ready(function($) {
                            window.location="'.mvc_public_url(array('controller' => 'simplelender_clientloans' , 'action' => 'index')).'";
                        })
                    </script>
                        <center>
                        <a id="sl_proceed_dashboard" href="'.$redirect_url.'">Proceed to Dashboard</a>
                        </center>
                    </div>
                    
            </div>';
        }
        else{
        	return '<div id="sl_user_gate_main">
                	<div class="sl_user_gate"><center>
                    <div id="sl_user_gate_head">
                            <div class="sl_user_gate_menu_item" id="sl_user_gate_menu_item_login">Login</div>
                            <div class="sl_user_gate_menu_item" id="sl_user_gate_menu_item_create_ac">Create an Account</div>
                            </div>
                            </center>
                    </div>
                    
                    <div id="sl_user_gate_login"><center><div id="sl_logplace">'.$this->login_form($redirect_url).' </div></center>
                    </div>
                    <div id="sl_user_gate_signup">'.$this->signup_form().'
                    </div>
        	</div>';
        }
    }
    
    public function login_form($redirect_url) {
        return wp_login_form( array( 'echo' => false, 'redirect'=> $redirect_url) );
    }
    
    public function signup_form() {
        
        return  '
        <form name="loginform" id="loginform" action="http://localhost/wordpress/wp-login.php" method="post">
        	<center>
                <p>
        		<label for="user_login">Username<br>
        		<input name="sl_username" id="sl_username" aria-describedby="login_error" class="input" value="" size="20" type="text"></label>
        	</p>
               
                <div class="" id="sl_email_section">        
                    <p>
                            <label for="user_login">Email Address<br>
                            <span class="sl_email_section_correction_message"></span>
                            <input name="sl_log" id="sl_user_login" aria-describedby="login_error" class="input" value="" size="20" type="text"></label>
                    </p>

                    <p>
                            <label for="user_login">Confirm Email Address<br>
                            <span class="sl_email_section_correction_message"></span>
                            <input name="sl_log_confirm" id="sl_user_login_confirm" aria-describedby="login_error" class="input" value="" size="20" type="text"></label>
                    </p>
                </div>
                
                <p>
                    <label for="user_pass">Password<br>
                    <input name="sl_pwd" id="sl_user_pass" aria-describedby="login_error" class="input" value="" size="20" type="password"></label>
                </p>
                
                <p class="submit">
                <span class="sl_user_reg_loader">Loading...<br></span>
        		<input name="wp-submit" id="sl-wp-user-reg-submit" class="button button-primary button-large" value="Get Started" type="submit"></center>
        		<input name="redirect_to" value="http://localhost/wordpress/wp-admin/" type="hidden">
        		<input name="testcookie" value="1" type="hidden">

        	</p>
        </form>';

    }

    public function signup_starter($param=''){
        $mail_subject = 'Welcome to '.$_SERVER['HTTP_HOST'];
        $mail_content = 'We are excited to have you at '.$_SERVER['HTTP_HOST'].', to follow up on your loans,<br> log in here <a href="'.mvc_public_url(array('controller' => 'simplelender_clientloans' , 'action' => 'index')).'">'. mvc_public_url(array('controller' => 'simplelender_clientloans' , 'action' => 'index')).'</a>';
        
        $recipient_list=mvc_model('simplelenderClientaccount')->find_by_id($param['user_id'])->email;
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
        $headers .= 'From: no_reply@'.$_SERVER['HTTP_HOST']. "\r\n";
        $email_sent= wp_mail( $recipient_list, $mail_subject , $mail_content,$headers);
    }
	
    /*create borrower account and not wordpress account*/
	public function create_borrower_for_wp_user(){
        //create account on sl
        $wp_user_details = wp_get_current_user();

        $param['sl_username_d']=$wp_user_details->user_nicename;
        $param['sl_mail_d']=$wp_user_details->user_email;
        $param['wp_user_id']=$wp_user_details->ID;

        //create borrower account with details
        $Clientaccount_feedback = mvc_model('simplelenderClientaccount')->create( array(
            'email'=>$param['sl_mail_d'],
            'firstname'=>$param['sl_username_d'],
            'acc_number'=>'AC'.time(),
            'status'=>1,
            'wp_user_id'=> $param['wp_user_id'] //create an account on wordpress
        ));

        if ( simplelender_fs()->is_plan('growth') ) {
            do_action('simplelender_signup',array('user_id' => $Clientaccount_feedback ));
        }
        else{
            do_action('simplelender_signup_starter',array('user_id' => $Clientaccount_feedback ));
        }
        
		if(simplelender_class('simplelender_gravity_form_manager')->there_is_an_active_session()){
			simplelender_class('simplelender_gravity_form_manager')->connect_loan_to_user();
		}
		
		//return client id
        return $Clientaccount_feedback;
	}
}
?>