<?php
class page_assign extends left_menu{
	public function admin_page_assign(){ // Assign Page
		$page = $_REQUEST['Admin_page'];
		switch($page){
			case 'Pages':require 'all_page.php'; break; //Pages
			case 'Addpage':require 'add_page.php';	break;
			case 'Editpage':require 'edit_page.php'; break;
			case 'Posts':require 'all_page.php'; break; //Posts
			case 'Addpost':require 'add_page.php'; break;
			case 'Editpost':require 'edit_page.php';break;
			case 'Menus':require 'all_menu.php';break; //Menus
			case 'Addmenu':require 'add_menu.php';break; 
			case 'Editmenu':require 'edit_menu.php';break; 
			case 'Plugins':require 'all_plugin.php';break; //Plugins
			case 'Addplugin':require 'add_plugin.php';break; 
			case 'themes':require 'all_theme.php';break; //Themes
			case 'Addtheme':require 'add_theme.php';break; 
			case 'General':require 'general.php';break; //Settings general file
			case 'Editgeneral':require 'edit_general.php';break; 
			case 'Siteprofile':require 'site_profile.php';break;  // Site profile
			case 'Friendlyurl':require 'friendly.php';break;  // friendly url
			case 'Changepassword':require 'change_password.php';break;  // friendly url
			default:require 'home.php';break;
		 }
	}
	
	public function admin_page_integration(){ // From Plugin Path
	    $plugin_admin_page = 'false';
		$plug_admin_path = array();
		foreach(glob('../partition/plugins/*',GLOB_ONLYDIR) as $plug_folder){   
			   $plug_admin_path[]=$plug_folder;
		}
		$i=-1; $plugin_i = -1;
		foreach($plug_admin_path as $admin){ $plugin_i++;
			   $plugin = basename($admin);
			    			   
			   foreach(glob($admin.'/*',GLOB_ONLYDIR) as $left_admin){ $i++;
					if(basename($left_admin)=='admin'){
						if(file_exists($left_admin.'/index.php')){
						require_once $left_admin.'/index.php';
						if(num(DB_PREFIX."plugins where plugin='".$plugin."' and status=1")==1){
						if(class_exists($GLOBALS['plugin_admin'][$i])){
						
							$obj = new $GLOBALS['plugin_admin'][$plugin_i];
							if(method_exists($GLOBALS['plugin_admin'][$plugin_i],'page')){
								if(isset($_REQUEST[$GLOBALS['plugin_admin'][$plugin_i]])){
									$obj->page(); 
									$plugin_admin_page='true';
								}
							}
						}
						}else{ /*Left Menu Not Show Up*/ }						
					   }
					}
				}
			   
			   
		}
		return $plugin_admin_page;
   }
}