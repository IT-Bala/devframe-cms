<?php
// PHP dev__ FRAMEWORK
define('HOSTNAME','');	
define('USERNAME','');	
define('PASSWORD','');
define('DATABASE','');	
define('DB_PREFIX','');						   
class DB{
      function __construct(){
		  $sql = mysql_connect(HOSTNAME,USERNAME,PASSWORD);
		  mysql_select_db(DATABASE,$sql);
	  }
}
new DB;
