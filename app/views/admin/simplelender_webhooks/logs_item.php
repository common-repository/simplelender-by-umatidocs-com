<tr style="width:100%;">
    <td style="padding:20px 30px;">
		<?php  
			if (isset($object->id)){
				
				echo '<span class="simplelender_list_name">'.mvc_model('simplelenderWebhook')->find_by_id(mvc_model('simplelenderWebhookEvent')->find_by_id($object->webhook_event_id)->webhook_id)->name.'</span>';
			}
			else{
				echo '(Not Set)';
			}
		?>
	</td>
	<td style="padding:20px 30px;">
		<?php  
			if (isset($object->successful)){
				$simplelender_successful=array('failed','successful');
				echo $simplelender_successful[$object->successful];
			}
			else
				echo '(Not Set)';
		?>
	</td>	
	<td style="padding:20px 30px;">
		<?php    
			if (isset($object->retry)){
				$simplelender_retry=array('first attempt','retry');
				echo $simplelender_retry[$object->successful];
			}
			else
				echo '(Not Set)'
		?>
	</td>
	<td style="padding:20px 30px;">
		<?php    
			if (isset($object->log_type)){
				$simplelender_log_type=array(1=>'Notification trigger',2=>'Notification modification');
				echo $simplelender_log_type[$object->log_type];
			}
			else
				echo '(Not Set)'
		?>
	</td>
	<td style="padding:20px 30px;">
		<?php    
			if (isset($object->log_type)){
				echo $object->timestamp;
			}
			else
				echo '(Not Set)'
		?>
	</td>
</tr>