<div class='wrap simplelender_input' id="simplelender_webhook_input">

<center><h2 class="simplelender_main_title"> Edit Custom Email </h2>
<?php echo '<a class="button" href="'.mvc_admin_url(array("controller" => "simplelender_webhooks", "action" => "resend_failed_webhook", "id" =>$object->id)).'"><b>Resend failed events </b></a>'; ?>
<?php echo '<a class="button" href="'.mvc_admin_url(array("controller" => "simplelender_webhooks", "action" => "view_logs", "id" =>$object->id)).'"><b>View Logs</b></a>'; ?>
<br><br><br>

<b>Active Retrys:</b> <?php echo simplelender_class('simplelender_events_manager')->WebhookLog_unsuccessful_count($object->id); ?>
<?php echo '<b> Last Modified:</b> '.$object->last_modified; ?>
<?php echo '<b> Last Sent:</b> '.$object->last_time_event_is_triggered ; ?>
	
</center>

<?php echo $this->form->create($model->name); ?>

<hr>
	<div class="simplelender_title_feild">Email active</div>
	<div><?php echo $this->form->checkbox_input('notification_is_active',array('label' => '','value'=>1,'class'=>'simplelender_input_feild')); ?></div>

	<div class="simplelender_title_feild">name</div>
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
	?></div>
	<br><br><br><br>
	<hr>
	<div><center><h2>EMAIL</h2></center></div>
	<hr>
	<div class="simplelender_title_feild">Send email</div>
	<div><?php echo $this->form->checkbox_input('mail_active',array('label' => '','class'=>'simplelender_input_feild')); ?></div>
	
	<div class="simplelender_title_feild">Email subject</div>
	<div><?php echo $this->form->input('mail_subject',array('label' => '','class'=>'simplelender_input_feild')); ?></div>

	<div class="simplelender_title_feild">Email body</div>
	<div><?php echo $this->form->editor('mail_body',array('label' => '','class'=>'simplelender_input_feild')); ?></div>

	<div>
	<center>
	<?php		
		echo simplelender_class('simplelender_mail_manager')->show_main_view($object->id);
	?>
	</center>
	</div>
	<br><br><br><br>
	<hr>	
	
<?php echo "<center>".$this->form->end(' Save ')."</center>"; ?>
<br>
<br>
</div>
<?php echo simplelender_class('simplelender_merge_tags')->display_tag_onsidebar(); ?>