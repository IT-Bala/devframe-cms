<?php
// PHP dev__ FRAMEWORK
include('frame/dev__.php');
if(isset($_REQUEST['page']))
{
        if($_REQUEST['page'] != ''){
	    if(isset($_SESSION['post_id'])){
	      query("update ".DB_PREFIX."posts set post_title='".$_REQUEST['page']."' where post_id=".$_SESSION['post_id']."");
		}else{
		// insert
		$que = query("insert into ".DB_PREFIX."posts(post_title,post_date,status) values ('".$_REQUEST['page']."','".$url."',now(),1)");
	    $ID = mysql_insert_id();
		$_SESSION['post_id']=$ID;
		// select
		$slt = where(DB_PREFIX."posts","post_id=".$_SESSION['post_id']."");
		$link = fetch($slt);
		query("update ".DB_PREFIX."posts set post_link='page.php?p_id=".$link->post_id."' where post_id=".$_SESSION['post_id']."");
		}
		echo "<strong>Post Link :&nbsp;&nbsp;</strong><input type='text' readonly='readonly' value='page.php?p_id=".$_SESSION['post_id']."' /><br><br>";
		}
       	
	    
}
?>


    
    
    
        