<div style="background:white; border:1px #90a8ce solid; border-radius:5px;padding:30px;margin:20px;">

<h2>Manage Client Loan</h2>
<hr>
<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<a class='button-primary' href=".mvc_admin_url(array('controller' => 'admin_simplelender_loansettings', 'action' => '',)).">All Loan</a>";	?>	
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo " <a class='button-primary' href=".mvc_admin_url(array('controller' => 'admin_simplelender_loansettings', 'action' => 'add',)).">New Loan</a>";	?>	</div>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>

<hr>
	<div>amount_needed</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('amount_needed', array('label' => '')); ?></div>
		
	<div>needed_by_date</div>	
	<div ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('needed_by_date', array('placeholder' => '', 'label' => ''),  array('style' => 'width: 200px;'));?></div>	
	
	<hr>
	<div>client_id</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('client_id',$client_id, array(), array('label' => '')); ?></div>
	
	<div>gravity_entry_id</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('gravity_entry_id', array('label' => '')); ?></div>
	
	<div>loan_setting_id</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('loan_setting_id',$loan_setting, array(), array('label' => '')); ?></div>
	
	<div>loan_stage</div> 
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('loan_stage',$loan_stage, array(), array('label' => ''));?></div>
	
<hr>
	
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
echo $this->form->end('Update');  ?>
<br>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
echo "<a href=".mvc_admin_url(array('controller' => 'admin_simplelender_links', 'action' => 'delete', 'id' => $object->__id)).">Delete</a>";
?>

</div>
<script type="text/javascript">
$(function($) {
	destination_type = <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $object->destination_type; ?>;
	if(destination_type==1){
		$('.primary_url').show();
		$('.split_test #Link_primary_url_select').attr('name','');
		$('.rotator_group #Link_primary_url_select').attr('name','');
		
	}
	else if(destination_type==2){
		$('.split_test').show();
		$('.primary_url #Link_primary_url_select').attr('name','');
		$('.rotator_group #Link_primary_url_select').attr('name','');
	}
	else if(destination_type==3){
		$('.rotator_group').show();
		$('.split_test #Link_primary_url_select').attr('name','');
		$('.primary_url #Link_primary_url_select').attr('name','');
	}
	conversion_type = <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $object->conversion_type; ?>;
	
	if(conversion_type == 2){
		$('.conversion_revenue').show();		
	}
	cloak_link = <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $object->cloak_link; ?>;
	
	if(cloak_link == 2){
		$('.Link_cloak_link_select_div').show();		
	}
	
});

</script>