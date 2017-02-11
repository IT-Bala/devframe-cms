<?php
// Template common section
    session_start(); // auto session default
	$admin = new admin;
	if(isset($_REQUEST['Export'])): backup_db(HOSTNAME,USERNAME,PASSWORD,DATABASE); endif;
	if(isset($_REQUEST['logout'])&&$_REQUEST['logout']=='true'): $admin->logout_admin($_REQUEST); endif;
	if(isset($_SESSION['expire'])): if($_SESSION['expire'] < time()){
	echo '<style>#session_popup{display:block;}#page{pointer-events:none;}</style>';
	$admin->session_popup(); /*$admin->time_out();*/
	 }  endif;
	// session close for the admin	
	function dev_header(){  // Template header section
		$admin = new admin;
        $admin->check_admin();
		inc('section/header');		
	}	
	function dev_footer(){ // Template footer section
		inc('section/footer');
	}
	function left_menu(){ // Template footer section
		inc('section/left_menu');
	}
	
?>