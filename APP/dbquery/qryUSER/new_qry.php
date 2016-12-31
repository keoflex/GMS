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


$element = "User";
$element_function = "Created";
//Define Variables for the form


$USR_fname =$conn->real_escape_string($_POST['first_name']);
$USR_lname = $conn->real_escape_string($_POST['last_name']);
$USR_username = $conn->real_escape_string($_POST['user_email']);
$USR_pass = $conn->real_escape_string($_POST['user_password']);
$USR_pass_confirm = $conn->real_escape_string($_POST['user_password_confirm']);

if($USR_pass == $USR_pass_confirm){	
	//form query
	$USR_pass = sha1($USR_pass.$loginSeed);
	
	$qry = "insert into users(USR_fname, USR_lname, USR_username, USR_pass) values('".$USR_fname."','".$USR_lname."','".$USR_username."','".$USR_pass."')";

	//echo $qry;
	
	
	$QUERY_PROCESS = mysqltng_query($qry);
	//call query process to make sure there are not errors in the query
	require_once("dbquery/QUERY_PROCESS.php");
}else{

echo "<h1>Your passwords did not match</h1>";
}



?>