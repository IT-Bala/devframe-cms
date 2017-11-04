<?php
// PHP dev__ FRAMEWORK

if(isset($_REQUEST['install'])){
	$host = $_REQUEST['host'];
	$user = $_REQUEST['user'];
	$pass = $_REQUEST['password'];
	
	$dbs= array();
	$db=new MySqli($host,$user,$pass);
	if ($db->connect_errno) {
		printf("Connect failed: %s\n", $db->connect_error());
		exit();
	}
	$db_list = $db->query("show databases"); # db list from server
	while ($row = $db_list->fetch_object()) {
     $dbs[] = $row->Database;
	}
	if(in_array($_REQUEST['db'],$dbs)){ 
	die("Sorry, ".$_REQUEST['db']." database already exist.");
	#$sql = 'DROP DATABASE '.$_REQUEST['db'].''; $db->query($sql);
	} # delete exist database from server
	    
	  $sql=$db->query("CREATE DATABASE `".$_REQUEST['db']."`");
      
	  if ($sql==true){	  
	  $db=new MySqli($host,$user,$pass,$_REQUEST['db']); 
	    // Create tables as automatic
		$Host = $db->query("CREATE TABLE ".$_REQUEST['db'].".`".$_REQUEST['db_prefix']."admin` (
		`admin_id` INT NOT NULL AUTO_INCREMENT ,
		`username` VARCHAR( 255 ) NOT NULL ,
		`password` VARCHAR( 255 ) NOT NULL ,
		`status` VARCHAR( 255 ) NOT NULL ,
		PRIMARY KEY ( `admin_id` )
		) ENGINE = InnoDB");
		
		// create menu table
		$db->query("CREATE TABLE ".$_REQUEST['db'].".`".$_REQUEST['db_prefix']."menus` (
		`menu_id` INT NOT NULL AUTO_INCREMENT ,
		`submenu_id` INT NOT NULL ,
		`menu` VARCHAR( 255 ) NOT NULL ,
		`menu_link` VARCHAR( 255 ) NOT NULL ,
		`menu_date` VARCHAR( 255 ) NOT NULL ,
		`status` VARCHAR( 255 ) NOT NULL ,
		PRIMARY KEY ( `menu_id` )
		) ENGINE = InnoDB");
		
		// create page table
		$db->query("CREATE TABLE ".$_REQUEST['db'].".`".$_REQUEST['db_prefix']."pages` (
		`page_id` INT NOT NULL AUTO_INCREMENT ,
		`page_title` VARCHAR( 255 ) NOT NULL ,
		`page_content` TEXT NOT NULL ,
		`friendly_url` TEXT NOT NULL ,
		`page_link` VARCHAR( 255 ) NOT NULL , 
		`page_date` VARCHAR( 255 ) NOT NULL ,
		`tpl` VARCHAR( 255 ) NOT NULL ,
		`default_page` INT NOT NULL ,
		`status` VARCHAR( 255 ) NOT NULL ,
		PRIMARY KEY ( `page_id` )
		) ENGINE = InnoDB");
		
		// create page table
		$db->query("CREATE TABLE ".$_REQUEST['db'].".`".$_REQUEST['db_prefix']."posts` (
		`post_id` INT NOT NULL AUTO_INCREMENT ,
		`post_title` VARCHAR( 255 ) NOT NULL ,
		`post_content` TEXT NOT NULL ,
		`friendly_url` TEXT NOT NULL ,
		`post_link` VARCHAR( 255 ) NOT NULL , 
		`post_date` VARCHAR( 255 ) NOT NULL ,
		`tpl` VARCHAR( 255 ) NOT NULL ,
		`default_page` INT NOT NULL ,
		`status` VARCHAR( 255 ) NOT NULL ,
		PRIMARY KEY ( `post_id` )
		) ENGINE = InnoDB");
		
		// create theme table
		$db->query("CREATE TABLE ".$_REQUEST['db'].".`".$_REQUEST['db_prefix']."themes` (
		`theme_id` INT NOT NULL AUTO_INCREMENT ,
		`theme` VARCHAR( 255 ) NOT NULL ,
		`status` INT NOT NULL ,
		PRIMARY KEY ( `theme_id` )
		) ENGINE = InnoDB");
		
		// create plugin table
		$db->query("CREATE TABLE ".$_REQUEST['db'].".`".$_REQUEST['db_prefix']."plugins` (
		`plugin_id` INT NOT NULL AUTO_INCREMENT ,
		`plugin` VARCHAR( 255 ) NOT NULL ,
		`status` INT NOT NULL ,
		PRIMARY KEY ( `plugin_id` )
		) ENGINE = InnoDB");
		
		// design part
		$db->query("CREATE TABLE ".$_REQUEST['db'].".`".$_REQUEST['db_prefix']."admin_design` (
		`design_id` INT NOT NULL AUTO_INCREMENT ,
		`font_size` INT NOT NULL , 
		`font_family` VARCHAR( 255 ) NOT NULL ,
		`status` INT NOT NULL ,
		PRIMARY KEY ( `design_id` )
		) ENGINE = InnoDB");
		
		// admin menu
		$db->query("CREATE TABLE ".$_REQUEST['db'].".`".$_REQUEST['db_prefix']."admin_menu` (
		`menu_id` INT NOT NULL AUTO_INCREMENT ,
		`menu` VARCHAR( 255 ) NOT NULL ,
		`link` VARCHAR( 255 ) NOT NULL ,
		`status` INT NOT NULL ,
		PRIMARY KEY ( `menu_id` )
		) ENGINE = InnoDB");
		
		// admin menu option link
		$db->query("CREATE TABLE ".$_REQUEST['db'].".`".$_REQUEST['db_prefix']."admin_submenu` (
		`submenu_id` INT NOT NULL AUTO_INCREMENT ,
		`menu_id` INT NOT NULL ,
		`submenu` VARCHAR( 255 ) NOT NULL ,
		`link` VARCHAR( 255 ) NOT NULL ,
		`status` INT NOT NULL ,
		PRIMARY KEY ( `submenu_id` )
		) ENGINE = InnoDB");
		
		if($Host==true){
			$Insert = $db->query("insert into ".$_REQUEST['db_prefix']."admin(username,password,status) values ('".$_REQUEST['a_username']."','".$_REQUEST['a_password']."','1')");
			
			$Insert .= $db->query("INSERT INTO `".$_REQUEST['db_prefix']."admin_menu` (`m_id`, `menu`, `link`, `status`) VALUES
(1, 'Dashboard', '', 1),
(2, 'Pages', '', 1),
(3, 'Menus', '', 1),
(4, 'Plugins', '', 1),
(5, 'Partition', '', 1),
(6, 'Settings', '', 1)");
			$Insert .= $db->query("INSERT INTO `".$_REQUEST['db_prefix']."admin_option` (`o_id`, `m_id`, `option`, `link`, `status`) VALUES
(1, '1', 'Home', 'index.php', 1),
(2, '1', 'Visite Site', '../', 1),
(3, '2', 'All Pages', 'all_page.php?Pages', 1),
(4, '2', 'Add New Page', 'add_page.php?Pages', 1),
(5, '3', 'All Menu', 'all_menu.php?Menus', 1),
(6, '3', 'Add New Menu', 'add_menu.php?Menus', 1),
(7, '4', 'Installed Plugins', 'all_plugin.php?Plugins', 1),
(8, '4', 'Add Plugin', 'add_plugin.php?Plugins', 1),
(9, '5', 'Installed Themes', 'All_theme.php?Partition', 1),
(10, '5', 'Add Theme', 'add_theme.php?Partition', 1),
(11, '6', 'General Setting', 'general.php?Settings', 1),
(12, '6', 'Export DB', '?Export=true&Settings', 1),
(13, '6', 'Site Profile', 'site_profile.php?Settings', 1),
(14, '6', 'Change Password', 'change_password.php?Settings', 1),
(15, '6', 'Log Out', 'site_profile.php?Settings&logout=true', 1)");
			
		if($Insert==true){
		 $file = fopen('config/config.php', 'w');
			fwrite($file,"<?php
			// PHP dev__ FRAMEWORK
			define('HOSTNAME','".$_REQUEST['host']."');	
			define('USERNAME','".$_REQUEST['user']."');	
			define('PASSWORD','".$_REQUEST['password']."');
			define('DATABASE','".$_REQUEST['db']."');	
			define('DB_PREFIX','".$_REQUEST['db_prefix']."');
			".'$db'." = new MySqli(HOSTNAME,USERNAME,PASSWORD,DATABASE);						   
			");
		 header("location: un-install/un-install.php"); // success
		}else{ 
		header("location: un-install/install-error.php"); // Error
		}
	}		
}else{  echo "Failed to connect to MySQL: " . $db->error();  }

}
?>
<style>
body{
	margin:auto;
	height:auto;
	width:auto;
	background:#eee;
}
#wrapper{
	margin:auto;
	margin-top:20px;
}
#header{
	margin:auto;
}
table{
	padding:20px;
	border-radius:5px;
	margin:auto;
	background:#FFF;
}
td{
	padding:8px;
}
.install{
	padding:2 15px;
}
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Install Dev__ framework</title>
</head>
<script>
function Validate(){
	var host = document.getElementById('host');
	if(host.value==''){
		host.focus();
		host.style.borderColor='blue';
		return false;
	}
	var user = document.getElementById('user');
	if(user.value==''){
		user.focus();
		user.style.borderColor='blue';
		host.style.borderColor='';
		return false;
	}
	var db = document.getElementById('db');
	if(db.value==''){
		db.focus();
		db.style.borderColor='blue';
		user.style.borderColor='';
		return false;
	}
	var a_username = document.getElementById('a_username');
	if(a_username.value==''){
		a_username.focus();
		a_username.style.borderColor='blue';
		db.style.borderColor='';
		return false;
	}
	var a_password = document.getElementById('a_password');
	if(a_password.value==''){
		a_password.focus();
		a_password.style.borderColor='blue';
		a_username.style.borderColor='';
		return false;
	}
}
</script>
<body>
<div id="wrapper">
<div id="header">
<h2 align="center">Install dev__ framework</h2>
</div><hr>
<form method="post" onSubmit="return Validate();">
<table width="548">
<tr>
    <td width="205"><strong>Site Host Details :</strong></td>
    <td width="331"></td>
  </tr>
<tr>
    <td width="205">Host Name :</td>
    <td width="331"><input type="text" name="host" id="host" size="30" /></td>
  </tr>
  <tr>
    <td>Host User :</td>
    <td><input type="text" name="user" size="30" id="user" /></td>
  </tr>
  <tr>
    <td>Host Password :</td>
    <td><input type="text" name="password" size="30" id="pass" /></td>
  </tr>
  <tr>
    <td>DB Name :</td>
    <td><input type="text" name="db" size="30" id="db" /></td>
  </tr>
  <tr>
    <td>Table Prefix :</td>
    <td><input type="text" name="db_prefix" size="30" value="dev_" id="db" /></td>
  </tr>
  <tr>
    <td width="205"><strong>Admin Login Details :</strong></td>
    <td width="331"></td>
  </tr>
  <tr>
    <td>User Name :</td>
    <td><input type="text" name="a_username" size="30" id="a_username" /></td>
  </tr>
  <tr>
    <td>Password :</td>
    <td><input type="text" name="a_password" size="30" id="a_password" /></td>
  </tr>
  <tr>
<tr>
  <tr>
    <td></td>
    <td><input type="submit" class="install" name="install" value="Click here to install" /></td>
  </tr>
</table>
</form>
</div>
</body>
</html>






