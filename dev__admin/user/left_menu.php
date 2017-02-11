<?php
class left_menu{
	public function menu(){ // Menu list
		 $admin_left_menu = array(
		'Dashboard' => array('<a href="./">Home</a>','<a href="">Themes</a>','<a href="../" target="_blank">Visit Site</a>'),
		'Pages' => array('<a href="?Pages&Admin_page=Pages&type=page">All Pages</a>','<a href="?Admin_page=Addpage&Pages&type=page">Add Page</a>'),
		'Posts' => array('<a href="?Posts&Admin_page=Posts&type=post">All Posts</a>','<a href="?Admin_page=Addpost&Posts&type=post">Add Post</a>'),
		'Menus' => array('<a href="?Menus&Admin_page=Menus">All Menus</a>','<a href="?Menus&Admin_page=Addmenu">Add Menu</a>'),
		'Plugins' => array('<a href="?Plugins&Admin_page=Plugins">Installed Plugins</a>','<a href="?Plugins&Admin_page=Addplugin">Add Plugin</a>'),
		'Partition' => array('<a href="?Partition&Admin_page=themes">Installed Themes</a>','<a href="?Partition&Admin_page=Addtheme">Add Theme</a>'),
		'Settings' => array('<a href="?Settings&Admin_page=General">General setting</a>','<a href="?Export=true&Settings">Export DB</a>','<a href="?Settings&Admin_page=Siteprofile">Site Profile</a>','<a href="?Settings&Admin_page=Friendlyurl">Friendly Url</a>','<a href="?Settings&Admin_page=Changepassword">Change Password</a>','<a href="?Settings&logout=true">Log Out</a>'),
	);
		 return $admin_left_menu;
	}
   public function left_menu_integration(){ // From Plugin Path
	    $plug_left_menu = array();
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
						if(num(DB_PREFIX."plugins where plugin='".$plugin."' and status=1")==1){ #check table
						if(class_exists($GLOBALS['plugin_admin'][$plugin_i])){
							$obj = new $GLOBALS['plugin_admin'][$plugin_i];
							if(method_exists($GLOBALS['plugin_admin'][$plugin_i],'left_menu')){			
								 $left_all = $obj->left_menu();
								 $plug_left_menu[] = $left_all;			  
							}
						   }
						  }else{ /*Left Menu Not Show Up*/  }
						   
						}
					}
				}
		}
		return $plug_left_menu;
   }
}