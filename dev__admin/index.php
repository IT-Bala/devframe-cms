<?php
global $theme_admin; $msg=$p_msg=$general_msg='';
// PHP dev__ FRAMEWORK
include('frame/dev__.php'); 
$admin = new admin;
$admin->strong_base(); // Not Allow wrong url
// Theme active
if(isset($_REQUEST['THEME'])&&isset($_REQUEST['plug_a'])) : if(!empty($_REQUEST['plug_a'])){$_SESSION['theme_msg_time']=time();$_SESSION['theme_msg']=$admin->theme_active($_REQUEST);} endif;
if(isset($_REQUEST['THEME'])&&isset($_REQUEST['plug_d'])) : if(!empty($_REQUEST['plug_d'])){$_SESSION['theme_msg_time']=time();$_SESSION['theme_msg']=$admin->theme_deactive($_REQUEST);} endif;
// Theme In active
$general_msg = (isset($_REQUEST['Update_general_file']))? $admin->update_file($_REQUEST['file'],$_REQUEST) : '';

// Plugin active
if(isset($_REQUEST['PLUGIN'])&&$_REQUEST['plug_a']!='') : $p_msg=$admin->plugin_active($_REQUEST); endif;
if(isset($_REQUEST['PLUGIN'])&&$_REQUEST['plug_d'] !='') : $p_msg=$admin->plugin_deactive($_REQUEST); endif;
if(isset($_REQUEST['PLUGIN'])&&$_REQUEST['plug_delete'] !='') : $p_msg=$admin->plug_delete($_REQUEST); endif;

$admin->header_with_menu();

$plug_var='true';

$plug_var = $admin->admin_page_integration();

if($plug_var=='false'){
if(class_exists('theme_admin') && method_exists('theme_admin','page') && theme_admin::page()){	
		// theme or plugin function is running successfuly	
}else{	  
	  $admin->admin_page_assign(); 
 }
}

dev_footer(); 
 
 /*$directory = new Directory('.');
var_dump(method_exists($directory,'read'));*/
 
 ?>      