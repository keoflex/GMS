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

$DB_host = 'localhost'; // mysql host
$DB_login = "databaseusername"; // mysql login
$DB_password = "databasePassword"; // mysql password
$DB_database = "Databasename"; // the database which can be used by the script.
//loginSeed
//this see is used to add to all passwords
//This is used to see passwords encrypted with sha1().  Simply helps to further encrypt passwords.
$loginSeed = '~!@29changeme8Bcd*()'; // this  is the login seed, make it anything you like
$pg_encrypt_key = "4Trichangeme2kics"; //this  is the page encyryption seed make it anything you like

//sqli connection functions
$conn = new mysqli($DB_host,$DB_login,$DB_password,$DB_database);
if (mysqli_connect_errno()) {
    printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
    exit;
}

//$conn->real_escape_string(
//FUNCTION FOR INTERFACING WITH MYSQLI
function mysqltng_query($query,$connection='') {
    global $conn;
    if ($connection=='') $connection=$conn;
    return $connection->query($query);
}

function mysqltng_fetch_assoc($result) {
    return $result->fetch_assoc();
}

function mysqltng_result($result, $pos, $field) {
    $i=0;
    $retval='';
    $result->data_seek(0);
    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
        if ($i==$pos) $retval=$row[$field];
        $i++;
    }
    return $retval;
}  

function mysqltng_num_rows($result) {
    return $result->num_rows;
}

function mysqltng_data_seek($result,$offset) {
    $result->data_seek($offset);
}

function mysqltng_free_result($result) {
    $result->free;
}

function mysqltng_close($connection='') {
    global $conn;
    if ($connection=='') $connection=$conn;
    $connection->close;
} 
?>