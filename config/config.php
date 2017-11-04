<?php
// PHP dev__ FRAMEWORK
define('HOSTNAME','localhost');	
define('USERNAME','root');	
define('PASSWORD','');
define('DATABASE','devframe');	
define('DB_PREFIX','tbl_');							   
$db = new MySqli(HOSTNAME,USERNAME,PASSWORD,DATABASE);
