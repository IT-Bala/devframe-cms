<?php
session_start();
include('../config/config.php');
if($_REQUEST['login']!='' && $_REQUEST['password']!=''){
		$que = db()->query("select * from ".DB_PREFIX."admin where username='".$_REQUEST['login']."' and password='".$_REQUEST['password']."'");
		$fetch = $que->fetch_object();
		$count = $que->num_rows;
		if($count > 0){ $_SESSION['Login']=$fetch->username;  $_SESSION['expire']=time()+1800; 
		echo '<style>#session_popup{display:none;}#page{ pointer-events: auto;}</style>';
}
    	else{ echo "<span class='error'>Invalid Username And Password !</span>"; }
		}else{
		echo "<span class='error'>Please Enter Username And Password !</span>";
		}
?>
