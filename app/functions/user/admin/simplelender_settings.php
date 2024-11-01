<?php
    if ( simplelender_fs()->is_plan('growth') ) {
    require_once dirname(__FILE__).'/simplelender_webhook_manager.php';
    require_once dirname(__FILE__).'/simplelender_mail_manager.php';
    simplelender_class('simplelender_mail_manager')->init();
    simplelender_class('simplelender_webhook_manager')->init();
    function simplelenderSettingsInit()
    {
        // register a new setting for "wporg" page
        register_setting('simplelender', 'simplelender_allow_retrys');
    	//register_setting('simplelender', 'simplelender_number_of_retrys');
        register_setting('simplelender', 'simplelender_parameter_encoding_type');
    	
        // register a new section in the "wporg" page
        add_settings_section(
            'simplelender_section',
            __('Settings', 'simplelender_settings'),
            'simplelenderSectionInput',
            'simplelender'
        );
    	
        // allow the user to enable or disable retries.
        add_settings_field(
            'simplelender_allow_retrys',
            'Allow retrys',
            'simplelenderAllowRetrys',
            'simplelender',
            'simplelender_section',
            array(
                'label_for' => 'simplelender_allow_retrys',
                'class' => 'simplelender-row',
                'simplelender_custom_data' => 'custom'
            )
        );
    }

    function simplelenderSectionInput($args)
    {
    ?>
        <p id="<?php echo esc_attr($args['id']); ?>">
            <?php esc_html_e('Use this page to change your settings.', 'simplelender_settings'); ?>
        </p>
    <?php
    }

    function simplelenderAllowRetrys($args)
    {
        $path = get_option('simplelender_allow_retrys');
        $var = esc_attr($args['label_for']);
    ?>
        <select name="<?php echo $var?>" id="<?php echo $var?>" class="large-text" >
    		<option class="" value="yes" <?php ($path=='yes' || !isset($path))? $Selected='selected="selected"':$Selected=""; echo $Selected; unset($Selected); ?> >Yes</option>
            <option class="" value="no"  <?php ($path=='no')? $Selected='selected="selected"':$Selected=""; echo $Selected; unset($Selected); ?> >No</option>
        </select>
    <?php
    }

    function simplelenderOptionsPage()
    {
        // add top level menu page
        add_submenu_page(
            'options-general.php',
            'simplelender',
            'simplelender',
            'manage_options',
            'simplelender',
            'simplelenderOptionsPageHTML'
        );
    }

    //add_action('admin_menu', 'simplelenderOptionsPage');

    function simplelenderOptionsPageHTML()
    {
        /**
         * Check user capabilities
         */
        if (!current_user_can('manage_options')) {
            return;
        }
    ?>
    <center>
    	<div class = "simplelender_menu_html" style="margin-left:25px;	margin-top:40px;">	
    		<div>
    			<span class="wp-core-ui button-primary" >
    				<a class="simplelender_menu_item_a" style="padding:20px; color:#fff; text-decoration:none;" href="<?php menu_page_url("simplelender"); ?>">General</a>
    			</span>
    			<span class="simplelender_menu_item" style="background-color:gray;
    				color:#fff;
    				padding:5px;
    				text-decoration:none;
    				border-radius:2px;
    				margin:2px;">
    				<a class="simplelender_menu_item_a" style="padding:20px; color:#fff; text-decoration:none;" href="<?php echo mvc_admin_url(array("controller" => "simplelender_webhooks", "action" => "index", "id" =>"" )); ?>">Notifications</a>
    			</span>
    			
    			<span class="simplelender_menu_item" style="background-color:gray;
    				color:#fff;
    				padding:5px;
    				text-decoration:none;
    				border-radius:2px;
    				margin:2px;">
    				<a class="simplelender_menu_item_a" style="padding:20px; color:#fff; text-decoration:none;" href="<?php echo mvc_admin_url(array("controller" => "simplelender_triggers", "action" => "index", "id" =>"")); ?>">Triggers</a>
    			</span>
    			
    		</div>
    	</div>
    </center>
    	
    <div class="wrap">
    <div class="wrap simplelender_input" style="border-radius:5px;
     padding:30px;
     margin:20px;
     background:#fff;">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    	
    	<hr>
        <form action="options.php" method="post">
            <?php
            settings_fields('simplelender');
            do_settings_sections('simplelender');
            ?><br><br>
    		<center id='final' >
    	<input class="wp-core-ui button-primary" type="submit" name="submit" id="submit" value="Save Settings">
    </center>
        </form>
    </div>
    </div>
    <?php
    }
}
    ?>
