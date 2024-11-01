<div class="wrap simplelender_input">

<center>
    <h2 class="simplelender_main_title">FINANCIAL TRANSACTIONs(Loan Id: <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $sl_loan_id; ?>)</h2>

    <table>
	<tr style="width:100%;">
		<td class="simplelender_sub_title">
			<b>Client(Acc No.)</b>
		</td>
		<td class="simplelender_sub_title">
			<b>Loan Issue Id</b>
		</td>
		<td class="simplelender_sub_title">
			<b>Type (tranasction id)</b>
		</td>
		<td class="simplelender_sub_title">
			<b>Amount</b>
		</td>
		<td style="padding:20px;">
			
		</td>
	</tr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
//var_dump($objects); 
foreach ($objects as $object): ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item', array('locals' => array('object' => $object))); ?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
</table>
<center><?php  echo paginate_links($pagination); ?></center>
</center>
<hr>
</div>
<hr>