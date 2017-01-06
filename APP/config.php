<?php

require_once("globals.php"); # for $config_file and $pg_encrypt_key
require_once("dbcon/php_functions.php");  # for pg_encrypt();
$config_file = "$ETC_DIR/config.ini";
if (!file_exists($config_file)) {
  die("Error - no config file: $config_file   go here to create it: <a href='../index.php'>Setup</a>");
  }

$encoded_configs = file_get_contents($config_file);
$decoded_configs = pg_encrypt($encoded_configs,$pg_encrypt_key,"decode");
$config = parse_ini_string($decoded_configs, true);

$config['google_service_account_key_file'] = '/Library/WebServer/Documents/etc/dumas-d760939fae36.p12';
