<?php
// Inter connect with themes and plugins
require('../frame/get_theme.php');
$theme = new get_theme;
$files = array();
########## THEME INTERFACE ##############
$path = '../partition/themes/'.$theme->get_theme_base().'/admin/'; // THEMES
if(is_dir($path)){
	$file=$path.'index.php';
	if(file_exists($file)){	include($file);	}
}
########## THEME INTERFACE ##############


