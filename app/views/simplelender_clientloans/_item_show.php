<tr >
	<td><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->id))
				echo $object->id;
			else
				echo '---';
		?></center>
	</td>
	<td><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ 		
			if (isset($object->id))
				echo  mvc_model("simplelenderLoansetting")->find_by_id($object->loan_setting_id)->name;
			else
				echo '---';
		?></center>
	<!--</td>
	
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			/*if (isset($object->__id))
				echo  mvc_model("simplelenderDentry")->count(['conditions'=>['trans_id'=>$object->id,'bs_account'=>6]])."(<a href='".mvc_public_url(array('controller' => 'simplelender_clientloans', 'action' => 'transaction','id'=>$object->__id))."'>view</a>)";
			else
				echo '---';
				*/
		?> -->
	<td><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->__id)){
				$sl_client_loan_stage=unserialize(sl_client_loan_stage);
        		echo $sl_client_loan_stage[$object->loan_stage];
			}
			else
				echo '---';
		?></center>
	</td>
	<td><center>
		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
			if (isset($object->id)){
				if ( simplelender_fs()->is_plan('growth') ) {
					echo "<a class='sl_menu_item_front_view' href=".mvc_public_url(array('controller' => 'simplelender_messages', 'action' => 'create_ticket','id'=>$object->id)).">Raise an Issue</a>";
				}
        	}
			else
				echo '---';
		?></center>
	</td>
</tr>