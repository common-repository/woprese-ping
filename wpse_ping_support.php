<?php
 		 global $wpdb;
		 
		include_once(WP_WPSE_ABSPATH.'files/wpse_ping_connect.php');
	  	
	  	$email="activation@woprese.com";
	      
       	$siteurl=get_option('siteurl');
		$adminemail=get_option('admin_email');

		$email_subject = "Plugin activation information";
		$email_body = "The following domain just activated the Woprese Ping Plugin:\n 
	
		Site Address (URL): $siteurl \n 
		Site Admin Email Address: $adminemail  \n";
		//$headers = "From:$email \n"; 
		$from=$adminemail; /// we are sending the mail from the admin email address
		$headers .= "From: $from";
		wp_mail($email,$email_subject,$email_body,$headers);	
		
		$msg=wpse_first_ping();
		
	
?>
