<?php
// PHP dev__ FRAMEWORK
define('HOSTNAME','localhost');	
define('USERNAME','root');	
define('PASSWORD','');
define('DATABASE','microteh');	
define('DB_PREFIX','tbl_');							   
class DB{
      function __construct(){
		  $sql = mysql_connect(HOSTNAME,USERNAME,PASSWORD);
		  mysql_select_db(DATABASE,$sql);
	  }
}
new DB;