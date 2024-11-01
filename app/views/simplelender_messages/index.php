<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
if($objects=="show_login"){
	$url=mvc_public_url(array('controller' => "simplelender_clientloans" , 'action' => 'index'));
	
	echo simplelender_class('simplelender_account')->user_gate($url);
}
elseif($objects=='sl_client_account_not_created'){
	?>
	<div class="client_dash">
	<h3><center>Your account not a loan client account, please contact us and we will resolve this.</center></h3>
	</div>
	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
}
else{
?><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
if($objects=="show_login"){
	$url=mvc_public_url(array('controller' => "simplelender_clientloans" , 'action' => 'index'));
	
	echo simplelender_class('simplelender_account')->user_gate($url);
}
elseif($objects=='sl_client_account_not_created'){
	?>
	<div class="client_dash">
	<h3><center>Your account not a loan client account, please contact us and we will resolve this.</center></h3>
	</div>
	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  
}
else{
?>
<div class="client_dash">
	
	<div id="simplelender_dash_content">
			<?php do_action('simplelender_borrower_top_menu'); ?>
			
			<br><br>
			<div></div>
		<center>
			<span class="fwidthtd"><b>My Tickets</b></span>			
		</center>
		
		<table id="simplelender_loan_dash">
			
			<tr>
				<td class="simplelender_sub_title" ><center>Ticket Number</center></td>
				<td class="simplelender_sub_title"><center>Loan Application Id</center></td>
				<td class="simplelender_sub_title"><center>Status </center></td>
				<td class="simplelender_sub_title"><center></center></td>
			</tr>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item_show', array('locals' => array('object' => $object))); ?>

			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
			
		</table>
		

	</div>

	</div>
</div>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   }
do_action("simplelender_build_by");
}
?>

 
 