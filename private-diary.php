<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.aicxy.com
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       Private Diary
 * Plugin URI:        http://www.aicxy.com/private-diary-uri/
 * Description:       this is a private diary plugin for wordpress
 * Version:           1.0.0
 * Author:            xiaoyou.chen
 * Author URI:        http://www.aicxy.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       private-diary
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-private-diary-activator.php
 */
function activate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-private-diary-activator.php';
	Plugin_Name_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-private-diary-deactivator.php
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-private-diary-deactivator.php';
	Plugin_Name_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_name' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-private-diary.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new Plugin_Name();
	$plugin->run();

}
run_plugin_name();

function plugin_menus(){

    add_menu_page("Private Diary","Private Diary",'manage_options',"private_diary","index");

}

function index(){
    echo file_get_contents(plugin_dir_path(__FILE__) . '/admin/views/index.php');

}

add_action("admin_menu","plugin_menus");


function installer(){
    include("installer.php");
}

register_activation_hook(__file__,'installer');

function register_shortcodes(){
    add_shortcode('private_diary', 'index');
}

add_action("init",'register_shortcodes');


add_action('rest_api_init', function () {
    register_rest_route('private_diary/v1', '/history', array(
        'methods' => 'GET',
        'callback' => 'history',
        'args' => array(
            'year' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return is_numeric($param);
                }
            ),
        ),
    ));
});

add_action('rest_api_init', function () {
    register_rest_route('private_diary/v1', '/store', array(
        'methods' => 'POST',
        'callback' => 'store',
        'args' => array(
            'content'
        ),
    ));
});
function history(){
    global $wpdb;
    $table = $wpdb->prefix.'private_diary';
    $posts = $wpdb->get_results("SELECT * FROM $table  ORDER BY ID DESC LIMIT 0,4");
   // return new WP_Error( 'no_author', 'Invalid author', array( 'status' => 404 ) );
    return new WP_REST_Response( $posts, 200 );
}
function store($req){
    $content=$req['content'];
    $date=$req['date'];
    $weather=$req['weather'];


    global $wpdb;
    $table = $wpdb->prefix.'private_diary';
    $data = array('date' => $date,'weather'=>$weather ,'content' => $content,'created_at' => date("Y-m-d H:i:s"));
    $format = array('%s','%s','%s');
    $wpdb->insert($table,$data,$format);
    $my_id = $wpdb->insert_id;
    return new WP_REST_Response( $my_id, 200 );

}