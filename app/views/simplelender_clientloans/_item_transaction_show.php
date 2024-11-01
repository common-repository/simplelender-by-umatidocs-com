<tr style="width:100%;">
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
	$myClientloan = mvc_model("simplelenderClientloan")->find_by_id($object->trans_id);
	$myClientaccount = mvc_model("simplelenderClientaccount")->find_by_id($myClientloan->client_id);
	
	//echo $this->html->traffic_manager_link($object); ?>
	
	<td style="padding:20px 30px;">
		<center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->trans_id))
				echo $object->trans_id;
			else
				echo '-Not Set-';
		?>
	</center>
	</td>
	<td style="padding:20px 30px;">
		<center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
		$trans_title=array(
				"1"=>"Loan Issued",
				"2"=>"Loan Repayed",
			);
			if (isset($object->dr_cr))
				echo $trans_title[$object->dr_cr];
			else
				echo '-Not Set-';
		?>
	</center>
	</td>
	<td style="padding:20px 30px;">
		<center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->trans_amount))
				echo $object->trans_amount;
			else
				echo '-Not Set-';
		?>
	</center>
	</td>
	
</tr>