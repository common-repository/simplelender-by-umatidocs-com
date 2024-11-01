jQuery(document).ready(function($) {
	
	function simplelender_change_activate_notification(notification_id){
		//replace info on relevant location
		var data_l= {
			"action": "simplelender_change_activate_notification",
			"simplelender_notification_id":notification_id
		};
		
		jQuery.post(ajax_object.ajaxurl, data_l, function(response) {
			if(response !== undefined){
			
			}
		});
	}
	
	if(typeof(simplelender_number_of_notifications) !== 'undefined'){
		$.each(simplelender_number_of_notifications,function(index, value){
			$("#"+index).change(function(){
				simplelender_change_activate_notification(value);
			});
		});
	}
	function simplelender_close_recipient(i){
		$("#simplelender_close_recipient_"+i).click(function(){
			$("#simplelender_main_row_recipient_"+i).html('');
		});
	}
		
	function simplelender_del_recipient(recipient_id){
		var data_l = {
			"action": "simplelender_delete_recipient",
			"simplelender_recipient_id":recipient_id
		};
		
		jQuery.post(ajax_object.ajaxurl, data_l, function(response) {
			if(response !== undefined){
				response = JSON.parse(response);
			}
		});
	}
	
	function simplelender_delete_recipient_on_server(i){
		$("#simplelender_close_recipient_"+i).click(function(){
			recipient_id= $("#simplelender_id_recipient_"+i).val();
			if(recipient_id>0){
				simplelender_del_recipient(recipient_id);
			}
		});
	}
	
	$('#simplelender_add_recipient_node').click(function(e){
		e.preventDefault();
		$('#simplelender_additional_mail_recipient').before('<tr id="simplelender_main_row_recipient_'+simplelender_next_recipient_node+'"><td>	<select name="more_data[simplelenderMailRecipient]['+ simplelender_next_recipient_node +'][type]" type="text"  class="simplelender_input_feild">	<option value=""></option> <option value="email" selected="selected">Email</option>  </select> </td><td><input id="" name="more_data[simplelenderMailRecipient]['+simplelender_next_recipient_node+'][recipient]" type="text" value="" class="simplelender_input_feild"></td><td><center><span class="simplelender_close_recipient_class" id="simplelender_close_recipient_'+simplelender_next_recipient_node+'">[X]</span></center></td></tr><br>');
		simplelender_close_recipient(simplelender_next_recipient_node);
		simplelender_next_recipient_node++;
	});
	
	if(typeof simplelender_next_recipient_node  == 'undefined'){
		simplelender_next_recipient_node='';
	}
	for(var i=0; i < simplelender_next_recipient_node ; i++ ){		
		simplelender_delete_recipient_on_server(i);
		simplelender_close_recipient(i);
	}
	
	//-----------------------url -------------------------------------
	
	function simplelender_close_url(i){
		$("#simplelender_close_url_"+i).click(function(){
			$("#simplelender_main_row_url_"+i).html('');
		});
	}
		
	function simplelender_del_url(url_id){
		
		var data_l= {
			"action": "simplelender_delete_url",
			"simplelender_url_id":url_id
		};
		
		jQuery.post(ajax_object.ajaxurl, data_l, function(response) {
			if(response !== undefined){
				response = JSON.parse(response);
			}
		});
	}
	
	function simplelender_delete_url_on_server(i){
		$("#simplelender_close_url_"+i).click(function(){
			url_id= $("#simplelender_id_url_"+i).val();
			
			if(url_id>0){
				simplelender_del_url(url_id);
			}
		});
	}
	
	$('#simplelender_add_url_node').click(function(e){
		e.preventDefault();
		$('#simplelender_additional_url').before('<tr id="simplelender_main_row_url_'+simplelender_next_url_node+'"><td>	<select name="more_data[simplelenderWebhookUrl]['+simplelender_next_url_node+'][type]" class="simplelender_input_feild"><option value=""></option><option value="POST" selected="selected">POST</option><option value="GET" >GET</option>	<option value="PUT" >PUT</option></select> </td><td><input id="" name="more_data[simplelenderWebhookUrl]['+simplelender_next_url_node+'][url]" type="url" value="" class="simplelender_input_feild"></td><td><center><span class="simplelender_close_url_class" id="simplelender_close_url_'+simplelender_next_url_node+'">[X]</span></center></td></tr><br>');
		simplelender_close_url(simplelender_next_url_node);
		simplelender_next_url_node++;
	});
	if(typeof simplelender_next_url_node  == 'undefined'){
		simplelender_next_url_node='';
	}
	
	for(var i=0; i < simplelender_next_url_node ; i++ ){		
		simplelender_delete_url_on_server(i);
		simplelender_close_url(i);
	}

	//-----------------------args -------------------------------------
	
	function simplelender_close_args(i){
		$("#simplelender_close_args_"+i).click(function(){
			$("#simplelender_main_row_args_"+i).html('');
		});
	}
		
	function simplelender_del_args(args_id){
		//replace info on relevant location
		var data_l= {
			"action": "simplelender_delete_args",
			"simplelender_args_id":args_id
		};
		
		//ajax_object.ajax_url="http://localhost/wordpress/wp-admin/admin-ajax.php";
		jQuery.post(ajax_object.ajaxurl, data_l, function(response) {
			if(response !== undefined){
				response = JSON.parse(response);
				console.log(response);
			}
		});
	}
	
	function simplelender_delete_args_on_server(i){
		$("#simplelender_close_args_"+i).click(function(){
			args_id= $("#simplelender_id_args_"+i).val();
			if(args_id>0){
				simplelender_del_args(args_id);
			}
		});
	}
	
	$('#simplelender_add_args_node').click(function(e){
		e.preventDefault();
		$('#simplelender_additional_args').before('<tr id="simplelender_main_row_args_'+simplelender_next_args_node+'"><td><input id="" name="more_data[simplelenderWebhookArgs]['+simplelender_next_args_node+'][key_name]" type="text" value="" class="simplelender_input_feild"></td><td><input id="" name="more_data[simplelenderWebhookArgs]['+simplelender_next_args_node+'][value]" type="text" value="" class="simplelender_input_feild"> <input id="simplelender_id_args_'+simplelender_next_args_node+'" name="more_data[simplelenderWebhookArgs]['+simplelender_next_args_node+'][type]" type="hidden" value="body" > </td><td><center><span class="simplelender_close_args_class" id="simplelender_close_args_'+simplelender_next_args_node+'">[X]</span></center></td></tr><br>');
		simplelender_close_args(simplelender_next_args_node);
		simplelender_next_args_node++;
	});
	
	$('#simplelender_add_header_args_node').click(function(e){
		e.preventDefault();
		$('#simplelender_additional_header_args').before('<tr id="simplelender_main_row_args_'+simplelender_next_args_node+'"><td><input id="" name="more_data[simplelenderWebhookArgs]['+simplelender_next_args_node+'][key_name]" type="text" value="" class="simplelender_input_feild"></td><td><input id="" name="more_data[simplelenderWebhookArgs]['+simplelender_next_args_node+'][value]" type="text" value="" class="simplelender_input_feild"> <input id="simplelender_id_args_'+simplelender_next_args_node+'" name="more_data[simplelenderWebhookArgs]['+simplelender_next_args_node+'][type]" type="hidden" value="header" > </td><td><center><span class="simplelender_close_args_class" id="simplelender_close_args_'+simplelender_next_args_node+'">[X]</span></center></td></tr><br>');
		simplelender_close_args(simplelender_next_args_node);
		simplelender_next_args_node++;
	});
	$('#simplelender_tags_switcher').change(function(){
		simplelender_tags_switcher = $('#simplelender_tags_switcher').val();
		
		if(simplelender_tags_switcher == 'simplelender_borrower_tags'){
			$('.simplelender_borrower_tags').css({"display": "list-item"});
			
			$('.simplelender_more_tags').hide();
			$('.simplelender_loan_tags').hide();
		}
		else if(simplelender_tags_switcher == 'simplelender_loan_tags'){
			$('.simplelender_loan_tags').show();
			
			$('.simplelender_more_tags').hide();
			$('.simplelender_borrower_tags').hide();
		}
		
		else if(simplelender_tags_switcher == 'simplelender_more_tags'){
			$('.simplelender_more_tags').show();
			
			$('.simplelender_borrower_tags').hide();
			$('.simplelender_loan_tags').hide();
		}

	});
	
	if(typeof simplelender_next_args_node  == 'undefined'){
		simplelender_next_args_node='';
	}
	
	for(var i=0; i < simplelender_next_args_node ; i++ ){
		simplelender_delete_args_on_server(i);
		simplelender_close_args(i);
	}
	
	$('.simplelender_borrower_tags').css({"display": "list-item"});

});

