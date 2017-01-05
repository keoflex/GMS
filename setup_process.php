<?php

require_once("APP/globals.php");

try {

error_log("hello");
error_log(print_r($_POST,true));
error_log(print_r($_FILES,true));

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
error_log($filename);
 $tmp = explode('.', $filename);
 $extension = strtolower(end($tmp));
error_log($extension);
 if(in_array($extension, $allowed) === false){
    throw new Exception("Error - invalid file extension: $extension  Must be one of .json or .p12");
 }

$name = basename($f["name"]);
error_log($name);
$tmp_name = $f["tmp_name"];
error_log($tmp_name);
$uploads_dir="../etc";
$key_file_path = "$uploads_dir/$name";
$status = move_uploaded_file($tmp_name, $key_file_path);
error_log("status: $status");
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
mysqli_close($conn);

$loginSeed = $login_seed;


$config_data = "
; system config file
db_hostname='$db_host'
db_database='$db_name'
db_login='$db_user'
db_password='$db_pw'
login_seed='$login_seed'
google_admin_user='$google_admin_user'
google_service_account_name='$google_service_account_name'
google_service_account_key_file='$key_file_path'
";
error_log($config_data);

include "APP/dbcon/php_functions.php"; # needed for pg_encrypt()
$cfg = pg_encrypt($config_data,$pg_encrypt_key,"encode");


$fp = fopen($config_file,"w");
if (!$fp)  {
	throw new Exception("Error - failed to create the config.ini file ");
	}
fwrite($fp, $cfg);
fclose($fp);

$out = pg_encrypt($cfg,$pg_encrypt_key,"decode");
error_log($out);

  $data = array("status"=> "success");

} catch (Exception $e) {
  $data = array("status"=> "failed", "message"=> $e->getMessage());
}

  $rv = json_encode($data);
  echo $rv; 
