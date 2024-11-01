<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

MvcConfiguration::set(array(
    'Debug' => false
));

$sl_menu_item = array(
    'AdminPages' => array(
    	'simplelender_clientloannotes' => array(
                'icon'=>'dashicons-chart-area',
                'label'=>'<b>Simplelender</b>',
                'add'=> array(
                    'label' => 'Statistics',
                    'in_menu' => false,
                ),
            ),
    	'simplelender_loansettings' => array(
			'label'=>'Loan Products',
			'add'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'process'=> array(
                'label' => __('process', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'add'=> array(
                'label' => __('add', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'parent_slug'=>'mvc_simplelender_clientloannotes',
        ),
        'simplelender_messages' => array(
            'label'=>'Communications',
            'add'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'create_ticket'=> array(
                'label' => __('message_room', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'message_room'=> array(
                'label' => __('message_room', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'add'=> array(
                'label' => __('add', 'wpmvc'). ' ',
                'in_menu' => false
            ), 
            'go_pro'=> array(
                'label' => __('add', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'mark_as_resolved'=>array(
                'label' => __('add', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'unresolved_index'=> array(
                'label' => __('add', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'parent_slug'=>'mvc_simplelender_clientloannotes',
        ),
        'simplelender_dentries' => array(
            'label'=>'Transactions',
            'transaction_list'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'process'=> array(
                'label' => __('process', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'repay'=> array(
                'label' => __('repay', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'payment_done'=> array(
                'label' => __('payment_done', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'parent_slug'=>'mvc_simplelender_clients',
        ),
        'simplelender_clientloans' => array(
            'icon'=>'dashicons-chart-area',
            'label'=>'Loan Applications',
            'add'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'process'=> array(
                'label' => __('process', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'goal_info'=>array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'more_loan_info'=>array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'index_select'=>array(
                'label' => __('index_select', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'parent_slug'=>'mvc_simplelender_clientloannotes',
        ),
        'simplelender_clientaccounts' => array(
            'label'=>'Borrowers',
            'add'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'process'=> array(
                'label' => __('process', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
			'add'=> array(
                'label' => __('add', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'parent_slug'=>'mvc_simplelender_clientloannotes',
        ),
        'simplelender_webhook_logs' => array(  
            'add'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'add'=> array(
                'label' => __('ad', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'download_logs'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'clear_logs'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'hide_menu'=> true,
            'parent_slug'=>'mvc_simplelender_webhooks',
        ),        
        'simplelender_webhooks' => array(
            'label'=>'Custom eMail',    
            'add'=> array(
                'label' => 'Statistics',
                'in_menu' => false,
            ),
            'go_pro'=> array(
                'label' => __('ad', 'wpmvc'). ' ',
                'in_menu' => false,
            ),
            'delete'=> array(
                'label' => __('Delete', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'edit'=> array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'resend_failed_webhook'=>array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'view_logs'=>array(
                'label' => __('edit', 'wpmvc'). ' ',
                'in_menu' => false
            ),
            'parent_slug'=>'mvc_simplelender_messages',
        ),
        'simplelender_mailchimps' => array(
                'label'=>'Mailchimp Settings',
                'index'=> array(
                    'label' => 'Statistics',
                    'in_menu' => false,
                ),
                'settings_two'=> array(
                    'label' => __('edit', 'wpmvc'). ' ',
                    'in_menu' => false
                ),
                 'parent_slug'=>'mvc_simplelender_messages',
        ),
    )
);

MvcConfiguration::append($sl_menu_item);

add_action('mvc_admin_init', 'simplelender_on_mvc_admin_init');
add_action('init','simplelender_public_resources');

function simplelender_public_resources($options) {
    wp_enqueue_style('sl_style_public', mvc_css_url(WP_SIMPLELENDER__PLUGIN_DIR, 'style_public'));
    
    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'jquery-ui-datepicker' );
	
    wp_enqueue_script( 'sl-main-lib-uploader-js', mvc_js_url(WP_SIMPLELENDER__PLUGIN_DIR, 'public-script') , array('jquery') );
	wp_localize_script( 'sl-main-lib-uploader-js', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
    
    // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
    wp_enqueue_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );   

    wp_enqueue_style('simplelender-mvc_admin', mvc_css_url(WP_SIMPLELENDER__PLUGIN_DIR, 'wh-style'));
    wp_enqueue_script( 'simplelender-clipboard-js', mvc_js_url(WP_SIMPLELENDER__PLUGIN_DIR, 'clipboard.min.js') , array() );
    
    // Your custom js file
    wp_enqueue_script( 'simplelender-media-lib-uploader-js', mvc_js_url(WP_SIMPLELENDER__PLUGIN_DIR, 'wh-script') , array('jquery') );
    wp_localize_script( 'simplelender-media-lib-uploader-js', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    // Your custom js file
    wp_enqueue_script( 'sl-calc-lib-uploader-js', mvc_js_url(WP_SIMPLELENDER__PLUGIN_DIR, 'accrue') , array('jquery') );
}

function simplelender_on_mvc_admin_init($options) {
    
    wp_enqueue_style('sl-mvc_admin', mvc_css_url(WP_SIMPLELENDER__PLUGIN_DIR, 'style'));
   
    //Core media script
    wp_enqueue_media();

    // Your custom js file
    wp_enqueue_script( 'sl-media-lib-uploader-js', mvc_js_url(WP_SIMPLELENDER__PLUGIN_DIR, 'main-script') , array('jquery') );
    wp_localize_script( 'sl-media-lib-uploader-js', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    
    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'jquery-ui-datepicker' );

    // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
    wp_enqueue_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
	wp_enqueue_script( 'simplelender-copy-lib-uploader-js', mvc_js_url(WP_SIMPLELENDER__PLUGIN_DIR, 'clipboard.min.js') , array() );
    
    wp_enqueue_style('simplelender-mvc_admin', mvc_css_url(WP_SIMPLELENDER__PLUGIN_DIR, 'wh-style'));
    wp_enqueue_script( 'simplelender-clipboard-js', mvc_js_url(WP_SIMPLELENDER__PLUGIN_DIR, 'clipboard.min.js') , array() );
    
    // Your custom js file
    wp_enqueue_script( 'simplelender-media-lib-uploader-js', mvc_js_url(WP_SIMPLELENDER__PLUGIN_DIR, 'wh-script') , array('jquery') );
    wp_localize_script( 'simplelender-media-lib-uploader-js', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
?>