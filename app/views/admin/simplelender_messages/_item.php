<tr style="width:100%;">
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->ticket_id))
				echo '<span class="sl_list_name">'.$object->ticket_id.'</span>';
			else
				echo '(undefined)';
		?>
	</td>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->status)){
				$ticket_status= array(
					1 =>'Open', 
					2=>'Resolved'
				);
				echo $ticket_status[$object->status];
			}
			else{
				echo '(undefined)';
			}
		?>
	</td>
	<td class="sl_list_single_item">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->loan_id)){
				$object_loan_id = mvc_model("simplelenderClientloan")->find_by_id($object->loan_id)->loan_setting_id;
				echo mvc_model("simplelenderLoansetting")->find_by_id($object_loan_id)->name;
			}
			else{
				echo '(undefined)';
			}
		?>
	</td>
	<td class="sl_house_keeping">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->__id))
				echo "<center><a class='sl_house_keeping_link' href=".mvc_admin_url(array('controller' => 'admin_simplelender_messages', 'action' => 'message_room', 'id' => $object->__id)).">Messages</a></center>";
				else
				echo '---';
		?>
	</td>
</tr>