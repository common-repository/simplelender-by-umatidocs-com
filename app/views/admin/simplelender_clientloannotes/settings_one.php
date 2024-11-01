<div style="background:white; border:1px #90a8ce solid; border-radius:5px; padding:30px;margin:20px;">

<h2>New Note</h2>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>
<hr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
echo "<a class='button-primary' href=".mvc_admin_url(array('controller' => 'admin_simplelender_loansettings', 'action' => '',)).">All Links</a>";	
?>	
<hr>
  
	<div>amount_needed</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->textarea_input('note', array('label' => '')); ?></div>
	
<hr>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->end('Add',array('class' => 'button-primary')); ?>
</div>
