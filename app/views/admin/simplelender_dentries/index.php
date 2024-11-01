<div class="wrap simplelender_input">

<center>
    <h2 class="simplelender_main_title">ALL FINANCIAL TRANSACTION</h2>

<table class="simplelender_list_table">
	<tr style="width:100%;">
		<td class="simplelender_sub_title">
			<center>Client(Acc No.)</center>
		</td>
		<td class="simplelender_sub_title">
			<center>Loan issue Id</center>
		</td>
		<td class="simplelender_sub_title">
			<center>Type (tranasction id)</center>
		</td>
		<td class="simplelender_sub_title">
			<center><b>Amount</b></center>
		</td>
		<td style="padding:20px;">
			
		</td>
	</tr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
foreach ($objects as $object): ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item', array('locals' => array('object' => $object))); ?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
</table>
<center><?php  echo paginate_links($pagination); ?></center>
</center>

</div>