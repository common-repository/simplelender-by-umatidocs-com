<div class="wrap ">
    <center><h2 class="simplelender_main_title">View Loan Application</h2></center>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
 ?>
<center>
<table class="loan_stages">
    <tr>
		<td class="simplelender_application_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="simplelender_application_top_a" href="'.mvc_admin_url(array('controller' => 'simplelender_clientloans', 'action' => 'process','id' => $object_id)).'">Process</a>'; ?>
		</td>
		<td class="simplelender_minfore_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="simplelender_application_top_a" href="'.mvc_admin_url(array('controller' => 'simplelender_clientloans', 'action' => 'more_loan_info','id' => $object_id)).'">More loan info</a>'; ?>
		</td>
		<td class="simplelender_adedcline_top">
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo '<a class="simplelender_application_top_a" href="'.mvc_admin_url(array('controller' => 'simplelender_clientloans', 'action' => 'goal_info','id' => $object_id)).'">Goal info</a>'; ?>
		
		</td>
	</tr>
</table>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo simplelender_class('simplelender_raw_data')->display_form_data([
	'object_type'=>1,
	'object_id'=>$object_id
]);        
 ?>
<br>
</center>
    <br>

</div>