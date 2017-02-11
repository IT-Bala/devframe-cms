<?php
require('section.php');  // Common section
$connect = new section;
class connect{
	public function header(){
		return "header_section"; // Gives header
	}
	public function home(){
		return "content_section"; // Gives footer
	}
	public function footer(){
		return "footer_section"; // Gives footer
	}
}

$section = 'connect';  // Connect both