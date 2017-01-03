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

$element = "Google Domain";
$element_function = "Edited";
//Define Variables for the form


$domain_id_posted = $conn->real_escape_string(pg_encrypt($_POST['domain_id'],$pg_encrypt_key,"decode"));

$domain_name =$conn->real_escape_string($_POST['name']);
$updated_at = date('Y-m-d H:i:s');

if($domain_name){

		//update google domain info
		$domain_update_qry = "update google_domains set
		name = '".$domain_name."',
		updated_at = '".$updated_at."'
		where id = ".$domain_id_posted;

	$QUERY_PROCESS = mysqltng_query($domain_update_qry);
	//call query process to make sure there are not errors in the query
	require_once("dbquery/QUERY_PROCESS.php");

}


?>