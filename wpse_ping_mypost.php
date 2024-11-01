<?php
 $post = get_post($post_id);
	
	   
	$url="http://www.woprese.com/";
	
	$postUrl=get_permalink($post_id); // post url
	$mainUrl=get_bloginfo('url'); // main site url
	 
    $response = wp_remote_get( $url, array(
	'method' => 'POST',
	'timeout' => 160,
	'redirection' => 5,
	'httpversion' => '1.0',
	'blocking' => true,
	'headers' => array(),
	'body' => array( 'woprese_pingomatic' => 'yes','url'=>$postUrl,'mainUrl'=> $mainUrl),
	'cookies' => array()
    )
	);
?>