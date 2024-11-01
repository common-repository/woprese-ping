<?php 
/* 
Copyright (C) www.woprese.com - All Rights Reserved!
Author - MyAllenMedia, LLC
WordPress Search Engine Plugin
contact@woprese.com

*/
include("table_names.php");

include("functions.php");

//echo '<br>general';
// main function to create tables

function create_wpse_ping_tables () 
{

//new in version 1.1. sets the database value to the wordpress database prefix

global $wpdb;

 //  1. Create Table $WPS_SITE_VERIFICATION_TABLE

    $WPSE_PING_SETTING_TABLE = $wpdb->prefix .WPSE_PING_SETTING_TABLE;

    // check condition if table exists

    if($wpdb->get_var("show tables like '$WPSE_PING_SETTING_TABLE'") != $WPSE_PING_SETTING_TABLE) 
      {
	  $wpdb->query( $wpdb->prepare( "CREATE TABLE $WPSE_PING_SETTING_TABLE (ping_plugin_status enum('1','0'))"));

	  $wpdb->query( $wpdb->prepare( "INSERT INTO $WPSE_PING_SETTING_TABLE SET ping_plugin_status='1'" ));
       }
	
 }

?>
