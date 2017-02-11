<?php
class section{
	public function header_section(){
		$site = new site;
		if(home()==false){
		if(theme_page()!='false'){
			if(count($site->page())!=1){	$page = $site->page(); extract($page);}
		}
		}
		if(!is_tpl()){
				if(file_exists(THEME_PATH.THEME_BASE.THEME_HEADER)){			
					require(THEME_PATH.THEME_BASE.THEME_HEADER);
				}
			}
	}
	public function content_section(){
		 $site = new site;
		if(file_exists(THEME_PATH.THEME_BASE.THEME_PAGE)){
		if(home()==true){
			require(THEME_PATH.THEME_BASE.THEME_PAGE);		
		}else{ 
		    if(theme_page()==false){
				# count of subpage array() ==> 4, title, content, date, link
				if(count($site->page())!=1){ 
				$page = $site->page();
				extract($page);
				if(file_exists(THEME_PATH.THEME_BASE.'/sub_page.php')){
				  require THEME_PATH.THEME_BASE.'/sub_page.php';
				 }else{
					 fopen(THEME_PATH.THEME_BASE.'/sub_page.php','w');
				 }
				}
		      } echo theme_page();# Else page template file automatic taken
		    }		
		}
		
	}
	public function footer_section(){
		if(!is_tpl()){
			if(file_exists(THEME_PATH.THEME_BASE.THEME_FOOTER)){
				require(THEME_PATH.THEME_BASE.THEME_FOOTER);
			}
		}
	}
}