<div style="background:white; border:1px #90a8ce solid; border-radius:5px; padding:30px;margin:20px;">

<h2>A New Loan</h2>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>
<hr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
echo "<a class='button-primary' href=".mvc_admin_url(array('controller' => 'admin_simplelender_loansettings', 'action' => '',)).">All Links</a>";
?>	
<hr>
  
	<div>amount_needed</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('amount_needed', array('label' => '')); ?></div>
	
	<div>needed_by_date</div>	
	<div ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo  $this->form->select_from_model('needed_by_date', $amountneededtime ,array(),array('placeholder' => '', 'label' => ''),  array('style' => 'width: 200px;'));?></div>	
	
	<hr>
	<div>client_id</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('client_id',$client_id, array(), array('label' => '')); ?></div>
	
	<div>gravity_entry_id</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('gravity_entry_id', array('value' => '','label' => '')); ?></div>
	
	<div>loan_setting_id</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('loan_setting_id',$loan_setting, array(), array('label' => '')); ?></div>
	
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->hidden_input('loan_stage',array('value' => 1));?></div>
	
<hr>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->end('Add',array('class' => 'button-primary')); ?>
</div>
