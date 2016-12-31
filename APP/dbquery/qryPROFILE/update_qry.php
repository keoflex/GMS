<?php
/************************************
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
************************************/

$element = "Profile";
$element_function = "Updated";
//Define Variables for the form
$USR_pass = $conn->real_escape_string($_POST["set_pass"]);
$USR_passC = $conn->real_escape_string($_POST["set_pass_conf"]);

$USR_fname =$conn->real_escape_string($_POST['user_first_name']);
$USR_lname = $conn->real_escape_string($_POST['user_last_name']);
$USR_username = $conn->real_escape_string($_POST['user_email']);
if($USR_pass == $USR_passC){
	if($USR_pass != ''){
		$USR_pass = sha1($USR_pass.$loginSeed);
		$USR_pass = ", USR_pass = '".$USR_pass."'";
	}
	
	//form query
	$qry = "UPDATE users SET 
	
	USR_fname = '".$USR_fname."',
	USR_lname = '".$USR_lname."',
	USR_username = '".$USR_username."'
	".$USR_pass."
	WHERE USR_id = ".$USR_id; //$TA_id is defined at the top of dashboard_main.php
	$message = "No query ran!!!";
	///echo $qry;
	
	
	$QUERY_PROCESS = mysqltng_query($qry);
	//call query process to make sure there are not errors in the query
	require_once("dbquery/QUERY_PROCESS.php");

//fix profile info when updated
$loginCheck = "SELECT * FROM users where USR_username='".$USR_username."'";
$res=mysqltng_query($loginCheck);
//if you change this info make sure to change it under the main_head.php
$fname = mysqltng_result( $res,0,"USR_fname" );
$lname = mysqltng_result( $res,0,"USR_lname" );
$USR_id = mysqltng_result( $res,0,"USR_id" );
}else{
	?>
        <div class="alert alert-error">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>ERROR!!: </strong> Your passwords do not match.
      
   
    </div>
    <?php
}

?>