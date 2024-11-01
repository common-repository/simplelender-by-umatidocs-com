<center><h2>Loan Product Manager</h2></center>
<div class = "wrap simplelender_input">    
    <center>
    <table class="simplelender_list_table wp-list-table widefat fixed striped pages">
		<thead>
			<tr style="width:100%;">
				<th class="simplelender_sub_title" >
					Product Name(id)
				</th>
				<th class="simplelender_sub_title">
					Interest Rate
				</th>
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
	<tfoot>
			<tr style="width:100%;">
				<th class="simplelender_sub_title" >
					Product Name(id)
				</th>
				<th class="simplelender_sub_title">
					Interest Rate
				</th>
				</th>
				<th class="simplelender_sub_title">                
				</th>
			</tr>
		</tfoot>	
	</table>
    <center><?php  echo paginate_links($pagination); ?></center>
    </center>

</div>
