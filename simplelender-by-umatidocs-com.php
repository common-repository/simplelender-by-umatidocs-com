<?php

/* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
/*
Plugin Name: Simplelender
Plugin URI: https://www.simplelender.website/
Description: A complete digital marketing tool for lenders on wordpress.
Author: Simplelender
Version: 1.3.14
Author URI: https://www.simplelender.website/
*/

if ( !function_exists( 'simplelender_plugin_active' ) ) {
    function simplelender_plugin_active( $plugin )
    {
        return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
    }

}
if ( !function_exists( 'simplelender_avoid_double_install' ) ) {
    function simplelender_avoid_double_install()
    {
        if ( simplelender_plugin_active( "simplelender-by-umatidocs-com/simplelender-by-umatidocs-com.php" ) ) {
            wp_die( 'There is an existing simplelender version active on your website. Please deactivate the existing simplelender plugin and reactivate the new plugin.' );
        }
    }

}

if ( !defined( 'WP_SIMPLELENDER__PLUGIN_DIR' ) ) {
    $dir_name = basename( dirname( __FILE__ ) );
    define( 'WP_SIMPLELENDER__PLUGIN_DIR', $dir_name );
    define( 'WP_SIMPLELENDER__PLUGIN_URL', plugins_url( plugin_basename( WP_SIMPLELENDER__PLUGIN_DIR ) ) );
}

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'simplelender_fs' ) ) {
    simplelender_fs()->set_basename( false, __FILE__ );
} else {

    if ( !function_exists( 'simplelender_fs' ) ) {
        // Create a helper function for easy SDK access.
        function simplelender_fs()
        {
            global  $simplelender_fs ;
            
            if ( !isset( $simplelender_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $simplelender_fs = fs_dynamic_init( array(
                    'id'              => '2939',
                    'slug'            => 'simplelender-by-umatidocs-com',
                    'type'            => 'plugin',
                    'public_key'      => 'pk_7e31bf3f6589499648c453f9ed078',
                    'is_premium'      => false,
                    'has_addons'      => false,
                    'has_paid_plans'  => true,
                    'trial'           => array(
                    'days'               => 14,
                    'is_require_payment' => true,
                ),
                    'has_affiliation' => 'all',
                    'menu'            => array(
                    'slug'    => 'mvc_simplelender_clientloannotes',
                    'support' => false,
                ),
                    'is_live'         => true,
                ) );
            }
            
            return $simplelender_fs;
        }
        
        // Init Freemius.
        simplelender_fs();
        // Signal that SDK was initiated.
        do_action( 'simplelender_fs_loaded' );
    }
	
	simplelender_fs();	
}

register_activation_hook( __FILE__, 'simplelender_avoid_double_install' );
//register_deactivation_hook( __FILE__, 'simplelender_avoid_double_install' );

function simplelender_is_plugin_active( $plugin )
{
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}

require_once dirname( __FILE__ ) . '/app/functions/functions.php';
register_activation_hook( __FILE__, 'simplelender_activate' );
register_deactivation_hook( __FILE__, 'simplelender_deactivate' );
function simplelender_activate()
{
    ob_start();
    global  $wp_rewrite ;
    require_once dirname( __FILE__ ) . '/simplelender_loader.php';
    $loader = new simplelenderLoader();
    $loader->activate();
    $wp_rewrite->flush_rules( true );
    ob_get_clean();
	GFForms::activation_hook();
}

function simplelender_deactivate()
{
    global  $wp_rewrite ;
    require_once dirname( __FILE__ ) . '/simplelender_loader.php';
    $loader = new simplelenderLoader();
    $loader->deactivate();
    $wp_rewrite->flush_rules( true );
}

function simplelender_loadmanager()
{
    simplelender_class( 'simplelender_init' )->init();
}

add_action(
    'init',
    'simplelender_loadmanager',
    8888,
    1
);