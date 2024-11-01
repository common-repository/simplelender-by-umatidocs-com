<tr >
	<td><center><hr>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->message))
				echo $object->message.' <br><span style="font-size:10px;">'.$object->time_created.'</span><br>';
			else
				echo '---';
		?></center>
	</td>
	
</tr>