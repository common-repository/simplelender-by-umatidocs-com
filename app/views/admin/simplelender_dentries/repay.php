<div class = "wrap simplelender_input">

<center><h2 class="simplelender_main_title"> REPAY LOAN </h2></center>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); ?>

<hr>
	<div class="simplelender_title_feild">Loan Amount</div>
	<div class="simplelender_title_feild">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('trans_amount', array('label' => '','class'=>'simplelender_input_feild')); ?>
	</div>
	
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
	echo $this->form->hidden_input('parent_trans_id', array('value' => $sl_parent_trans->id )); 
	echo $this->form->hidden_input('trans_id', array()); 
	
	echo simplelender_class('simplelender_loan')->loan_summary(array('loan_id'=>$sl_parent_trans->id));	
?>
	
	<br>
<br>
<hr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Pay Loan ')."</center>";
?>

</div>

<div>
</div>
<script>
    jQuery(document).ready(function($) {
        $("#date_picker").datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>