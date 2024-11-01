<div class = "wrap ">

    <center><h2 class="simplelender_main_title">New Loan Product</h2></center>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); 
$gflist= mvc_model("simplelenderGform");
?>

<table class="form-table">
<tbody>
<tr>
    <td class="simplelender_title_feild">Product Name</td>
	<td class="simplelender_title_feild" ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('name', array('label' => '','class'=>'simplelender_input_feild')); ?></td>
</tr>
<tr>
	<td class="simplelender_title_feild">Currency</td>
	<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
		$currency_of_the_world= sl_currency_country ;
		$currency_of_the_world=maybe_unserialize($currency_of_the_world);
		echo $this->form->select('currency', array('options'=>$currency_of_the_world,'value'=>'USD' ,'label' => '','class'=>'simplelender_input_feild'));?>
	</td>
</tr>
<tr>
	<td  class="simplelender_title_feild">Maximum Loan Amount</td>	
	<td class="max_amount" ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('max_amount', array('placeholder' => '', 'label' => '','class'=>'simplelender_input_feild'),  array('style' => ''));?></td>
</tr>
<tr>
	<td class="simplelender_title_feild">Calculator Theme</td>
	<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
		
		$simplelender_calculator_themes=apply_filters('sl_get_calculator_themes',$simplelender_calculator_themes);
	
		//var_dump( $simplelender_calculator_themes);
		echo $this->form->select('calculator_theme', array('options' => $simplelender_calculator_themes, 'value'=>'simplelender_calculator_default_theme' ,'class'=>'simplelender_input_feild_f'));
	?>
	</td>
</tr>
<tr>
	<td class="simplelender_title_feild">Max Period</td>
	<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('max_period_number', array('label' => '','class'=>'simplelender_input_feild_small')); ?>
			</td>
			</tr>
<tr>
	<td class="simplelender_title_feild"></td>
	<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			$Periodunit=sl_period_unit;
			$Periodunit=maybe_unserialize($Periodunit);
			echo $this->form->select('period_unit', array('options' => $Periodunit, 'value'=>'y' ,'class'=>'simplelender_input_feild_small'));
		?>
	</td>
</tr>
<tr>
		<td class="simplelender_title_feild">Interest Rate</td>
		<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('interest_rate', array('label' => '','class'=>'simplelender_input_feild')); ?></td>
</tr>
<tr>
		<td class="simplelender_title_feild">Borrower Details Form
		<?php
		if ( !simplelender_fs()->is_plan('growth') ) {
			echo '<br>A Pro feature <a href="'. admin_url( 'admin.php?page=mvc_simplelender_clientloannotes-pricing') .'"><button class="simplelender_see_cool_features">See pricing</button></a><br><br>';
		}
		?>
		</td>
		<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('secondary_form', $gflist , array(), array('label' => '','class'=>'simplelender_input_feild'));?></td>
</tr>
<tr>
		<td class="simplelender_title_feild">Spending Goal Form
		<?php
		if ( !simplelender_fs()->is_plan('growth') ) {
			echo '<br>A Pro feature <a href="'. admin_url( 'admin.php?page=mvc_simplelender_clientloannotes-pricing') .'"><button class="simplelender_see_cool_features">See pricing</button></a><br><br>';
		}	
		?>
		</td>
		<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('goal_form', $gflist , array(), array('label' => '','class'=>'simplelender_input_feild'));?></td>
</tr>
<tr>
		<td class="simplelender_title_feild">Intro Header</td>
		<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('main_title_text', array('placeholder' => '','label' => '','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?> </td>
</tr>
<tr>
		<td class="simplelender_title_feild"><b>Intro Description</b> <br><span class='sl_description'> </span></td>
		<td class="simplelender_title_feild"></td>
		<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->editor('main_title_description', array('placeholder' => 'Notes about the link','label' => '','class'=>'simplelender_textare_input_feild'),  array('style' => 'width: 200px;'));?></td>
</tr>
<tr>
		<td class="simplelender_title_feild">Show Repayment</td>
		<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select('show_repayment', array('placeholder' => '','options' => ['1'=>'Show Repayments', '0'=>'Do not show Repayments'],'class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></td>
</tr>
<tr>
		<td  class="simplelender_title_feild">Submit button Text</td>	
		<td class="max_amount" ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('button_text', array('placeholder' => '', 'label' => '','value'=>'Yes! Get My Loan Now','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></td>	
</tr>
	<?php if (simplelender_fs()->is_plan('growth')) : ?>
	<tr>
		<td class="simplelender_title_feild">Mailchimp Group
		<?php
		if ( !simplelender_fs()->is_plan('growth') ) {
			echo '<br>A Pro feature <a href="'. admin_url( 'admin.php?page=mvc_simplelender_clientloannotes-pricing') .'"><button class="simplelender_see_cool_features">See pricing</button></a><br><br>';
		}	
		?>
		</td>
		<td class="max_amount" ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			$simplelender_get_mailchimp_list_interest= apply_filters('simplelender_get_mailchimp_list_interest','hallo');
			//var_dump($simplelender_get_mailchimp_list_interest);
			echo $this->form->select('mailchimp_group', array('options' => $simplelender_get_mailchimp_list_interest, 'value'=>$object->mailchimp_group,'class'=>'simplelender_input_feild_small'));
		?>		
		</td>
	</tr>
	<?php endif; ?>
<tr>
		<td class="simplelender_title_feild">Notes(Only seen by admin)</td>
		<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->textarea_input('notes', array('placeholder' => 'Notes about the loan','label' => '','class'=>'simplelender_textare_input_feild'),  array('style' => ''));?></td>
</tr>
</tbody>
</table>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Add ')."</center>"; ?>
</div>