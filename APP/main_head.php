<?php

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// GLOBAL DEFINITIONS: These variables are used site wide.  Befoere creating a variable or running a query please make sure
// it has not been first defined here.  No need for extra queries and variables to make things more confusing
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
include_once "dbcon/php_functions.php";
$pg_encrypt_key = "4Trin3bm12013formetrics";


//User Profile items pulled from query
//if you change this make sure to change it in the update_query.php under qryPROFILE
	$fname = mysqltng_result( $res,0,"USR_fname" );
	$lname = mysqltng_result( $res,0,"USR_lname" );
	$USR_id = mysqltng_result( $res,0,"USR_id" );
	$USR_mSal = mysqltng_result( $res,0,"USR_mSal" );
	$USR_unAllocated = mysqltng_result( $res,0,"USR_unAllocated" );
	if(!isset($_SESSION['userid'])){
		$_SESSION['userid'] = pg_encrypt($USR_id,$pg_encrypt_key,"encode");
	}
	///$username_value =  mysqltng_result($res,0,'TA_uname');

	///$TA_first_name =  mysqltng_result($res,0,'TA_first_name');

//this is used when getting $_GET[pg] it sets an include address that pulls in specific page content
	$include_address = "";
	$FULL_URL = curPageURL();
	$BASE_URL_exp = explode('APP/', $FULL_URL);
	$BASE_URL = $BASE_URL_exp[0]."APP";

//Site email address.  This email is used site wide for alert / error emails 
	$site_email = "michael.keough@dumasisd.org"; //david I took you off of here as I was testing didnt think you wanted 100 emails Lol
//Client id: This id is specific to the client the user is under.  We want to make sure some items are displayed by client id
// such as calendar or other data so we are not showing things to users who are not members of that client
//set the default page to general. used for default page and on the scripting page to pull the correct script
	$page = 'general';
	
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// GLOBAL DEFINITIONS: End of Globals
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<?php
include "page_content/header.php";	
/*
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
 POST PROCESSOR: This section is used for post data as information is gathered from $_POST[post_type]
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
*/	
		//every form in the site should have a hidden field with id and name of post_type
		//this defines what post we are actually doing
		// for instance <input type='hidden' id='post_type' name='post_type' value='update_prof'>
		// will will call dbquery/profile/index.php and will pull the qry_update_prof.php
		
		if(isset($_POST['post_type'])){
			//all post operators are found in the dbquery/index.php file
			$post_page = $conn->real_escape_string($_POST['post_type']);
			$post_page = pg_encrypt($post_page,$pg_encrypt_key,"decode");
			$post_page = str_replace('-','/',$post_page);
			include_once "dbquery/".$post_page.".php";
			
		}
		
/*
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
 END POST PROCESSOR
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@


@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
 PAGE Processor
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
*/

	 		if($include_address == ""){
			$include_address = "page_content/index.php";
		}
		if(isset($_GET['P'])){
			//set the page we are trying to access
			$page = $_GET['P'];
			
			$page = pg_encrypt($page,$pg_encrypt_key,"decode");

			//pages are retrieved from the GET function ie dashboard.php?pg=community-calendar
			//replace the - with / so we have a usable data structure for the actual directory and file
			$FOLDER_EXP = explode("-",$page);
			$folder = $FOLDER_EXP[0];
			$page = $FOLDER_EXP[1];
			//$page = str_replace('-','/',$page);
				$include_address = "page_content/".$folder."/".$page.".php";
				
		}  


/*
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
 End Page Processor
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
*/
?>	
<!--
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
 pAGE hEADER
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
-->
<?php
			
			
			if(isset($_GET['P'])){
				$file_header = 'page_content/'.$folder.'/header_'.$page.'.php';
				if( file_exists( $file_header )){
					include $file_header;

					//rename( $f, $f.".willnotwork" ); //It gives a warning 
				}
				
			
			}							
?>
<!--
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
 END PAGE HEADER
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
-->

</head>

<body >
