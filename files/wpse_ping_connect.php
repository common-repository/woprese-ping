<?php 

/* 
Copyright (C) www.woprese.com - All Rights Reserved!
Author - MyAllenMedia, LLC
WordPress Search Engine Plugin
contact@woprese.com

*/

//SETTING UP THE OPTIONS PAGE
function wpse_ping_connect($url) {
	if (function_exists('curl_init')) 
	{
		$ch = curl_init($url);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_ENCODING, "");           // handle all encodings 
        curl_setopt($ch, CURLOPT_USERAGENT, "spider");    // who am i 
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);      // set referer on redirect 
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);          // stop after 10 redirects 
		
		//echo 'curl is here'.$ch;
		$data=curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($httpcode>=200 && $httpcode<400){
			return true;
		} else {
			return false;
		}
		 
	} 
	else 
	{
		//return file_get_contents($url);
		echo 'curl not init';
	}
}

function wpse_ping($posts = NULL) {
	if($posts != NULL) 
	{
		foreach($posts as $post) {
			$pinglerURL = wpse_build_url($post);
			
			$pinglerMSG = wpse_ping_connect($pinglerURL);
			echo "<p>".$pinglerMSG."</p>";
		}
	} 
	else 
	{
	//	echo '<br>ping';
		global $post;
		$thisCount = 1;
		$myposts = get_posts('numberposts=-1');
		foreach($myposts as $post) :
			setup_postdata($post);
			$pinglerURL = wpse_build_url($post->ID);
			$result= wpse_ping_connect($pinglerURL);
		
		
		//	echo "<p>url>>".$pinglerURL."</p>";
		endforeach;
		if($result)
		{
			return "Process Completed Successfully.";
		}
		else 
		{
			return "Sorry! Process Couldn't Completed Successfully.";
		}
	}
}


function wpse_build_url($post_ID = NULL) 
{
	if($post_ID != NULL) 
	{
	$thisPost = get_post($post_ID, ARRAY_A);
  	$pinglerOPT .= '&url='.get_permalink( $post_ID );
		 
	$siteUrl=get_bloginfo('url');

	return 'http://www.woprese.com/?woprese_pingomatic=yes'.$pinglerOPT.'&mainUrl='.$siteUrl;
	
	
	}
	else 
	{
		$siteUrl=get_bloginfo('url');
		$adminemail=get_option('admin_email');
		
		return 'http://www.woprese.com/?firstPing=add&mainUrl='.$siteUrl.'&email='.$adminemail;
	}
}

function wpse_first_ping() // first ping will called when  plugin activated
{
		$pinglerURL = wpse_build_url();
		$result= wpse_ping_connect($pinglerURL);
	//	echo 'url=='.$pinglerURL;
}
  

?>