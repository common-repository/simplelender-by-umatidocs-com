<tr style="width:100%;">
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   //echo $this->html->traffic_manager_link($object); ?>
	<td style="padding:20px 30px;">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->client_id))
				echo mvc_model("MvcUser")->find_by_id($object->client_id)->user_login;
			else
				echo '---';
		?>
	</td>
	<td style="padding:20px 30px;">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->loan_stage))
				echo mvc_model("simplelenderClientloanstage")->find_by_id($object->loan_stage)->name;
			else
				echo '-Not Set-';
		?>
	</td>	
	<td style="padding:20px 30px;">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->loan_setting_id))
				echo mvc_model("simplelenderLoansetting")->find_by_id($object->loan_setting_id)->name;
			else
				echo '-Not Set-';
		?>
	</td>
	<td style="padding:20px;">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->__id)){
					echo "<a class='' href=".mvc_admin_url(array('controller' => 'admin_simplelender_clientloans', 'action' => 'edit', 'id' => $object->__id)).">Manage</a>";
					echo " | <a class='' href=".mvc_admin_url(array('controller' => 'admin_simplelender_clientloans', 'action' => 'process', 'id' => $object->__id)).">Process</a>";
					echo " | <a class='' href=".mvc_admin_url(array('controller' => 'admin_simplelender_dentrys', 'action' => 'add', 'id' => $object->__id)).">Transactions</a>";
				
				}				
				else
					echo '---';
		?>
	</td>
</tr>