<?php
// DON'T EDIT IT
class common extends page_assign{
	// Choose font
    public function select_family(){
		return array("'Comic Sans MS'","'Lucida Grande'","'Times New Roman'","caption","cursive","icon","serif","Georgia","'Lucida Console'","'Times New Roman'");
	}
	public function select_size(){
		return array("10","11","12","13","14","15","16");
	}
	public function update_font_family($f){
		$s = select(DB_PREFIX.'admin_design');
		if(mysql_num_rows($s)==0){
			query('insert into '.DB_PREFIX.'admin_design set font_family="'.mysql_real_escape_string($f['fb']).'",status=1');
		}else{
		   $fb = mysql_real_escape_string($f['fb']);
		   query("update ".DB_PREFIX."admin_design set font_family='".$fb."'");
		}
	}
	public function update_font_size($f){
		$s = select(DB_PREFIX.'admin_design');
		if(mysql_num_rows($s)==0){
			query('insert into '.DB_PREFIX.'admin_design set font_size="'.mysql_real_escape_string($f['fs']).'",status=1');
		}else{
		   $fb = mysql_real_escape_string($f['fs']);
		   query("update ".DB_PREFIX."admin_design set font_size='".$fb."'");
		}
	}
	public function font_family(){
		$family = '';
		$s = select(DB_PREFIX.'admin_design');
		if(num(DB_PREFIX."admin_design")>0){
		$ft = fetch($s);
		if($ft->font_family==''){ $family = '<style>body{font-family:serif;}</style>'; }else{
		$family = '<style>body{font-family:'.$ft->font_family.';}</style>';
		}
		}
		return $family;
	}
	public function font_size(){
		$size = '';
		$s = select(DB_PREFIX.'admin_design');
		if(num(DB_PREFIX."admin_design")>0){
		$ft = fetch($s);
		if($ft->font_size=='' || $ft->font_size==0){$size='<style>body{font-size:13px;}</style>';}else{
		$size = '<style>body{font-size:'.$ft->font_size.'px;}</style>';
		}}
		return $size;
	}
	// Font end
	
	public function make_default()
	{
		return select(DB_PREFIX."pages where status=1");
	}
	public function make_default_run()
	{
		if($_REQUEST['default'] != ''){
		mysql_query("update ".DB_PREFIX."pages set default_page=0");
		$query = mysql_query("update ".DB_PREFIX."pages set default_page=1 where page_id=".$_REQUEST['default']."");
		if($query):
		$msg = "<span class='success'>Default page has been activated success !</span>";
		endif;
		}
		else
		{
		$msg = "<span class='error'>Please choose any one page !</span>";	
		}
		return $msg;
	}
	
	public function active($act){ // Menu Active
	
		$server_url = $_SERVER['REQUEST_URI'];
        $current = basename($server_url);
		$active = explode('?',$current);		
		if($active[1]!=''){
			$str = $active[1];
			if (strpos($str, $act) !== false) 
			{
			 $Active = $act;	
			}
		}
		else
		{
			$Active = 'Dashboard';
		}
		return 	$Active;	
	}
	
	// Page counts
	public function page_count(){
		$q = select(DB_PREFIX."pages");
		return mysql_num_rows($q);
	}
	public function post_count(){
		$q = select(DB_PREFIX."pages");
		return mysql_num_rows($q);
	}
	public function plugin_count(){
		foreach(glob("installed-plugin/*.zip") as $plug):
		 $pl[] = $plug;
		endforeach;
		return count($pl);
	}
	public function menu_count(){
		$q = select(DB_PREFIX."menus");
		return mysql_num_rows($q);
	} 
	
	public function admin_counts(){
		return array("Pages"=>admin::page_count(),
			   "Posts"=>admin::post_count(),
			   "Menus"=>admin::menu_count(),
			   "Plugins"=>admin::plugin_count()
			   );
	    
	} 	
	// end of the counts
	
	// Pages handling
	public function add_page($var){$url='';
		if($_REQUEST['addpage'] != ''){
		if($_REQUEST['friendly_url']!=''){	$url= check_friendly_url($_REQUEST['friendly_url']); }else{
			$url= check_friendly_url($_REQUEST['addpage']);
		}
		$msg = query("insert into ".DB_PREFIX."pages set page_title='".$_REQUEST['addpage']."', friendly_url='".$url."', page_content='".$_REQUEST['editor1']."',tpl='".$_REQUEST['tpl']."',page_date=now()");
		if($msg): return '<span class="success">New page created successfully !</span>'; else: return '<span class="error">Insert query error occured !</span>'; endif;
		}else{	echo "<span class='error'>Please enter page title !</span>";}
	}
	public function add_post($var){$url='';
		if($_REQUEST['addpage'] != ''){
		if($_REQUEST['friendly_url']!=''){	$url= check_friendly_url($_REQUEST['friendly_url']); }else{
			$url= check_friendly_url($_REQUEST['addpage']);
		}
		$msg = query("insert into ".DB_PREFIX."posts set post_title='".$_REQUEST['addpage']."', friendly_url='".$url."', post_content='".$_REQUEST['editor1']."',tpl='".$_REQUEST['tpl']."',post_date=now()");
		if($msg): return '<span class="success">New Post created successfully !</span>'; else: return '<span class="error">Insert query error occured !</span>'; endif;
		}else{ echo "<span class='error'>Please enter page title !</span>";}
	}
	public function edit_page($id){
		$que = where(DB_PREFIX."pages","page_id=$id");
		return $que;
	}
	public function edit_post($id){
		$que = where(DB_PREFIX."posts","post_id=$id");
		return $que;
	}
	public function all_page(){
		$msg = select(DB_PREFIX.'pages');
		return $msg;
	}
	public function update_page($get,$id){
		$query = query("update ".DB_PREFIX."pages set page_title='".$_REQUEST['addpage']."',page_content='".$_REQUEST['editor1']."',tpl='".$_REQUEST['tpl']."',page_date=now() where page_id=$id");
		if($query) { return "<span class='success'>Page has been updated successfully !</span>"; }
		
	}
	public function update_post($get,$id){
		$query = query("update ".DB_PREFIX."posts set post_title='".$_REQUEST['addpage']."',post_content='".$_REQUEST['editor1']."',tpl='".$_REQUEST['tpl']."',post_date=now() where post_id=$id");
		if($query) { return "<span class='success'>Post has been updated successfully !</span>"; }
		
	}
	// menu handling
	public function set_submenu(){
		$sql = query("update ".DB_PREFIX."menus set submenu_id=".$_REQUEST['submenu']." where menu_id=".$_REQUEST['menu']);
		echo "<span class='success'>Sub menu has been set!</span>";
	}
	public function add_menu()
	{
		$msg = query("insert into ".DB_PREFIX."menus(menu,menu_link,menu_date,status) values ('".$_REQUEST['menu']."','".$_REQUEST['menu_link']."',now(),1)");
		echo "<span class='success'>New menu item added successfully!</span>";
		return $msg;
	}
	public function all_menu(){
		$msg = select(DB_PREFIX.'menus');
		return $msg;
	}
	public function edit_menu($id){
		$que = where(DB_PREFIX."menus","menu_id=$id");
		return $que;
	}
	public function update_menu($gda,$id){
		$que = query("update ".DB_PREFIX."menus set menu='".$_REQUEST['menu']."', menu_link='".$_REQUEST['menu_link']."' where menu_id=$id");
		echo "<span class='success'>Menu updated successfully !</span>";
		return $que;
	}
	public function menu_activate($id){
		$q= query("update ".DB_PREFIX."menus set status=1 where menu_id=$id");
		if($q==true){ echo "<span class='success'>Menu activated successfully !</span>";}
	}
	
	public function menu_deactivate($id){
		$q= query("update ".DB_PREFIX."menus set status=0 where menu_id=$id");
		if($q==true){ echo "<span class='success'>Menu de-activated successfully !</span>";	}
	}
	// Themes handling
	// Plugin handling
	public function install_theme($plugin) // Avai;lable Plugin
	{
	  $plug = $_FILES['plugin']['name'];
	  $Zip = explode('.zip',$plug);
	  $plug_tmp = $_FILES['plugin']['tmp_name'];
	  $theme_base = $Zip[0];
	  $path = 'installed-theme/'.$plug;
	  $ext = end(explode(".", $plug));
	  if($plug!=''){
      if($ext=='zip')
	  {
	     $succ = move_uploaded_file($plug_tmp,$path);
		 if($succ)
		 {
		  // Extract theme 
		    require_once('unzip/theme_extract.php'); 
			$zipfile = new PclZip($path); // Extract theme 
			if ($zipfile -> extract() == 0) {
				echo 'Error : ' . $zipfile -> errorInfo(true); // Error info
			}else{ //
		  #if(check_theme_structure($theme_base)==true){
		  $msg = "<p><h2>Theme Name : $plug</h2></p>";
		  $msg .= "<p>Theme is installing ...</p>";
		  $msg .= "<p><span class='success'>Theme installed successfully !</span></p>";
		  $msg .= '<span class="Button"><a href="Javascript:activate('."'$Zip[0]'".');">Activate Theme</a></span> | <span class="Button"><a href="Javascript:Goto('."'all_theme.php?Partition'".')" class="Button">Return Theme Page</a></span>';
		 #}
		 }		 
		 }
	  }else{ $msg = "<span class='error'>Please upload .zip file !</span>"; }
	  }
	  else{  $msg = "<span class='error'>Please upload the theme !</span>"; }
	  echo $msg;
	}
	public function themes(){ // Plugin List
		$themes = glob("../partition/themes/*",GLOB_ONLYDIR);
		return $themes;
	}
	public function active_theme(){
		$cur='';
		$cT = func_get_args(); if(!empty($cT[0])){ $cur = 'theme="'.$cT[0].'" and ';}
		$q = select(DB_PREFIX."themes where ".$cur." status=1");
		$ft = fetch($q);
		return $ft->status;
	}
	public function theme_active($theme){
		query("update ".DB_PREFIX."themes set status=0");
		$slt = select(DB_PREFIX."themes where theme='".$_REQUEST['plug_a']."'");
		$count = mysql_num_rows($slt);
		if($count==0){ query("insert into ".DB_PREFIX."themes (theme,status) values ('".$_REQUEST['plug_a']."',1)");}else{
			query("update ".DB_PREFIX."themes set status=1 where theme='".$_REQUEST['plug_a']."'");
		}
		return "<span class='success'>Theme ".$_REQUEST['plug_a']." activated successfully !</span>";	
	}
	public function theme_deactive($theme){
		query("update ".DB_PREFIX."themes set status=0 where theme='".$_REQUEST['plug_d']."'");
		return "<span class='success'>Theme ".$_REQUEST['plug_d']." de-activated successfully !</span>";
	}
	public function theme_delete(){$msg='';
		if(isset($_REQUEST['theme_delete'])&&$_REQUEST['theme_delete']!=''){
			    $theme_file = "../partition/themes/".$_REQUEST['theme_delete']; // removed .php
				if(is_dir($theme_file)){rrmdir($theme_file);}  // old unlink()
				$msg= "<span class='success'>".ucfirst($_REQUEST['theme_delete'])." theme has been deleted successfully !</span>";
			}
		return $msg;
	}
	// Plugin handling
	public function install_plugin($plugin){ $msg='';// Avai;lable Plugin
	  $plug = $_FILES['plugin']['name'];
	  $Zip = explode('.zip',$plug);
	  $plug_tmp = $_FILES['plugin']['tmp_name'];
	  $plug_folder = explode('.zip',$plug); $plug_base = $plug_folder[0];
	  $path = 'installed-plugin/'.$plug;
	  $ext = end(explode(".", $plug));
	  if($plug!=''){
      if($ext=='zip'){
	        $succ = move_uploaded_file($plug_tmp,$path);
			require_once('unzip/pclzip.lib.php'); 
			$zipfile = new PclZip('installed-plugin/'.$_FILES['plugin']['name']);
			if ($zipfile -> extract() == 0) {  // ../partition/plugin/
				echo 'Error : ' . $zipfile -> errorInfo(true);
			}
		 #if(check_plugin_structure($plug_base)==true){
		  $msg = "<p><h2>Plugin Name : $plug</h2></p>";
		  $msg .= "<p>Plugin is unpackaging ...</p>";
		  $msg .= "<p><span class='success'>Plugin installed successfully !</span></p>";
		  $msg .= '<span class="Button"><a href="Javascript:activate('."'$Zip[0]'".');">Activate Plugin</a></span> | <span class="Button"><a href="Javascript:Goto('."'?Plugins&Admin_page=Plugins'".')" class="Button">Return Plugins Page</a></span>';
		 #}
	  }else{  $msg = "<span class='error'>Please upload .zip file !</span>"; }
	  }else{  $msg = "<span class='error'>Please upload the plugin !</span>"; }
	  return $msg;
	}
	public function plugin_list(){ // Plugin List
		$file = glob("../partition/plugins/*",GLOB_ONLYDIR);
		return $file;
	}
	public function plugin_active($theme){
		$slt = select(DB_PREFIX."plugins where plugin='".$_REQUEST['plug_a']."'");
		$count = mysql_num_rows($slt);
		if($count==0){ query("insert into ".DB_PREFIX."plugins (plugin,status) values ('".$_REQUEST['plug_a']."',1)");}else{
			query("update ".DB_PREFIX."plugins set status=1 where plugin='".$_REQUEST['plug_a']."'");
		}
		return "<span class='success'>Plugin ".$_REQUEST['plug_a']." activated successfully !</span>";	
	}
	public function plugin_deactive($theme){
		query("update ".DB_PREFIX."plugins set status=0 where plugin='".$_REQUEST['plug_d']."'");
		return "<span class='success'>Plugin ".$_REQUEST['plug_d']." de-activated successfully !</span>";
	}
	
	public function plug_delete($pls){ $msg='';
		$file_php = "../partition/plugins/".$_REQUEST['plug_delete']; // removed .php
		if(is_dir($file_php)){
		  query("DELETE FROM ".DB_PREFIX."plugins WHERE `plugin`='".$_REQUEST['plug_delete']."'");
		if(file_exists($file_php.'/admin/function.php')){
			include_once $file_php.'/admin/function.php';
			if(function_exists('remove_tables')){
				remove_tables();
			}
		}
	         $link = rrmdir($file_php);  // old unlink()
		$msg= "<span class='success'>Plugin deleted successfully !</span>";
		}
		return $msg;
	}
	public function edit_plug($plug){
		foreach(glob("../plugins/".$plug."/*.html") as $ed_plug_file):
		$file = fopen($ed_plug_file, "r") or exit("Unable to open file!");
		while(!feof($file)){
		   $read[] = fgets($file);
		}
		return $read;
		fclose($file);
		endforeach;
	}
	
	public function update_plug($plug,$edit){
		foreach(glob("../plugins/".$plug."/*.html") as $ed_plug_file):
		$fp=fopen($ed_plug_file,'w');
		$yes = fwrite_stream($fp,$_REQUEST['content']);
		echo ($yes)?"Content updated successfully !":"Error while update this plugin !";
		header("refresh:1;");
		endforeach;
	}
	
	// General setting
	
	public function general_file(){ // Common List
		$file = glob("../partition/themes/".THEME_BASE()."/section/*.php");
		return $file;
	}
	public function edit_file($plug){
		$plug = '../partition/themes/'.THEME_BASE().'/section/'.$plug.'.php';
		chmod($plug, 0777); // file permission 777 read and write
		$file = fopen($plug, "r") or exit("Unable to open file!");
		while(!feof($file)){
		   $read[] = fgets($file);
		}
		chmod($file, 0777); // file permission 777 read and write
		return $read;
		fclose($file);
	}	
	public function update_file($plug,$edit){
		$plug_ = '../partition/themes/'.THEME_BASE().'/section/'.$plug.'.php';
		chmod($plug_, 0777); // file permission 777 read and write
		$fp=fopen($plug_,'w');
		$yes = fwrite_stream($fp,stripcslashes($_REQUEST['content']));
		return ($yes)?"<span class='success'>$plug file updated successfully !</span>":"<span class='error'><strong>Error while update this plugin !</strong></span>";
	}  // end of the general
	
	public function base_url(){
		$url = $_SERVER['REQUEST_URI'];
		return basename($url);
	}
	
	public function login_form(){
		$form = <<<Login
<!--<a class="btn-facebook" href="#">Connect with Facebook</a>
<a class="btn-twitter" href="#">Connect with Twitter</a>-->

<form id="dev__admin_login" class="input-form" method="post">
<span class="ie-placeholders">Login:</span>
<input id="ipt-login" type="text" placeholder="Login" name="login"> <!-- class="ipt-error" -->
<span class="ie-placeholders">Password:</span>
<input id="ipt-password" type="password" placeholder="Password" name="password">
<a class="forgotten-password-link" href="#">Forgotten password</a>
<input class="btn-sign-in btn-orange" name="Dev_Login" onClick="return login_validate();" type="submit" value="Sign in">
</form>
Login;
echo $form;
	}
	
	public function login(){
		$que = query("select * from ".DB_PREFIX."admin where admin_id=1");
		$msg = fetch($que);
		return $msg;
	}
	
	public function update_login($get){
		if($_REQUEST['uname']!='' && $_REQUEST['psword']!='')
		{
		$que = query("update ".DB_PREFIX."admin set username='".$_REQUEST['uname']."',password='".$_REQUEST['psword']."'");
		if($que){ $msg = "<span class='success'>Username and password has been updated successfully !</span>"; }
		}
		else{
		 $msg = "<span class='error'>Please enter username and password !</span>";
		}	
		return $msg;
	}
	
	// Admin login check
	public function dev_login($get){
		$msg="";
		if(!isset($_SESSION['Login'])):
		if($_REQUEST['login']!='' && $_REQUEST['password']!=''){
		$que = mysql_query("select * from ".DB_PREFIX."admin where username='".$_REQUEST['login']."' and password='".$_REQUEST['password']."'");
		$fetch = mysql_fetch_object($que);
		$count = mysql_num_rows($que);
		if($count > 0){ 
		$_SESSION['Login']=$fetch->username;  
		$_SESSION['expire']=time()+1800; 
		if(isset($_SESSION['session_url'])){ 
		location($_SESSION['session_url']);
		}else{
		location("index.php");
		}
		 }
		else{ location("login-error.php"); exit; }
		}else{
		$msg = "<span class='error'>Please enter username and password !</span>";
		}
	    else:
		location("index.php");
		endif;	
		return $msg;	
	}
	public function check_admin(){
		if(!isset($_SESSION['Login'])):
		$_SESSION['session_url']=$_SERVER['REQUEST_URI'];
		location("login.php");
		endif;
	}
	public function time_out(){
		unset($_SESSION['Login']);
		unset($_SESSION['expire']);
	}
	public function session_popup(){
		if($_SESSION['expire']+5 < time()){
		  unset($_SESSION['Login']); // if refresh the page go to login.php
		}
		if(basename($_SERVER['REQUEST_URI'])!='login.php'){
		echo '
		<script type="text/javascript">
	$(function() {
		$("a[rel*=leanModal]").leanModal({ top : 200, closeButton: ".modal_close" });		
	});
	</script>
	<script type="text/javascript" src="js/dev_.js"></script>
		<div id="lean_overlay"></div>
            <div id="session_popup">
       		<div id="popup-header">
                <h2>Session Expired</h2>
                <a href="login.php?timeout=true" id="pop_close" class="modal_close"></a>
            </div>
			<span id="ssl"></span>
            <div class="in_popup form">
			<div class="f_left p_left">
				<p id="full_content">	
					<span class="ie-placeholders">Login:</span>
					<input type="text" name="login" placeholder="Login" id="ipt-login"> <!-- class="ipt-error" -->
					<span class="ie-placeholders">Password:</span>
					<input type="password" name="password" placeholder="Password" id="ipt-password">
					<a href="#" class="forgotten-password-link">Forgotten password</a>
					<input type="submit" value="Sign in" 
					onclick="return login_validate('."'session_login.php'".','."'ssl'".');" name="Dev_Login" class="btn-sign-in btn-orange">
					
				</p>
			</div>
			<div class="clr"></div>
            </div>
    	</div>';
		}
	}
	public function logout_admin(){
		if($_REQUEST['logout'] !='' && $_REQUEST['logout'] == "true"):
		session_destroy();
		header("location:login.php");
		endif;
	}
	public function strong_base(){ $url = basename($_SERVER['REQUEST_URI']);
		if($url!='login.php' && extension($url)=='php'){ 
		 location('./'); // Not Allowed .php file expect login.php file
		}
	}
	public function header_with_menu(){	dev_header();left_menu();}
	public function header(){dev_header();}
	public function left_menu(){left_menu();}	
	public function update_friendly_url($old,$new,$type,$get_id){ $url='';
	     $base_url = array();
	     foreach(glob('../*') as $base_url_file){ $base_url[] = basename($base_url_file); }
		if(!in_array($new,$base_url)){
		if($type=='post'){	$tbl= DB_PREFIX.'posts'; $id='post_id';}else{ $tbl=DB_PREFIX.'pages';$id='page_id';}
		if($new!=''){	$url= check_friendly_url($new); }
		if(query("update ".$tbl." set friendly_url='".$url."' where $id='".$get_id."'")){
			$msg = success("Friendly url has been updated successfully!");
		}
		}else{ $msg = error("Sorry this link already exist!"); }
		return $msg;
	}
}
