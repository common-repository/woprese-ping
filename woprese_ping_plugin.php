<?php
/*
Plugin Name: Woprese Ping
Plugin URI: http://www.woprese.com/submit/
Description: Get all of your WordPress Blogs indexed by the Woprese Search Engine.
Version: 2.8
Author: Woprese
Author URI: http://www.woprese.com/
*/

//error_reporting (0);
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
 

if ( !defined( 'WP_WPSE_ABSPATH' ) )
   define( 'WP_WPSE_ABSPATH', plugin_dir_path( __FILE__ ) );
if ( !defined( 'WP_WPSE_FILE' ) )
   define('WP_WPSE_FILE',basename(__FILE__));

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) 
{
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

if (!function_exists('wpse_check_sitemap')) 
{
	function wpse_check_sitemap()
	{
		include_once(WP_WPSE_ABSPATH.'wpse_site_verification.php');
		$site_url=get_bloginfo('url');
		$xmlResult=checkWordpressSite('sitemap',$site_url);
		if(!$xmlResult)
			{
				
				return FALSE;	
			 }
		else
			{
				return TRUE;
			}
			
	}

}



if(wpse_check_sitemap()==false)
{
			$error="ERROR! Sorry,your site require sitemap.xml file before the plugin can be activated.\n We recommend the plugin for WordPress called Google Sitemap XML,
				 which is a free download from wordpress.org.";
		wp_die(sprintf($error));
}
 
 


include( WP_WPSE_ABSPATH . 'files/includes/general.php');  


 

//createtables();
add_action('plugins_loaded','wpse_ping_create_tables');
function wpse_ping_create_tables()
{
if (function_exists('create_wpse_ping_tables')) {
create_wpse_ping_tables();
}
}

if (!function_exists('wpse_myplugin_activate'))
	{
		function wpse_myplugin_activate()
		{
			//echo 'calling';
		  include_once('wpse_ping_support.php');
	 	}
	}	
	
register_activation_hook( __FILE__, 'wpse_myplugin_activate' );

function wpse_ping_my_post($post_id) 
{
	$type=get_post_type( $post_id ) ;

	if($type=="post") // we will send ping only on post
	{	
		global $wpdb ; 	
	
		//first we will check if site ower set pinging to yes
		$WPSE_PING_SETTING_TABLE = $wpdb->prefix .WPSE_PING_SETTING_TABLE;
		$checkPingingStatus="select ping_plugin_status from $WPSE_PING_SETTING_TABLE ";
		$pingStatus=$wpdb->get_var($checkPingingStatus);
		
		if($pingStatus) // if ping
		{
			 include_once('wpse_ping_mypost.php');
		}
	
	}
}

 

add_filter('publish_post', 'wpse_ping_my_post');
 








 
?>