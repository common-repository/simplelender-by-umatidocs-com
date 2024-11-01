<tr style="width:100%;">
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   ?>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->client_id))
				echo mvc_model("MvcUser")->find_by_id($object->client_id)->user_login;
			else
				echo '---';
		?>
	</td>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->loan_stage))
				echo mvc_model("Clientloanstage")->find_by_id($object->loan_stage)->name;
			else
				echo '-Not Set-';
		?>
	</td>	
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->loan_setting_id))
				echo mvc_model("Loansetting")->find_by_id($object->loan_setting_id)->name;
			else
				echo '-Not Set-';
		?>
	</td>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->__id))
				echo "<a class='' href=".mvc_admin_url(array('controller' => 'admin_clientloans', 'action' => 'edit', 'id' => $object->__id)).">manage</a>";
				else
				echo '---';
		?>
	</td>
</tr>