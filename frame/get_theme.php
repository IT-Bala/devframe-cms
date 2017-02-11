<?php
// PHP dev__ FRAMEWORK
class get_theme{
	public function __construct(){ front_page_access(); }
	public function theme(){ return current_theme();}
	public function get_theme_base(){ return THEME_BASE();}
}
$current = 'get_theme';
