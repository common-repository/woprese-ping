<?php

/* 
Copyright (C) www.woprese.com - All Rights Reserved!
Author - MyAllenMedia, LLC
WordPress Search Engine Plugin
contact@woprese.com

*/

//build menus

if (is_admin()){ 
 
	add_action('admin_menu', 'wpse_ping_add_pages');
	
	 

}

// Function to Create Menu and submenu in Admin:

// action function for above hook

function wpse_ping_add_pages() 
{

      $optionpage_top_level = "Woprese";

      // userlevel=8 restrict users to "Administrators" only 

     // Add a new submenu under Options:

   // add_options_page('Test Options', 'Test Options', 'administrator', 'testoptions', 'wps_options_page');

   // Add a new top-level menu (ill-advised): add_menu_page(page_title, menu_title, capability, handle, [function], [icon_url])

  add_menu_page($optionpage_top_level,$optionpage_top_level, 'administrator', 'wpse-admin-sub-page1', 'wpse_setting_page');

  // Add a submenu to the custom top-level menu: add_submenu_page(parent, page_title, menu_title, capability required, file/handle, [function])

  add_submenu_page('wpse-admin-sub-page1', 'Settings', 'Settings', 'administrator', 'wpse-admin-sub-page1', 'wpse_setting_page');
  //add_submenu_page('wpse-admin-sub-page1', 'Cron Jobs', 'Cron Jobs', 'administrator', 'wpse-admin-sub-page1', 'wpse_cron_page');
 
	
}

// wps_settings_page() displays the page content for the Settings submenu

// of the wps ADMIN Toplevel menu

function wpse_setting_page()
{
   include( WP_WPSE_ABSPATH . 'files/wpse_ping_setting.php');
}
 ?>