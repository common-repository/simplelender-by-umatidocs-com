<div class = "wrap ">

    <center>
    	<h2 class="simplelender_main_title"> Manage Loan Product</h2>
    	<div><b>Single loan(<?php echo $object->name; ?>) : </b>[simplelender product=<?php echo $object->id; ?> ] <br> <b>All loans:</b> [simplelender_all_loans]<br> <b>Borrower Login/Signup:</b> [sl_user_login]</div>

    </center>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->create($model->name); 
$gflist= mvc_model("simplelenderGform");
?>
<table class="form-table">
<tbody>
<tr>
    <td class="simplelender_title_feild">
		Product Name
	</td>
	<td class="simplelender_title_feild" >
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('name', array('label' => '','class'=>'simplelender_input_feild')); ?>
	</td>
</tr>
<tr>
	<td class="simplelender_title_feild">Currency
	<?php 
	if ( !simplelender_fs()->is_plan('growth') ) {			
		echo '<br>Pro feature <a href="'. admin_url( 'admin.php?page=mvc_simplelender_clientloannotes-pricing') .'">See Pricing</a>';
	}
	?>
	</td>
	<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
		$currency_of_the_world= sl_currency_country ;
		$currency_of_the_world=maybe_unserialize($currency_of_the_world);
		echo $this->form->select('currency', array('options'=>$currency_of_the_world,'value'=>$object->currency ,'label' => '','class'=>'simplelender_input_feild'));?>
	</td>
</tr>
<tr>
	<td  class="simplelender_title_feild">
		Maximum Loan Amount
	</td>	
	<td class="max_amount" >
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('max_amount', array('placeholder' => '', 'label' => '','class'=>'simplelender_input_feild'),  array('style' => ''));?>
	</td>
</tr>
<tr>
	<td class="simplelender_title_feild">Calculator Theme</td>
	<td>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
		
		$simplelender_calculator_themes=apply_filters('sl_get_calculator_themes',$simplelender_calculator_themes);
		echo $this->form->select('calculator_theme', array('options' => $simplelender_calculator_themes, 'class'=>'simplelender_input_feild_f', 'value'=>$object->calculator_theme ));
	?>
	</td>
</tr>
<tr>
	<td class="simplelender_title_feild">Max Period</td>
	<td class="simplelender_title_feild">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('max_period_number', array('label' => '','class'=>'simplelender_input_feild_small')); ?>
	</td>
</tr>
<tr>
	<td class="simplelender_title_feild"></td>
	<td class="simplelender_title_feild">
	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			$Periodunit=sl_period_unit;
			$Periodunit=maybe_unserialize($Periodunit);
			echo $this->form->select('period_unit', array('options' => $Periodunit, 'value'=>$object->period_unit ,'class'=>'simplelender_input_feild_small'));
	?>
	</td>
</tr>
<tr>
	<td class="simplelender_title_feild">Interest Rate</td>
	<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('interest_rate', array('label' => '','class'=>'simplelender_input_feild')); ?></td>
</tr>
<tr>
	<td class="simplelender_title_feild">Borrower Details Form
	<?php
		if ( !simplelender_fs()->is_plan('growth') ) {
			echo '<br>A Pro feature <a href="'. admin_url( 'admin.php?page=mvc_simplelender_clientloannotes-pricing') .'">See Pricing</a><br><br>';
		}
	?>
	</td>
	<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('secondary_form', $gflist , array(), array('label' => '','class'=>'simplelender_input_feild'));?></td>
</tr>
<tr>
	<td class="simplelender_title_feild">Spending Goal Form 
	<?php
		if ( !simplelender_fs()->is_plan('growth') ) {
			echo '<br>A Pro feature <a href="'. admin_url( 'admin.php?page=mvc_simplelender_clientloannotes-pricing') .'">See pricing</a><br><br>';
		}
	?>
	</td>
	<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('goal_form', $gflist , array(), array('label' => '','class'=>'simplelender_input_feild'));?></td>
</tr>
<tr>
	<td class="simplelender_title_feild">Intro Header</td>
	<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('main_title_text', array('placeholder' => '','label' => '','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?></td>
</tr>
<tr>
	<td class="simplelender_title_feild">Intro Description
	<?php
		if ( !simplelender_fs()->is_plan('growth') ) {
			echo '<br>A Pro feature <a href="'. admin_url( 'admin.php?page=mvc_simplelender_clientloannotes-pricing') .'">See Pricing</a><br><br>';
		}
	?>
	</td>
	<td class="simplelender_title_feild"></td>
	<td class="simplelender_title_feild">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->editor('main_title_description', array('placeholder' => 'Notes about the link','label' => '','class'=>'simplelender_textare_input_feild'),  array('style' => ''));?>
	</td>
</tr>
<tr>
	<td class="simplelender_title_feild">Show Repayment on Calculator</td>
	<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select('show_repayment', array('placeholder' => '','options' => ['0'=>'Do not show Repayments','1'=>'Show Repayments'],'value'=>$object->show_repayment,'class'=>'simplelender_input_feild_f'));?></td>
</tr>
<tr>
	<td  class="simplelender_title_feild">Submit Button Text
	<?php
		if ( !simplelender_fs()->is_plan('growth') ) {
			echo '<br>Pro feature <a href="'. admin_url( 'admin.php?page=mvc_simplelender_clientloannotes-pricing') .'">See Pricing</a><br><br>';
		}
	?>
	</td>
	<td class="d" >
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('button_text', array('placeholder' => '', 'label' => '','class'=>'simplelender_input_feild'),  array('style' => 'width: 200px;'));?>
	</td>
</tr>
	<tr>
		<td class="simplelender_title_feild">Mailchimp Group
		<?php
			if ( !simplelender_fs()->is_plan('growth') ) {			
				echo '<br>Pro feature <a href="'. admin_url( 'admin.php?page=mvc_simplelender_clientloannotes-pricing') .'">See Pricing</a>';
			}
			echo '<br>To show groups <a href="'. admin_url( 'admin.php?page=mvc_simplelender_mailchimps') .'">Add API key</a>';
		?>
		</td><td></td>
		<td class="y" ><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			$simplelender_get_mailchimp_list_interest= apply_filters('simplelender_get_mailchimp_list_interest','hallo');
			if(is_array($simplelender_get_mailchimp_list_interest)){
				if(count($simplelender_get_mailchimp_list_interest)>0){
					echo $this->form->select('mailchimp_group', array('options' => $simplelender_get_mailchimp_list_interest, 'value'=>$object->mailchimp_group,'class'=>'simplelender_input_feild'));
				}
				else{
					echo "Please add API key";
				}				
			}
			else{
				echo "Please add API key";
			}
		?>
		</td>
	</tr>
	<tr>
		<td class="simplelender_title_feild">Notes</td>
		<td class="simplelender_title_feild"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->textarea_input('notes', array('placeholder' => 'Notes about the loan','label' => '','class'=>'simplelender_textare_input_feild'),  array('style' => ''));?></td>
	</tr>
</tbody>
</table>
	
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Update ')." <br><a href=".mvc_admin_url(array('controller' => 'admin_simplelender_loansettings', 'action' => 'delete', 'id' => $object->__id)).">Delete</a></center>"; ?>
</div>