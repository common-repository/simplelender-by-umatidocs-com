<tr style="width:100%;">
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
			if (isset($object->client_id) && is_numeric($object->client_id)){
				
				echo '<span class="sl_list_name">'.simplelender_class('simplelender_account')->get_user_name_from_sl_user_id($object->client_id).'</span>';
			}
			else{
				echo '(anonymous)';
			}
		?>
	</td>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
			$sl_client_loan_stage=unserialize(sl_client_loan_stage);
			if (!is_null($object->loan_stage))
				echo $sl_client_loan_stage[$object->loan_stage];
			else
				echo '(undefined)';
		?>
	</td>	
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ 
			$Loansetting_name=mvc_model("simplelenderLoansetting")->find_by_id($object->loan_setting_id)->name ;

			if (!is_null($object->loan_setting_id) && isset($Loansetting_name))
				echo mvc_model("simplelenderLoansetting")->find_by_id($object->loan_setting_id)->name;
			else
				echo '(undefined)';
		?>
	</td>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (!is_null($object->__id)){
					echo "<center><a class='sl_house_keeping_link' href=".mvc_admin_url(array('controller' => 'admin_simplelender_clientloans', 'action' => 'edit', 'id' => $object->__id)).">Edit</a>";
					echo " | <a class='sl_house_keeping_link' href=".mvc_admin_url(array('controller' => 'admin_simplelender_clientloans', 'action' => 'process', 'id' => $object->__id))."> Process</a>";
		
				}				
				else
					echo '---';
		?>
	</td>
</tr>