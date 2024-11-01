<?php

/* 
Copyright (C) www.woprese.com - All Rights Reserved!
Author - MyAllenMedia, LLC
WordPress Search Engine Plugin
contact@woprese.com

*/

include_once('simple_html_dom.php');




function urlExists($url=NULL)
	{
		if($url == NULL) return false;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch,CURLOPT_HEADER,true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_ENCODING, "");           // handle all encodings 
        curl_setopt($ch, CURLOPT_USERAGENT, "spider");    // who am i 
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);      // set referer on redirect 
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);          // stop after 10 redirects 
		$data = curl_exec($ch);
		
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($httpcode>=200 && $httpcode<400){
			return true;
		} else {
			return false;
		}
	}
	
	function checkWordpressSite($term,$url)
	{
				$sitemapUrl=$url.'/sitemap.xml';
				$sitemapResult=urlExists($sitemapUrl);
				//$sitemapResult=true;
				if($sitemapResult==true)
				{
					return true;
				}
				else 
				{
					return false;
				}
			
				
		
			
	} 

?>