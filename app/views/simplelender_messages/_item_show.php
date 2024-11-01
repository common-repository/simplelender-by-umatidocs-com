<tr >
	<td><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->ticket_id))
				echo $object->ticket_id;
			else
				echo '---';
		?></center>
	</td>
	<td><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->loan_id))
				echo  $object->loan_id;
			else
				echo '---';
		?></center>
	</td>
	<td><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->status)){
				$sl_status=[
					1=>'Open',
					2=>'Resolved'
				];
				echo $sl_status[$object->status];
			}
			else
				echo '---';
		?></center>
	</td>
	<td><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->id)){				
        		echo "<a class='sl_menu_item_front_view' href=".mvc_public_url(array('controller' => 'simplelender_messages', 'action' => 'message_room','id'=>$object->id)).">View</a>";
			}
			else
				echo '---';
		?></center>
	</td>
</tr>