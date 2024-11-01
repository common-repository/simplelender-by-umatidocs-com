<div style="background:white; border:1px #90a8ce solid; border-radius:5px;padding:30px;margin:20px;">
<h2>Client Loans</h2>
<hr>
<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
	echo "<a class='button-primary' href=".mvc_admin_url(array('controller' => 'admin_loansettings', 'action' => 'add',)).">New Loan Product</a>";	
	echo "<a class='button-primary' href=".mvc_public_url(array('controller' => 'loansettings', 'action' => 'add',)).">New Loan Product</a>";	
	
	?>	</div>
<hr>
<table>
	<tr style="width:100%;">
		<td class="sl_list_single_item">
			Client
		</td>
		<td class="sl_list_single_item">
			Loan Stage
		</td>
		<td class="sl_list_single_item">
			Loan Product
		</td>
		</td>
		<td class="sl_list_single_item">
			
		</td>
	</tr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item', array('locals' => array('object' => $object))); ?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
</table>
<hr>
</div>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?>