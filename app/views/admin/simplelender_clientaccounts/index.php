<center><h2 class="simplelender_main_title">Borrowers</h2></center>

<div class = "wrap ">
<center><table class="simplelender_list_table wp-list-table widefat fixed striped pages">
		<thead>
			<tr style="width:100%;">
				<th class="simplelender_sub_title" >
					Name
				</th>
				<th class="simplelender_sub_title">
					ACC Number
				</th>
				<th class="simplelender_sub_title"> 
				</th>
			</tr>
		</thead>
		<tbody>  
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item', array('locals' => array('object' => $object))); ?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
</tbody>
 <thead>
	<tr style="width:100%;">
		<th class="simplelender_sub_title" >
			Name
		</th>
		<th class="simplelender_sub_title">
			ACC Number
		</th>
		<th class="simplelender_sub_title"> 
		</th>
	</tr>
</thead>
</table>

<center><?php  echo paginate_links($pagination); ?></center>

</div>


<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?>