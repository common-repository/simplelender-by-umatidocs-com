<div class = "wrap simplelender_input">

<center><h2 class="simplelender_main_title"> MANAGE LOAN FLOW</h2></center>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>
<table class="form-table">
<tbody>
<tr>
	<td class="simplelender_title_feild">Loan Amount</td>
	<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('amount_needed', array('label' => '','class'=>'simplelender_input_feild')); ?></td>
</tr><tr>	
	<td class="simplelender_title_feild">Client Account number</td>
	<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('client_id',$client_id, array(), array('label' => '','class'=>'simplelender_input_feild')); ?></td>
</tr><tr>
	<td class="simplelender_title_feild">Loan Product</td>
	<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('loan_setting_id',$loan_setting, array(), array('label' => '','class'=>'simplelender_input_feild')); ?></td>
</tr>
</tbody>
</table>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Update ')."<br> <a href=".mvc_admin_url(array('controller' => 'admin_simplelender_clientloans', 'action' => 'delete', 'id' => $object->__id)).">Delete</a></center>";?>
<br>
</div>