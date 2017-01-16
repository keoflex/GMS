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
require_once("APP/globals.php");

try {


$db_host = $_POST["db_host"];
$db_name = $_POST["db_name"];
$db_user = $_POST["db_user"];
$db_pw = $_POST["db_pw"];
$login_seed = $_POST["login_seed"];
#$encrypt_key = $_POST["encrypt_key"];
$google_admin_user = $_POST["google_admin_user"];
$google_service_account_name = $_POST["google_service_account_name"];
$f = $_FILES["google_service_account_key_file"];

error_log("$db_name $db_user $db_pw $google_admin_user $google_service_account_name ");


$allowed = array("json", "p12");
 $filename=$f['name'];
 $tmp = explode('.', $filename);
 $extension = strtolower(end($tmp));
 if(in_array($extension, $allowed) === false){
    throw new Exception("Error - invalid file extension: $extension  Must be one of .json or .p12");
 }

$name = basename($f["name"]);
$tmp_name = $f["tmp_name"];
$key_file_path = "../gms_etc/$name";

$status = move_uploaded_file($tmp_name, $key_file_path);
if ($status != 1)  {
	throw new Exception("Error - key file upload failed");
	}


$DB_host = $db_host;
$DB_login = $db_user;
$DB_password = $db_pw;
$DB_database = $db_name;


$conn = new mysqli($DB_host,$DB_login,$DB_password,$DB_database);
if (mysqli_connect_errno()) {
    throw new Exception("Error - unable to connect to the database with the information provided. $DB_host, $DB_login, $DB_databse with a password of: $DB_password   Please try again.");
}

$loginSeed = $login_seed;

   $USR_pass = sha1("admin".$loginSeed);
   $qry = "insert into users(USR_fname, USR_lname, USR_username, USR_pass) values('admin','admin','admin','".$USR_pass."')";
   $QUERY_PROCESS = $conn->query($qry);
   //call query process to make sure there are not errors in the query
   require_once("APP/dbquery/QUERY_PROCESS.php");

mysqli_close($conn);


$config_key_file_path = "../../gms_etc/$name";
$config_data = "
; system config file
db_hostname='$db_host'
db_database='$db_name'
db_login='$db_user'
db_password='$db_pw'
login_seed='$login_seed'
google_admin_user='$google_admin_user'
google_service_account_name='$google_service_account_name'
google_service_account_key_file='$config_key_file_path'
";

include "APP/dbcon/php_functions.php"; # needed for pg_encrypt()
$cfg = pg_encrypt($config_data,$pg_encrypt_key,"encode");

$config_file="../gms_etc/config.ini";
$fp = fopen($config_file,"w");
if (!$fp)  {
	throw new Exception("Error - failed to create the config.ini file ");
	}
fwrite($fp, $cfg);
fclose($fp);

$out = pg_encrypt($cfg,$pg_encrypt_key,"decode");

  $data = array("status"=> "success");

} catch (Exception $e) {
  $data = array("status"=> "failed", "message"=> $e->getMessage());
}

  $rv = json_encode($data);
  echo $rv; 
