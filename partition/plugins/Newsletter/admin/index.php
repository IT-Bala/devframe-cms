<?php
// File name must be index.php inside of this class
// Class name must be theme_admin => left_menu and page 
class Newsletter_Admin{
	public function left_menu(){
		$menu = array(
			'Newsletter' => array('<a href="?Newsletter_Admin=all_newsletter&Newsletter">All Newsletter</a>','<a href="?Newsletter_Admin=send_a_newsletter&Nivo Slider">Send A News</a>')
			);
	return $menu;
	}
	public function page(){
		
			$plugin_page = $_REQUEST['Newsletter_Admin'];
			switch($plugin_page){
				case 'all_newsletter':
				$plugin_page = include 'Newsletter.php';
				break;
				case 'send_a_newsletter':
				$plugin_page = include 'send_newsletter.php';
				break;
			}
		
		return $plugin_page;
	}
	
}
$GLOBALS['plugin_admin'][] = 'Newsletter_Admin';
