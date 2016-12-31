When a page is posted, this is where it is processed.  every form  has a hidden input called called post_type where the value is encrypted using pg_encrypt php function  found  in dbcon/php_functions.php

that encrypted  value included the folder inside of dbquery and the file withtin that folder