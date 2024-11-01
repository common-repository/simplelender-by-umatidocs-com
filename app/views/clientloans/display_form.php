<div style="background:white; border:1px #90a8ce solid; border-radius:5px; padding:30px;margin:20px;">
<h2>Process Loan</h2>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
	echo "<a class='button-primary' href=".mvc_admin_url(array('controller' => 'admin_clientloans', 'action' => '',)).">Transactions for this Loan</a><br>";	
?>
<table class="loan_stages">
	<tr>
		<td><a href="">
			Application
		</a></td>
		<td>><a href="">
		More Info
		</a></td>
		<td>><a href="">
		Approved</a> / <a href="">Declined</a></td>
		<td>> <a href="">Repayment</a></td>
		<td>> <a href="">Closed</a></td>
	</tr>
</table>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo  do_shortcode('[gravityform id="1" title="true" description="true" ajax="false"]'); ?>

<br>
	<div><b>Loan Applicant:</b></div> 
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  	echo mvc_model('MvcUser')->find_by_id($object->client_id)->user_login; ?></div>
	<div><b>Loan Amount:</b></div> 
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $object->amount_needed; ?></div>
	<div><b>Loan type:</b><div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a href="'.mvc_admin_url(array('controller' => 'admin_loansettings', 'action' => 'edit','id' => $object->id)).'">'.mvc_model('Loansetting')->find_by_id($object->loan_setting_id)->name.'</a>'; ?></div>	
	<div><b>Loan needed by:</b><div>
	<div ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $object->needed_by_date;?></div>
	
	<hr>
	<div><b>Additional Information:</b><div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('gravity_entry_id', array('label' => '')); ?></div>
	<hr>
	
	<div><b>Next Step</b></div> 
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('loan_stage',$loan_stage, array(), array('label' => ''));?></div>
	
<hr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->end('>> Process >>');  ?>
	


</div>