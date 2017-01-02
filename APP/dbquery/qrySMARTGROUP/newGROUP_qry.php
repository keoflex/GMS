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

/*require_once '/vendor/google/src/Google/autoload.php';
require_once '/google.php';

//$keyfile = env("google_service_account_key_file2");
$google = new Google($keyfile);

$results=$google->getGoogleUsers($domain_name,$next);
echo "<pre>";
print_R($results);
die;*/


$element = "Smart Group";
$element_function = "Created";
//Define Variables for the form


$GRP_name =$conn->real_escape_string($_POST['name']);
$GRP_email = $conn->real_escape_string($_POST['email']);
$GRP_description = $conn->real_escape_string($_POST['description']);
$GRP_group_id = $conn->real_escape_string($_POST['google_group_id']);
$GRP_pattern = $conn->real_escape_string($_POST['pattern_condition']);
$GRP_created_at = date('Y-m-d H:i:s');

if($GRP_name){
	$qry = "insert into smart_groups(name, email, description, google_group_id,pattern_condition,created_at) values('".$GRP_name."','".$GRP_email."','".$GRP_description."','".$GRP_group_id."','".$GRP_pattern."','".$GRP_created_at."')";

	$QUERY_PROCESS = mysqltng_query($qry);
	//call query process to make sure there are not errors in the query
	require_once("dbquery/QUERY_PROCESS.php");
}else{

echo "<h1>Problem in create smart group</h1>";
}



?>