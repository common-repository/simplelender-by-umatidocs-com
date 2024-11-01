<div style="background:white; border:1px #90a8ce solid; border-radius:5px;padding:30px;margin:20px;">

<h2>Manage Client Loan</h2>
<hr>
<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<a class='button-primary' href=".mvc_admin_url(array('controller' => 'admin_simplelender_loansettings', 'action' => '',)).">All Loan</a>";	?>	
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo " <a class='button-primary' href=".mvc_admin_url(array('controller' => 'admin_simplelender_loansettings', 'action' => 'add',)).">New Loan</a>";	?>	
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo " <a class='button-primary' href=".mvc_public_url(array('controller' => 'simplelender_clientloans', 'action' => 'add',)).">public</a>";	
echo $this->html->link('All Venues', array('controller' => 'wploancrm_clientloans'))
?>	</div>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>

<hr>
	<div>amount_needed</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('amount_needed', array('label' => '')); ?></div>
		
	<div>needed_by_date</div>	
	<div ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('needed_by_date', array('placeholder' => '', 'label' => '', 'id'=>'date_picker'),  array('style' => 'width: 200px;'));?></div>	
	
	<hr>
	<div>client_id</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('client_id',$client_id, array(), array('label' => '')); ?></div>
	
	<div>gravity_entry_id</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('gravity_entry_id', array('label' => '')); ?></div>
	
	<div>loan_setting_id</div>
	<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('loan_setting_id',$loan_setting, array(), array('label' => '')); ?></div>
		
<hr>
	
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->end('Update');  ?>
<br>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
echo "<a href=".mvc_admin_url(array('controller' => 'admin_simplelender_clientloans', 'action' => 'delete', 'id' => $object->__id)).">Delete</a>";
?>

</div>

<div>
</div>
<script>
    jQuery(document).ready(function($) {
        $("#date_picker").datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>