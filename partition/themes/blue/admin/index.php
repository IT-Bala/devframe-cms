<?php
// admin integration
class theme_admin{ // 
	public function left_menu(){ // left ,memu
		$menu = array(
			'Blue Slider' => array('<a href="?Theme_admin=myslider&Blue Slider">My Slider</a>','<a href="?Theme_admin=add_slider&Blue Slider">Add New Image</a>'),
			
			'Contact Us' => array('<a href="?Theme_admin=contact&Contact Us">My Contact</a>'),
			
			'Categories' => array('<a href="?Theme_admin=cat&Categories">Category</a>','<a href="?Theme_admin=addcat&Categories">Add New</a>')
			
			);
	return $menu;
	}
	public function page(){
		
			$plugin_page = $_REQUEST['Theme_admin'];
			switch($plugin_page){
				case 'myslider':
				$plugin_page = include 'myslider.php';
				break;
				case 'add_slider':
				$plugin_page = include 'addslider.php';
				break;
				case 'contact':
				$plugin_page = include('contact.php');
				break;
				case 'cat':
				$plugin_page = include('category.php');
				break; 
				case 'addcat':
				$plugin_page = include('add_category.php');
				break; 
			}
		
		return $plugin_page;
	}
	
}

