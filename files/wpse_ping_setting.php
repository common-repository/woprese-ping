<?php 

/* 
Copyright (C) www.woprese.com - All Rights Reserved!
Author - MyAllenMedia, LLC
WordPress Search Engine Plugin
contact@woprese.com

*/

  
//error_reporting (0);
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
 


?>
<?php
global $wpdb ; 
$WPSE_PING_SETTING_TABLE = $wpdb->prefix .WPSE_PING_SETTING_TABLE;

include_once(WP_WPSE_ABSPATH.'files/wpse_ping_connect.php');
include_once(WP_WPSE_ABSPATH.'wpse_ping_validation_functions.php');

//echo WP_WPSE_ABSPATH.'wpse_ping_connect';
if(isset($_POST['save']))
{
	$status=sanitizeData($_POST['ping_status'],'xss_clean');
	
	$updateQuery="UPDATE $WPSE_PING_SETTING_TABLE SET ping_plugin_status='$status'";
	$wpdb->query($wpdb->prepare($updateQuery));
	//echo $updateQuery;
}
$getStatus="SELECT ping_plugin_status FROM $WPSE_PING_SETTING_TABLE";
$pingingStatus=$wpdb->get_var($wpdb->prepare($getStatus));
//echo $pingingStatus.$getStatus;

if(isset($_POST['submit_ping'])) 
{
	// check if what is the pinging status set by admin
		
		if($pingingStatus) // if ping
		{
		 $msg=wpse_ping();
		}
		else 
		{
			$msg="First set pinging to yes, then again press Run Update Service button.";
		}
} 

?>

<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>Woprese</h2><br><br>
 </div>
<div class="wrap">
 <div id="poststuff">
	<div id="post-body">
		<div style="font-weight: bold; text-align: center;"><?php if(isset($msg)) echo $msg;?></div><br>
	 
		
<div class="postbox">
	<h3>
		<label for="title">Settings</label>
	</h3>
	<div class="inside">
		<form action="" method="post">
			<table>
				<tr>
					<td width="8%">
						Pinging:
					</td>
					<td width="9%"><select name="ping_status" style="width: 60px">
						<option value="1" <?php if($pingingStatus == 1) echo 'selected="selected"';?>>Yes</option>
						<option value="0"  <?php if($pingingStatus == 0) echo 'selected="selected"';?>>No</option>
					</select> 
					
				   </td>
				  <td >
				  	If you turn OFF then Woprese.com will not receive any of your new or changed posts.<br>
					Woprese Pinging won't put any extra load on your server for it only pings one time for every post you publish. 
				  </td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" value="Save" name="save" size="3"/>	
					</td>
					<td>&nbsp;</td>
				</tr>
				
			</table>
		</form>
</div></div>


<div class="postbox">
	<h3>
		<label for="title">Update</label>
	</h3>
	<div class="inside" style="height: 122px">
		<form action="" method="post">
			<table>
				<tr>
					<td width="8%">
						Update:
					</td>
					<td><input type="submit" value="Run Update Service" name="submit_ping" size="6"/>	
					By clicking the Run Update Service button,it will index all your existing posts.
				 </td>
				</tr>
				
				
			</table>
		</form>
</div></div>

</div>
</div>
</div>