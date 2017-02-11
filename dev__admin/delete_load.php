<?php
// PHP dev__ FRAMEWORK
include('frame/dev__.php');
if(isset($_REQUEST['delete'])){
	$id = $_REQUEST['delete'];
	$type = $_REQUEST['type'];
   switch($type){	   
	   case "menu":
	   $que = query("delete from ".DB_PREFIX."menus where menu_id=$id");
	   echo ($que)? '<span class="success">Menu item deleted successfully !</span>' : '<span class="error">Query error !</span>';
	   break;
	   
	   case "Pages":
	   $que = query("delete from ".DB_PREFIX."pages where page_id=$id");
	   echo ($que)? '<span class="success">Page has been deleted successfully !</span>' : '<span class="error">Query error !</span>';
	   break;
	   
	   case "Posts":
	   $que = query("delete from ".DB_PREFIX."posts where post_id=$id");
	   echo ($que)? '<span class="success">Post has been deleted successfully !</span>' : '<span class="error">Query error !</span>';
	   break;	   
   }
}
?>


    
    
    
        