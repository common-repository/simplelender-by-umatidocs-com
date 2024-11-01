<div class="client_dash">
<h2><center><b>My Loans</b></center></h2>
<div class="logout_link_wrapper"><span class="logout_link"><a href="wp-login.php?action=logout"><button>Logout</button></a></span></div>
<hr>
<table>
<tr>
	<td><center><b>Loan ID</b></center></td>
	<td><center><b>Loan Product</b></center></td>
	<td><center><b>Number of transactions </b></center></td>
	<td><center><b>Loan stage</b></center></td>
</tr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item_show', array('locals' => array('object' => $object))); ?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
</table>

<hr>
</div>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   //echo $this->pagination(); ?>