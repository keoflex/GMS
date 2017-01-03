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

$element = "Smart Group";
$element_function = "Edited";
//Define Variables for the form


$GRP_id_posted = $conn->real_escape_string(pg_encrypt($_POST['smart_group_id'],$pg_encrypt_key,"decode"));

$GRP_name =$conn->real_escape_string($_POST['name']);
$GRP_email = $conn->real_escape_string($_POST['email']);
$GRP_description = $conn->real_escape_string($_POST['description']);
$GRP_google_group_id = $conn->real_escape_string($_POST['google_group_id']);
$GRP_google_domain_id = $conn->real_escape_string($_POST['google_domain_id']);
$GRP_pattern = $conn->real_escape_string($_POST['pattern_condition']);
$updated_at = date('Y-m-d H:i:s');
if($GRP_name){

		//update smart group info
		$group_update_qry = "update smart_groups set
		name = '".$GRP_name."',
		email = '".$GRP_email."',
		description = '".$GRP_description."',
		google_domain_id = '".$GRP_google_domain_id."',
		google_group_id = '".$GRP_google_group_id."',
		updated_at = '".$updated_at."',
		pattern_condition = '".$GRP_pattern."'
		where id = ".$GRP_id_posted;

	$QUERY_PROCESS = mysqltng_query($group_update_qry);
	//call query process to make sure there are not errors in the query
	require_once("dbquery/QUERY_PROCESS.php");

}


?>