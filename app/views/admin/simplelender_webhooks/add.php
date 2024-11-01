<div class = "wrap simplelender_input"  id="simplelender_webhook_input">

<center><h2 class="simplelender_main_title"> New Email </h2></center>

<?php echo $this->form->create($model->name); ?>

<hr>
	<div class="simplelender_title_feild">Activate Email</div>
	<div><?php echo $this->form->checkbox_input('notification_is_active',array('label' => '','value'=>1,'class'=>'simplelender_input_feild')); ?></div>

	<div class="simplelender_title_feild">Name</div>
	<div class="simplelender_title_feild"><?php  echo $this->form->input('name', array('label' => '','class'=>'simplelender_input_feild')); ?></div>

	<div class="simplelender_title_feild">Trigger</div>
	<div><?php  
	$simplelender_array_output=[
		"simplelender_login"=>"Login",
		"simplelender_signup"=>"Signup",
		"simplelender_loan_application"=>"Loan Application",
		"simplelender_loan_status_change"=>"Loan Status Change",
		"simplelender_new_transaction"=>"New Transaction"
	];

	echo $this->form->select('webhook_trigger_action', array( 'value' => $object->webhook_trigger_action,'options'=> $simplelender_array_output , 'class'=>'simplelender_input_feild', ));
	?></div><br><br><br><br>
	<hr>
	<div><center><h2>EMAIL</h2></center></div>
	<hr>
	<div class="simplelender_title_feild">Send Email</div>
	<div><?php echo $this->form->checkbox_input('mail_active',array('label' => '','class'=>'simplelender_input_feild')); ?></div>
	
	<div class="simplelender_title_feild">Email subject</div>
	<div><?php echo $this->form->input('mail_subject',array('label' => '','class'=>'simplelender_input_feild')); ?></div>

	<div class="simplelender_title_feild">Email body</div>
	<div><?php echo $this->form->editor('mail_body',array('label' => '','class'=>'simplelender_input_feild')); ?></div>

	<div>
	<center>
	<?php
		echo simplelender_class('simplelender_mail_manager')->show_main_view(0);
	?>
	</center>
	</div>
	
<br>

<br>
<hr>
<?php echo "<center >".$this->form->end(' Add ')."</center>"; ?>

</div>
<?php echo simplelender_class('simplelender_merge_tags')->display_tag_onsidebar(); ?>