<center><b> Edit Borrower Details </b></center>

<div class = "wrap">
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>
<table class="form-table">
<tbody>
	<tr>
		<td class="simplelender_title_feild">Account Number</td>
		<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('acc_number', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></td>
	</tr>
	<tr>
		<td class="simplelender_title_feild">First Name</td>
		<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('firstname', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></td>
	</tr><tr>
		<td class="simplelender_title_feild">Middle Name</td>
		<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('middlename', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></td>
	</tr><tr>
		<td class="simplelender_title_feild">Last Name</td>
		<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('lastname', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></td>
	</tr><tr>
		<td class="simplelender_title_feild">Email</td>
		<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('email', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></td>
	</tr><tr>
		<td class="simplelender_title_feild">Mobile Number</td>
		<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('mobilenumber', array('placeholder' => '', 'label' => '', 'id'=>'','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></td>
	</tr>	
</tbody>
</table>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Update ')."<br> <a href=".mvc_admin_url(array('controller' => 'admin_simplelender_clientaccounts', 'action' => 'delete', 'id' => $object->__id)).">Delete</a></center>"; ?>
<br>
</div>