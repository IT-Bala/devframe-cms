<?php
// PHP dev__ FRAMEWORK
include('frame/dev__.php');
if(isset($_REQUEST['page'])){
        if($_REQUEST['page'] != ''){
	    if(isset($_SESSION['page_id'])){
	      db()->query("update ".DB_PREFIX."pages set page_title='".$_REQUEST['page']."' where page_id=".$_SESSION['page_id']."");
		}else{
		// insert
		$que = db()->query("insert into ".DB_PREFIX."pages(page_title,page_date,status) values ('".$_REQUEST['page']."',now(),1)");
	    $ID = db()->insert_id();
		$_SESSION['page_id']=$ID; 
		// select
		$slt = where(DB_PREFIX."pages","page_id=".$_SESSION['page_id']."");
		$link = $slt->fetch_object();
		db()->query("update ".DB_PREFIX."pages set page_link='page.php?page_id=".$link->page_id."' where page_id=".$_SESSION['page_id']."");
		}
		echo "<strong>Page Link :&nbsp;&nbsp;</strong><input type='text' readonly='readonly' value='page.php?page_id=".$_SESSION['page_id']."' /><br><br>";
		}
       	
	    
}
?>
