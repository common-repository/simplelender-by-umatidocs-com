<div style="background:white; border:1px #90a8ce solid; border-radius:5px; padding:30px;margin:20px;">
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name, array('public' => true , 'controller'=>'clientloans' , 'action' => 'add')); ?>
<div>
	<div>amount_needed</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
	echo $this->form->input('amount_needed', array('label' => '')); ?></div>
	
	<div>needed_by_date</div>
	<div ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('needed_by_date', array('placeholder' => '', 'label' => '','id'=>'date_picker'),  array('style' => 'width: 200px;'));?></div>
	<div>Term in years.</div>
	<div ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('term_in_years', array('placeholder' => '', 'label' => '','id'=>'date_picker'),  array('style' => 'width: 200px;'));?></div>
</div>
your estimated payment monthly payment: <span style="color:blue;font-weight:bold;">$888.00</span> at a an interest of <b>12% P.A.</b>
<div><br>

</div>
	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
		echo $this->form->hidden_input('loan_setting_id', array('value'=>$loan_setting_id),  array());
	?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->end('Full Payment Plan',array('class' => 'button-primary')); ?>
</div>
