<?php
/************************************
Edited 1/11/2017
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
require_once("globals.php"); # for $config_file and $pg_encrypt_key
require_once("dbcon/php_functions.php");  # for pg_encrypt();
$config_file = "$ETC_DIR/config.ini";
if (!file_exists($config_file)) {
  die("Error - no config file: $config_file   go here to create it: <a href='../index.php'>Setup</a>");
  }

$encoded_configs = file_get_contents($config_file);
$decoded_configs = pg_encrypt($encoded_configs,$pg_encrypt_key,"decode");
$config = parse_ini_string($decoded_configs, true);

