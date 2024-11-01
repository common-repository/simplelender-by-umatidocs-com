<tr style="width:100%;">
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   ?>
	<td style="padding:20px 30px; float:left; font-size:18px;">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->name))
				echo $object->name;
			else
				echo '---';
		?>
	</td>
	</td>
	<td style="padding:20px;	float:left;	font-size:13px;">
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->__id))
				echo "<a class='' href=".mvc_admin_url(array('controller' => 'admin_links', 'action' => 'edit', 'id' => $object->__id)).">manage</a>";
				else
				echo '---';
		?>
	</td>
</tr>