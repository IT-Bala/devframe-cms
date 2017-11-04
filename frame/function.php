<?php
#                                                #
# PHP Dev__ framework [ Predefined functions ]  #
#
function db(){ global $db;
	return $db;
}
function inc($file){
	if(!empty($file)){
	if(file_exists($file.'.php')){
	$path = pathinfo(__FILE__);
	$que = include(	$file.'.'.$path['extension']);
	}
	else{ $msg = ''; }
	}
	return true;
}
function limit($str,$limit){
	$len = strlen($str);
	if($len > $limit):
	$str =  substr($str,0,$limit)."...";
	else:
	$str =$str;
	endif;
	return $str;
}
function check_friendly_url($string){ $checked_url='';
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $new = preg_replace('/[^A-Za-z0-9\-\.\_]/', '', $string); // Removes special chars.
	$sql = db()->query("select * from ".DB_PREFIX."posts where friendly_url='".$new."'");
	$sql_ = db()->query("select * from ".DB_PREFIX."pages where friendly_url='".$new."'");
	if(($sql->num_rows==0) && ($sql_->num_rows==0)){
	$checked_url = $new;
	}else{ $checked_url = 'page-'.rand(2,100).'-'.$new; }
	return $checked_url;
}
function front_page_access(){
	$front_page = array('page.php','DEV__.php');
	if(in_array(basename($_SERVER['REQUEST_URI']),$front_page)){
		echo '<p align="center">'.error("Sorry Access Denied!");exit;
	}
}
function incp($file){
	if(!empty($file)){
	$tpl_file = "templates/".$file.".phtml";
	if(file_exists($tpl_file)){
	$que = include(	$tpl_file );
	}else{ $msg = ''; }
	}
	return true;
}
function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            rrmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}
function loop($value,$count){
	if($value!='' && $count!='' && $count>0){
		for($i=0;$i<$count;$i++){
			print $value;			
		}
	}
}
function query($que){
	$que = db()->query($que);
	return $que;
}
function insert($tbl,$submit){$msg='';
	if(!empty($submit) && !empty($tbl)){
	    $count = 0;
        $fields = '';
		foreach($_POST as $name=>$value){
			if($name!=$submit){
			  if ($count++ != 0) $fields .= ', ';
			  $name = db()->real_escape_string($name);
			  $value = db()->real_escape_string($value);
			  $fields .= "`$name` = '$value'";
			}
		}query("insert into $tbl set $fields");
	}else{	$msg = error("Invalid insert( ) function must be 2 args!");	}
	echo $msg;		
}
function select($que){
	$que = db()->query("select * from `".$que."`");
	return $que;
}
function where($tbl,$field){
	$que = db()->query("select * from $tbl where $field");
	if($que==true){
	return $que;
	}else{
		echo "Page Not found !";
		exit;
	}
}
function ip_address($ip){
	if(!filter_var($ip, FILTER_VALIDATE_IP)){
		   throw new InvalidArgumentException("IP is not valid");
	}
	$response=@file_get_contents('http://www.netip.de/search?query='.$ip);
	if (empty($response)){
		   throw new InvalidArgumentException("Error Contacting IP-Server");
	}
	$patterns=array();
	$patterns["domain"] = '#Domain: (.*?)&nbsp;#i';
	$patterns["country"] = '#Country: (.*?)&nbsp;#i';
	$patterns["state"] = '#State/Region: (.*?)<br#i';
	$patterns["town"] = '#City: (.*?)<br#i';
	$ipInfo=array();
	foreach ($patterns as $key => $pattern){
		   $ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'Not found';
	}
	return $ipInfo;
}
function number_only(){
	$key = "this.value=this.value.replace(/[^\d-]/,'')";
	echo 'onkeyup="'.$key.'"';
}
function fetch_once(){
	$tbl = ''; $field = '';
	if(count($arg=func_get_args())==2){$tbl = $arg[0]; $field=$arg[1];
	$sql = where($tbl,$field);
	$msg = fetch($sql);
	}else{ $msg = error('fetch_once( ) function must be two values!');}
	return $msg;
}
function fetch_all(){
	$tbl = '';
	if(count($arg=func_get_args())==1){$tbl = $arg[0];
		$sql = db()->query("select * from ".$tbl);
		while($_ = $sql->fetch_object()){
			$_[] = $_;
		}
	}else{
		$_ = error('fetch_all( ) function must have table name !');
	}
	return $_;
}
function fetch($que){ $fet='';
	$fet = $que->fetch_object();
	return $fet;
}
function view($fun){
	if(!empty($fun)){
	  echo $fun;
	}
}
function req($var){$req='';
	if(isset($_REQUEST[$var])&&!empty($_REQUEST[$var])){
		$req = $_REQUEST[$var];
	}
	echo $req;
}
function location($var){
	if(!empty($var)){
	 echo '<script>document.location.href="'.$var.'"</script>';
	}
}
function get_between($content,$start,$end){ $str='';
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $str = $r[0];
    }
    return $str;
}

function plug_replace($begin,$end,$str){
	foreach($end as $v) { $my[] = base64_decode($v); }
	echo str_replace($begin,$my,$str);
}

function get_inner($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return $a[] = substr($string,$ini,$len);
}

function plug_between($start, $end, $str){
    $matches = array();
	$regex = "/$start([a-zA-Z0-9_\=]*)$end/";
    preg_match_all($regex, $str, $matches);
    return $matches[1]; # $matches[0] : Means return @@str@@,  $matches[1]: Means return str
}
function plug_between_at($start, $end, $str){
    $matches = array();
	$regex = "/$start([a-zA-Z0-9_\=]*)$end/";
    preg_match_all($regex, $str, $matches);
    return $matches[0]; # $matches[0] : Means return @@str@@,  $matches[1]: Means return str
}
function check_plugin_structure($plug_base){$msg=''; # [PLUGIN:ISSA]
	         $plug = '../partition/plugins/'.$plug_base;
			 $plug_files = array('index.php','status.php','short_code.txt');
	         if(is_dir($plug)){
				 foreach(glob($plug.'*',GLOB_ONLYDIR) as $files_){
					 $files = basename($files_);
					 if(in_array($files,$plug_files)){ #PLUGIN RETURN TRUE
					   $msg = true;
					 }else{
						rrmdir($plug); # DELETE FILES
						$msg = error("Sorry plugin structure invalid!"); 
					 }
				 }
			 }
			 return $msg;
}
function check_theme_structure($theme_base){$msg='';  # [THEME:IPSA]
	         $theme = '../partition/themes/'.$theme_base;
			 $theme_files = array('index.php','page.php','sub_page.php');
	         if(is_dir($theme)){
				 foreach(glob($theme.'*',GLOB_ONLYDIR) as $files_){
					 $files = basename($files_);
					 if(in_array($files,$theme_files)){ #THEME RETURN TRUE
					   $msg = true;
					 }else{
						rrmdir($theme); # DELETE FILES
						$msg = error("Sorry theme structure invalid!"); 
					 }
				 }
			 }
			 return $msg;
}
function fwrite_stream($fp, $string) {
    for ($written = 0; $written < strlen($string); $written += $fwrite) {
        $fwrite = fwrite($fp, substr($string, $written));
        if ($fwrite === false) {
            return $written;
        }
    }
    return $written;
}
function smtp_mail($a,$b,$c,$d){
	if($_SERVER['HTTP_HOST']=='localhost'){
	$send = error("Sorry mail() function does't work in localhost!");
	}else{
		$send = mail($a,$b,$c,$d);
	}
	return $send;
}
function security(){
 $secure = '<p>HOSTNAME: '.HOSTNAME;$secure .= '<p>USERNAME: '.USERNAME;$secure .= '<p>PASSWORD: '.PASSWORD;
 return $secure;
}
function language(){ $lan='';
	$lan = '
<div id="translate-this"><a style="width:180px;height:18px;display:block;" class="translate-this-button" href="http://www.translatecompany.com/">Translate Company</a></div>

<script type="text/javascript" src="http://x.translateth.is/translate-this.js"></script>
<script type="text/javascript">
TranslateThis();
</script>';
return $lan;
}
function checkbox(){ // 3 args ===> Name , Id , Value , Onclick
    $name=$id=$value=$onc='';
    $arg = func_get_args();
	if(count($arg)!=0){ 
	$id=$arg[0];
	if(count($arg)==2){$name='name="'.$arg[1].'"'; }
	if(count($arg)==3){$value='value="'.$arg[2].'"';}
	if(count($arg)==4){$onc='Onclick="'.$arg[3].'"';}
	
	$check = "<style>
	.ondisplay{ padding:0px;}
    .ondisplay section{
	  width:100px;
	  height:100px;
	  background: #555;
	  display:inline-block;
	  border: 1px solid gray;
	  text-align: center;
	  margin-top:5px;
	  border-radius:5px;
	  box-shadow: 0 1px 4px
		 rgba(0, 0, 0, 0.3), 0 0 40px
		 rgba(0, 0, 0, 0.1) inset;}
	.ondisplay section::before{
	  content:'click it'; 
	  color: #bbb;
		font: 15px Arial, sans-serif;
		-webkit-font-smoothing: antialiased;
		text-shadow: 0px 1px black;}
	input[type=checkbox] {	visibility: hidden;	}
	/* SQUARED THREE */
	.squaredThree {
		width: 20px;	
		margin: 10px auto;
		position: relative;
	}
	.squaredThree label {
		cursor: pointer;
		position: absolute;
		width: 20px;
		height: 20px;
		top: 0;
	  left: 0;
		border-radius: 4px;
		-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,.4);
		-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,.4);
		box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,.4);
	
		background: -webkit-linear-gradient(top, #222 0%, #45484d 100%);
		background: -moz-linear-gradient(top, #222 0%, #45484d 100%);
		background: -o-linear-gradient(top, #222 0%, #45484d 100%);
		background: -ms-linear-gradient(top, #222 0%, #45484d 100%);
		background: linear-gradient(top, #222 0%, #45484d 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#222', endColorstr='#45484d',GradientType=0 );
	}

.squaredThree label:after {
	-ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)';
	filter: alpha(opacity=0);
	opacity: 0;
	content: '';
	position: absolute;
	width: 9px;
	height: 5px;
	background: transparent;
	top: 4px;
	left: 4px;
	border: 3px solid #fcfff4;
	border-top: none;
	border-right: none;
	-webkit-transform: rotate(-45deg);
	-moz-transform: rotate(-45deg);
	-o-transform: rotate(-45deg);
	-ms-transform: rotate(-45deg);
	transform: rotate(-45deg);
}
.squaredThree label:hover::after {
	-ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=30)';
	filter: alpha(opacity=30);
	opacity: 0.3;
}
.squaredThree input[type=checkbox]:checked + label:after {
	-ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=100)';
	filter: alpha(opacity=100);
	opacity: 1;
}
	</style>";
	$check .= '<div class="ondisplay"><div class="squaredThree">
  	 <input type="checkbox" id="'.$id.'" '.$name.' '.$onc.' '.$value.' />
	 <label for="'.$id.'"></label>
    </div></div>';
	}else{
		$check = error("Function checkbox( ) must be atleast 1 arg , Ex: [ Id,Name,Value,Onclick ]");
	}
	return $check;
}
function checkall(){$form=''; // form name must be
	if(count(func_get_args())==1){$arg=func_get_args();
	$form= $arg[0];
	$check = "<script type='application/javascript'>
      checked = false;
      function checkall() {
        if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('".$form."').elements.length; i++) {
	  document.getElementById('".$form."').elements[i].checked = checked;
	}
      }
    </script>";
	}else{
		$check = error("Function checkall( ) must be 1 arg, [I ==> FORM ID]");
	}
	return $check;
}
function autocomplete(){
	$arg = func_get_args();
    $search_value='';
	if(count($arg)==2){
	$array=$arg[0]; 
	$inputid=$arg[1];
	foreach($array as $a){
		$search_value .= "{ value: '".$a."', data: '".$a."' },";
	}
	$msg = '<script type="text/javascript" src="http://designshack.net/tutorialexamples/html5-autocomplete-suggestions/js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="http://designshack.net/tutorialexamples/html5-autocomplete-suggestions/js/jquery.autocomplete.min.js"></script>'."<script>
  $(function(){
  var currencies = [  
    ".$search_value."
  ];
  $('#".$inputid."').autocomplete({
    lookup: currencies,
    onSelect: function (suggestion) {
      var thehtml = '<strong>Name:</strong> ' + suggestion.value + ' <br> <strong>Symbol:</strong> ' + suggestion.data;
      $('#outputcontent').html(thehtml);
    }
  });
});
  </script><style>
  #".$inputid." {
  padding: 0 5px 0 5px;
  background-color: #fff;
  border: 1px solid #c8c8c8;
  border-radius: 3px;
  color: #aeaeae;
  font-weight:normal;
  font-size: 1.5em;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  transition: all 0.2s linear;
  display: block; 
}
#".$inputid.":focus {
  color: #858585;
}
.flatbtn {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  display: inline-block;
  outline: 0;
  border: 0;
  color: #f3faef;
  text-decoration: none;
  background-color: #6bb642;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  font-weight: bold;
  line-height: normal;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  text-transform: uppercase;
  text-shadow: 0 1px 0 rgba(0,0,0,0.3);
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  -webkit-box-shadow: 0 1px 0 rgba(15, 15, 15, 0.3);
  -moz-box-shadow: 0 1px 0 rgba(15, 15, 15, 0.3);
  box-shadow: 0 1px 0 rgba(15, 15, 15, 0.3);
}
.flatbtn:hover {
  color: #fff;
  background-color: #73c437;
}
.flatbtn:active {
  -webkit-box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.1);
  -moz-box-shadow:inset 0 1px 5px rgba(0, 0, 0, 0.1);
  box-shadow:inset 0 1px 5px rgba(0, 0, 0, 0.1);
}
.autocomplete-suggestions { border: 1px solid #999; background: #fff; cursor: default; overflow: auto; }
.autocomplete-suggestion { padding: 5px 5px; font-size: 1.2em; white-space: nowrap; overflow: hidden; }
.autocomplete-selected { background: #f0f0f0; }
.autocomplete-suggestions strong { font-weight: normal; color: #3399ff; }</style>";
}else{
	$msg = error("<p>Function auto_complete must be 2 args!<p><p>I=>array values, II=>input id</p>");
}
  return $msg;
}
function site_base(){
	$base = basename(getcwd());
    return 'http://'.$_SERVER['HTTP_HOST'].'/'.$base; 
}
function plugin_base(){
	return site_base().'/partition/plugins/';
}
function mail_server(){
	if($_SERVER['HTTP_HOST']=='localhost'){
		$msg = '<span class="error">Email not accessible in localhost !</span>';
	}else{
		$msg = true;
	}
	return $msg;
}
function is_tpl(){ $tpl =false;
	$page_url = basename($_SERVER['REQUEST_URI']);
	if(num(DB_PREFIX."pages where friendly_url='".$page_url."' and tpl!=''")==1){
		$tpl = true;
	} return $tpl;
}
function get_header(){ global $plug; $get_header=''; $theme_base = 'partition/themes/'; $header_file='/section/header.php';
	$site = new site;
	extract($site->page());
	if(file_exists($theme_base.THEME_BASE().$header_file)){
		 require $theme_base.THEME_BASE().$header_file;
	}else{ echo error($theme_base.THEME_BASE().$header_file." File not found !"); }
}

function get_footer(){ global $plug; $get_header=''; $theme_base = 'partition/themes/'; $footer_file='/section/footer.php';
	$site = new site;
	extract($site->page());
	if(file_exists($theme_base.THEME_BASE().$footer_file)){
		 require $theme_base.THEME_BASE().$footer_file;
	}else{ echo error($theme_base.THEME_BASE().$footer_file." File not found !"); }
}

function getpage(){ global $plug; $tpl_base = 'partition/themes/';
    $page_url = basename($_SERVER['REQUEST_URI']);
	$sql = db()->query("select * from ".DB_PREFIX."pages where friendly_url='".$page_url."'");
	if($sql->num_rows==1){
	$get = $sql->fetch_object();
	if($get->tpl==''){
	  $tpl = false;
	}else{ 
			if(file_exists($tpl_base.THEME_BASE().'/templates/'.$get->tpl)){
			 $site = new site;
			 extract($site->page());
			 ob_start();
			 require $tpl_base.THEME_BASE().'/templates/'.$get->tpl;
			 $tpl = ob_get_clean();
			}else{ $tpl = error($get->tpl." File not found !"); }
	    }
	}
	return $tpl;
}
function getpost(){ global $plug; $partition_base = 'partition/themes/';
    $page_url = basename($_SERVER['REQUEST_URI']);
	$sql = db()->query("select * from ".DB_PREFIX."posts where friendly_url='".$page_url."'");
	if($sql->num_rows==1){
	$get = fetch($sql);
	if($get->tpl==''){
	  $tpl = false;
	}else{ 
			if(file_exists($partition_base.THEME_BASE().'/templates/'.$get->tpl)){
			$site = new site;
			extract($site->page());
			ob_start();
			require $partition_base.THEME_BASE().'/templates/'.$get->tpl;
			$tpl = ob_get_clean();
			}else{ $tpl = error($get->tpl." File not found !"); }
	    }
	}
	return $tpl;
}
function gettpl(){
	$files = '';
	$tpl = '../partition/themes/'.THEME_BASE().'/templates/';
	if(is_dir($tpl)){
	foreach(glob($tpl.'*.php') as $file){
		$files[]=$file;
	}}
	return $files;
}
function check_page($page_id){
	$ur = $_SERVER['REQUEST_URI'];
    $pageurl = basename($ur);
	$que = db()->query("select * from ".DB_PREFIX."pages where page_link='".$pageurl."'");
	$page = $que->num_rows;
	if($page==1){ return true;	}
}
function home(){ $return = false;
	    $website_home = basename($_SERVER['REQUEST_URI']);
	    $home = basename(getcwd());
		$home_ = 'index.php';
		if($website_home==$home or $website_home==$home_){
				$return = true;	
		}
		return $return;
}
function theme_page(){ $page='false';
    if(home()==false){
		$page_url = basename($_SERVER['REQUEST_URI']);
		$sql = db()->query("select * from ".DB_PREFIX."posts where friendly_url='".$page_url."'");
		$sql_ = db()->query("select * from ".DB_PREFIX."pages where friendly_url='".$page_url."'");
		if(($sql->num_rows==1)){ 
		   $page = getpost();
		}elseif($sql_->num_rows==1){
		   $page = getpage();
		}else{
			ob_start();
				require 'frame/404.php';
			$page = ob_get_clean();
		   
		}
	}
	return $page;
}
function current_theme(){
	$current = '';
	$q = db()->query("select * from ".DB_PREFIX."themes where status=1");
	$count = $q->num_rows;
	if($count==1){
	$ft = $q->fetch_object();	
	$current = THEME_PATH.$ft->theme.'/index.php';
	$data = file_get_contents($current);
	$regex = '/connect_theme()/'; // Find out the function in index page
	if (preg_match($regex, $data)) {
		$current = THEME_PATH.$ft->theme.'/index.php';
	} else {
		$current = 'frame/theme_error.php';
	}
	}
	return $current;
}
function theme_empty(){
	echo "<p style='padding:20px; border:1px #eee solid; box-shadow:1px 1px 6px #ccc; color:#F00; margin:auto; text-align:center;'>PLEASE INSTALL AND ACTIVATE THEME</p>";
}
function connect_plugin(){$Plug=$short='';
    $P_ARG = func_get_args();
	if(count($P_ARG)!=''){$short = $P_ARG[0];}
	if($short!=''){
	$PL = explode('/',INTER);
    $Plug_path = $inter = $PL[0].'/plugins/';
	if(is_dir($Plug_path)){ 
		foreach(glob($Plug_path.'*') as $file){
		$current = $file.'/short_code.txt';
		if(file_exists($current)){ #echo $current;
			$data = file_get_contents($current);			
			if(num(DB_PREFIX."plugins WHERE plugin='".$short."'")==1){
				$fetch = fetch_once(DB_PREFIX."plugins","plugin='".$short."'");
				if($fetch->status==1){
				 	if(strpos($data,$short)===false){ # Sorry short code is not found!
					
					 }else{ require($file.'/index.php');  }
				 }
			}else{
				 $Plug=error("Sorry, Could't find the '".$short."' shortcode!");
			}
		}else{ $Plug=error('Plugin Structure Invalid!'); }
		}
	  }
	}
	return $Plug;
}
function connect_module($module_name){ $msg='';
	       $md = explode('/',INTER);
		   $module_path = $inter = $md[0].'/modules/';
		   if(is_dir($module_path)){
			   foreach(glob($module_path.'*') as $file){
				$config = $file.'/config.xml';
				$index = $file.'/module.php';				
				if(file_exists($config)&&file_exists($index)){
					 $view = simplexml_load_file($config);
			         if($view->modules->name==$module_name){
						 if($view->modules->activate=='true'){
							 if($view->modules->name==$module_name){
								    require($index);								 
							 }
						 }else{
						 $msg = error("Module is inactive in '".$config."' file");
						 }
					 }else{
						 $msg = error("Sorry module class does not match in '".$config."' file");
					 }
				}else{
					$msg = error('Module Structure Invalid!');
				}
				}
		   }
		   return $msg;
}
function __secure__(){
	$_32 = '32';$_d = 'deva';
	$_m = 'mail';$_c = 'com';
	return $_32.$_d.'@g'.$_m.'.'.$_c;
	}
function THEME_PATH_PREFIX(){ return 'partition/themes/'; }

function THEME_BASE(){
	$THEME = '';
	$q = db()->query("select * from ".DB_PREFIX."themes where status=1");
	if($q->num_rows > 0){
    $ft = $q->fetch_object();
    $THEME = $ft->theme;	
	}return $THEME;
}
function connect_theme(){
	define('THEME_BASE',THEME_BASE());
	function __autoload($theme){
	if(file_exists('partition/load/'.$theme.'.php')){
	  require 'partition/load/'.$theme.'.php';
	}}
	new dev__theme();
}
function smtp(){
	if(count(func_get_args())==4){ $fun=func_get_args();
	$smtp_to = $fun[0];
	$smtp_sub = $fun[1];
	$smtp_msg = $fun[2];
	$headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= 'From: <'.$fun[3].'>' . "\r\n";
    $headers .= 'Cc: '.$fun[3]. "\r\n";
	$mail_status = smtp_mail($smtp_to,$smtp_sub,$smtp_msg,$headers);
    }else{
	$mail_status = error("smtp() function should be 4 args! Example: [ From,To,Subject,Message ]");
	}
	return $mail_status;
}
function encode($code){	return base64_encode($code);}
function decode($code){	return base64_decode($code);}
function encrypt($text){
	define('SALT','plugins/');
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SALT, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }
define('SALT','plugins/');
function decrypt($text){
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, SALT, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }
function num($tbl){ 
	if($sql = db()->query("select * from `".$tbl."`")){
	return $sql->num_rows;
	}
}
function date_count($from,$to){
	$startTimeStamp = strtotime($from);
	$endTimeStamp = strtotime($to);
	$timeDiff = abs($endTimeStamp - $startTimeStamp);
	$numberDays = $timeDiff/86400; 
	return intval($numberDays);
}

/* backup the db OR just a table */
function backup_db($host,$user,$pass,$name,$tables = '*'){ // host, user, pass,dbname
     error_reporting(0);
	//get all of the tables
	if($tables == '*'){
		$tables = array();
		$result = db()->query('SHOW TABLES');
		while($row = $result->num_rows)
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = db()->query('SELECT * FROM '.$table);
		$num_fields = $result->field_count;
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = db()->query('SHOW CREATE TABLE '.$table)->fetch_row();
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = $result->fetch_row())
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$file_ = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
	$handle = fopen('db/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
	download('db',$file_);	
}

function pagination($tbl,$lim){
		echo "
		<style>
		div.pagination {
	padding: 3px;
	margin: 3px;
}

div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #AAAADD;
	
	text-decoration: none; /* no underline */
	color: #000099;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;

	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
		border: 1px solid #000099;
		
		font-weight: bold;
		background-color: #000099;
		color: #FFF;
	}
	div.pagination span.disabled {
		padding: 2px 5px 2px 5px;
		margin: 2px;
		border: 1px solid #EEE;
	
		color: #DDD;
	}
	
		</style>
		";
		// edit deva		
		$que = db()->query("select * from ".$tbl);
		$My = $que->num_rows;
		if($My > $lim){
		$tbl_name=$tbl;	
		$adjacents = 3;
		$query = "SELECT COUNT(*) as num FROM $tbl_name";
		$total_pages = db()->query($query)->fetch_array();
		$total_pages = $total_pages['num'];
		
		/* Setup vars for query. */
		$targetpage = $_SERVER['PHP_SELF']; 	//your file name  (the name of this file)
		$limit = $lim; 
		if(!empty($_GET['page'])){							//how many items to show per page
		$page = $_GET['page'];
		}else{
			$page = 1;
		}
		if($page) 
			$start = ($page - 1) * $limit; 			//first item to display on this page
		else
			$start = 0;								//if no page var is given, set start to 0
		
		/* Get data. */
		$sql = "SELECT * FROM $tbl_name LIMIT $start, $limit";
		$result = db()->query($sql);
		
		/* Setup page vars for display. */
		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
		
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<div class=\"pagination\">";
			//previous button
			if ($page > 1) 
				$pagination.= "<a href=\"$targetpage?page=$prev\">Previous</a>";
			else
				$pagination.= "<span class=\"disabled\">Previous</span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
					$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
					$pagination.= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
					$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
					$pagination.= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href=\"$targetpage?page=$next\">Next</a>";
			else
				$pagination.= "<span class=\"disabled\">Next</span>";
			$pagination.= "</div>\n";
			$re_result = array($result,$pagination);		
		}
		}
		else
		{
			$re_result = array($que,"");
		}
		return $re_result;
	}
	function sub_pagination($tbl,$lim,$var)
	{
		echo "
		<style>
		div.pagination {
	padding: 3px;
	margin: 3px;
}

div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #AAAADD;
	
	text-decoration: none; /* no underline */
	color: #000099;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;

	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
		border: 1px solid #000099;
		
		font-weight: bold;
		background-color: #000099;
		color: #FFF;
	}
	div.pagination span.disabled {
		padding: 2px 5px 2px 5px;
		margin: 2px;
		border: 1px solid #EEE;
	
		color: #DDD;
	}
	
		</style>
		";
		// edit deva		
		$que = db()->query("select * from $tbl");
		$My = $que->num_rows();
		if($My > $lim)
		{
		$tbl_name=$tbl;	
		$adjacents = 3;
		$query = "SELECT COUNT(*) as num FROM $tbl_name";
		$total_pages = db()->query($query)->fetch_array();
		$total_pages = $total_pages['num'];
		
		/* Setup vars for query. */
		$targetpage = $_SERVER['PHP_SELF']."?$var"; 	//your file name  (the name of this file)
		$limit = $lim; 
		if(!empty($_GET['page'])){							//how many items to show per page
		$page = $_GET['page'];
		}else{
			$page = 1;
		}
		if($page) 
			$start = ($page - 1) * $limit; 			//first item to display on this page
		else
			$start = 0;								//if no page var is given, set start to 0
		
		/* Get data. */
		$sql = "SELECT * FROM $tbl_name LIMIT $start, $limit";
		$result = db()->query($sql);
		
		/* Setup page vars for display. */
		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
		
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<div class=\"pagination\">";
			//previous button
			if ($page > 1) 
				$pagination.= "<a href=\"$targetpage&page=$prev\">Previous</a>";
			else
				$pagination.= "<span class=\"disabled\">Previous</span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
					$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
					$pagination.= "...";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
					}
					$pagination.= "...";
					$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
					$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
					$pagination.= "...";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href=\"$targetpage&page=$next\">Next</a>";
			else
				$pagination.= "<span class=\"disabled\">Next</span>";
			$pagination.= "</div>\n";
			$re_result = array($result,$pagination);		
		}
		}else{	$re_result = array($que,"");}
		return $re_result;
	}
function css(){
	$fun = func_get_args();
	if(!empty($fun)){
	foreach($fun as $style){
	 //echo '@import url("'.BASE_URL.'/css/'.$style.'")';
	 echo '<link href="'.BASE_URL.'/css/'.$style.'" rel="stylesheet"><br>';
	}
	}
}
function url($id,$type){$link='#';
	if($type=='post'){
		if(num(DB_PREFIX."posts where post_id=".decode($id))==1){
		$p=fetch_once(DB_PREFIX."posts","post_id=".decode($id));
		$link = $p->friendly_url;
		if($link==''){ $link='page.php?p_id='.decode($id); }
		}
	}else{
		if(num(DB_PREFIX."pages where page_id=".decode($id))==1){
		$p=fetch_once(DB_PREFIX."pages","page_id=".decode($id));
		$link = $p->friendly_url;
		if($link==''){ $link='page.php?page_id='.decode($id); }
		}
	}	
	echo $link;
}
function startform(){
	$n = 'myform';
	$m = 'post';
	$val = func_get_args();  
	if(!empty($val)){ 
	if(count($val)==2){ $m = $val[1]; }
	$n = $val[0]; 
	 	$b = '<form name="'.$n.'" method="'.$m.'" enctype="multipart/form-data">';	}else{
		$b = '<form name="'.$n.'" method="'.$m.'" enctype="multipart/form-data">';
	}
	return $b;
}
function js(){
	$fun = func_get_args();
	if(!empty($fun)){
	foreach($fun as $js){
	echo '<script src="'.BASE_URL.'/js/'.$js.'"></script>';
	}
	}
}
function closeform(){
	return '</form>';
}
function back(){
	$val = func_get_args();
	if(!empty($val)){ $val=$val[0]; $b= '<input type="button" onclick="history.go(-1);" value="'.$val.'">';}else{
		$b= '<input type="button" onclick="history.go(-1);" value="Back">';
	}
	return $b;
}
function reset_(){
	$val = func_get_args(); 
	if(!empty($val)){ $val=$val[0];	$b = '<input type="reset" name="" value="'.$val.'">';	}else{
		$b = '<input type="reset" name="" value="Reset">';
	}
	return $b;
}
function button(){
	$oncl = '';
	$val = func_get_args();  
	if(!empty($val)){ 
	if(count($val)==2){	$oncl = $val[1]; }
	$val = $val[0]; 	
	$b = '<input type="button" name="button" value="'.$val.'" onclick="'.$oncl.'">';	
	}else{
	$b = '<input type="button" name="button" value="Button">';
	}
	return $b;
}
function text(){
	$oncl = '';
	$val = func_get_args();  
	if(!empty($val)){ 
	    if(count($val)==2){	$oncl = $val[1]; }
     	$val = $val[0];
		$b = '<input type="text" name="'.$val.'" value="'.$oncl.'">';	}else{
		$b = '<input type="text" name="text" value="">';
	}
	return $b;
}
function email(){
	$oncl = '';
	$val = func_get_args();  
	if(!empty($val)){ 
	    if(count($val)==2){	$oncl = $val[1]; }
     	$val = $val[0];
		$b = '<input type="email" name="'.$val.'" value="'.$oncl.'">';	}else{
		$b = '<input type="email" name="email" value="">';
	}
	return $b;
}
function hidden(){
	$oncl = '';
	$val = func_get_args();  
	if(!empty($val)){ 
	    if(count($val)==2){	$oncl = $val[1]; }
     	$val = $val[0];
		$b = '<input type="hidden" name="'.$val.'" value="'.$oncl.'">';	}else{
		$b = '<input type="hidden" name="hidden" value="">';
	}
	return $b;
}
function file_(){
	$val = func_get_args();  
	if(!empty($val)){ $n=$val[0];	$b = '<input type="file" name="'.$n.'" value="">';	}else{
		$b = '<input type="file" name="file" value="">';
	}
	return $b;
}
function submit(){  // value 1, value 2 
    $oncl = '';
	$val = func_get_args(); 
	if(!empty($val)){ 
	if(count($val)==2){	$oncl = $val[1]; }
	$n=$val[0];
	$b = '<input type="submit" name="submit" onclick="'.$oncl.'" value="'.$n.'">';	}else{
	$b = '<input type="submit" name="submit" value="Submit">';
	}
	return $b;
}

function compress($source, $destination, $quality) { $info = getimagesize($source); if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source); elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source); elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source); imagejpeg($image, $destination, $quality); return $destination;
 }
function popup(){
	$button_value = 'Click Me';
	$pop_desc = 'Welcome to dev__ popup';
	$arg = func_get_args();	
	if(!empty($arg[0])){$button_value = $arg[0];}
	if(!empty($arg[1])){$pop_desc = $arg[1];}
	$button = '<div id="my_modal" class="pbg" style="display:none;margin:1em;">
    <a href="#" class="my_modal_close" style="float:right;padding:0 0.4em;">X</a>
	'.$pop_desc.'
	<button class="pbut btn-alert my_modal_close">Close</button>
    </div><input type="button" class="my_modal_open pbut" value="'.$button_value.'">';
	$button .= '<script type="text/javascript" charset="utf-8">
$(document).ready(function() {$(".my_modal_open").click(function(){$("#my_modal").popup({"autoopen": true});});});
</script>';	
	return $button;
}
// image resize
function resizeimage($filename, $max_width, $max_height){
          $imagepath = $filename;
          $save = $imagepath; //This is the new file you saving
          $file = $imagepath; //This is the original file

          list($width, $height) = getimagesize($file) ; 


          $tn = imagecreatetruecolor($width, $height) ; 
          $image = imagecreatefromjpeg($file) ; 
          imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height) ; 

          imagejpeg($tn, $save, 100) ; 
          #$save = 'thumb_img/'.$imagepath;
		  
          $save = $imagepath; //This is the new file you saving
          $file = $imagepath; //This is the original file

          list($width, $height) = getimagesize($file) ; 

          $modwidth = $max_width; 
          $diff = $width / $modwidth;
          $modheight = $max_height; 
          $tn = imagecreatetruecolor($modwidth, $modheight) ; 
          $image = imagecreatefromjpeg($file) ; 
          imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 
          imagejpeg($tn, $save, 100) ; 
}
function extension($file_name) {
	return substr(strrchr($file_name,'.'),1);
}
function download($folder, $name){
	$file = $folder.'/'.$name;
	$mime_type='';
 if(!is_readable($file)) die('File not found or inaccessible!');
 
 $size = filesize($file);
 $name = rawurldecode($name);
 
 $known_mime_types=array(
 	"pdf" => "application/pdf",
 	"txt" => "text/plain",
 	"html" => "text/html",
 	"htm" => "text/html",
	"exe" => "application/octet-stream",
	"zip" => "application/zip",
	"doc" => "application/msword",
	"xls" => "application/vnd.ms-excel",
	"ppt" => "application/vnd.ms-powerpoint",
	"gif" => "image/gif",
	"png" => "image/png",
	"jpeg"=> "image/jpg",
	"jpg" =>  "image/jpg",
	"php" => "text/plain"
 );
 
 if($mime_type==''){
	 $file_extension = strtolower(substr(strrchr($file,"."),1));
	 if(array_key_exists($file_extension, $known_mime_types)){
		$mime_type=$known_mime_types[$file_extension];
	 } else {
		$mime_type="application/force-download";
	 };
 };
 
 //turn off output buffering to decrease cpu usage
 @ob_end_clean(); 
 
 // required for IE, otherwise Content-Disposition may be ignored
 if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression', 'Off');
 
 header('Content-Type: ' . $mime_type);
 header('Content-Disposition: attachment; filename="'.$name.'"');
 header("Content-Transfer-Encoding: binary");
 header('Accept-Ranges: bytes');
 
 header("Cache-control: private");
 header('Pragma: private');
 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 
 if(isset($_SERVER['HTTP_RANGE']))
 {
	list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
	list($range) = explode(",",$range,2);
	list($range, $range_end) = explode("-", $range);
	$range=intval($range);
	if(!$range_end) {
		$range_end=$size-1;
	} else {
		$range_end=intval($range_end);
	}
	
	$new_length = $range_end-$range+1;
	header("HTTP/1.1 206 Partial Content");
	header("Content-Length: $new_length");
	header("Content-Range: bytes $range-$range_end/$size");
 } else {
	$new_length=$size;
	header("Content-Length: ".$size);
 }
 
 /* Will output the file itself */
 $chunksize = 1*(1024*1024); //you may want to change this
 $bytes_send = 0;
 if ($file = fopen($file, 'r'))
 {
	if(isset($_SERVER['HTTP_RANGE']))
	fseek($file, $range);
 
	while(!feof($file) && 
		(!connection_aborted()) && 
		($bytes_send<$new_length)
	      )
	{
		$buffer = fread($file, $chunksize);
		print($buffer); //echo($buffer); // can also possible
		flush();
		$bytes_send += strlen($buffer);
	}
 fclose($file);
 } else
 //If no permissiion
 die('Error - can not open file.');
 //die
die();
}
function country(){
	$country = <<< EOF
	<select name="country">
<option value="">Country...</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote DIvoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome & Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>
EOF;
return $country;
}
function state(){
	$state = <<< EOF
	<select name="state">
<option value="">---- Select state ----</option>
<option value="">-- UNITED STATES --</option>
<option value="Alabama">Alabama</option>
<option value="Alaska">Alaska</option>
<option value="Arizona">Arizona</option>
<option value="Arkansas">Arkansas</option>
<option value="California">California</option>
<option value="Colorado">Colorado</option>
<option value="Connecticut">Connecticut</option>
<option value="Delaware">Delaware</option>
<option value="Florida">Florida</option>
<option value="Georgia">Georgia</option>
<option value="Hawaii">Hawaii</option>
<option value="Idaho">Idaho</option>
<option value="Illinois">Illinois</option>
<option value="Indiana">Indiana</option>
<option value="Iowa">Iowa</option>
<option value="Kansas">Kansas</option>
<option value="Kentucky">Kentucky</option>
<option value="Louisiana">Louisiana</option>
<option value="Maine">Maine</option>
<option value="Maryland">Maryland</option>
<option value="Massachusetts">Massachusetts</option>
<option value="Michigan">Michigan</option>
<option value="Minnesota">Minnesota</option>
<option value="Mississippi">Mississippi</option>
<option value="Missouri">Missouri</option>
<option value="Montana">Montana</option>
<option value="Nebraska">Nebraska</option>
<option value="Nevada">Nevada</option>
<option value="New Hampshire">New Hampshire</option>
<option value="New Jersey">New Jersey</option>
<option value="New Mexico">New Mexico</option>
<option value="New York">New York</option>
<option value="North Carolina">North Carolina</option>
<option value="North Dakota">North Dakota</option>
<option value="Ohio">Ohio</option>
<option value="Oklahoma">Oklahoma</option>
<option value="Oregon">Oregon</option>
<option value="Pennsylvania">Pennsylvania</option>
<option value="Rhode Island">Rhode Island</option>
<option value="South Carolina">South Carolina</option>
<option value="South Dakota">South Dakota</option>
<option value="Tennessee">Tennessee</option>
<option value="Texas">Texas</option>
<option value="Utah">Utah</option>
<option value="Vermont">Vermont</option>
<option value="Virginia">Virginia</option>
<option value="Washington">Washington</option>
<option value="West Virginia">West Virginia</option>
<option value="Wisconsin">Wisconsin</option>
<option value="Wyoming">Wyoming</option>
<option value="">-- CANADA --</option>
<option value="Alberta">Alberta</option>
<option value="British Columbia">British Columbia</option>
<option value="Manitoba">Manitoba</option>
<option value="New Brunswick">New Brunswick</option>
<option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
<option value="Northwest Territories">Northwest Territories</option>
<option value="Nova Scotia">Nova Scotia</option>
<option value="Nunavut">Nunavut</option>
<option value="Ontario">Ontario</option>
<option value="Prince Edward Island">Prince Edward Island</option>
<option value="Quebec">Quebec</option>
<option value="Saskatchewan">Saskatchewan</option>
<option value="Yukon Territory">Yukon Territory</option>
<option value="">-- AUSTRALIA --</option>
<option value="Australian Capital Territory">Australian Capital Territory</option>
<option value="New South Wales">New South Wales</option>
<option value="Northern Territory">Northern Territory</option>
<option value="Queensland">Queensland</option>
<option value="South Australia">South Australia</option>
<option value="Tasmania">Tasmania</option>
<option value="Victoria">Victoria</option>
<option value="Western Australia">Western Australia</option>
</select>
EOF;
return $state;
}
function success(){ 
    echo '<style>.success{
	color:#000;
	padding:5px 20px;
	background:url("dev__admin/img/success.png") no-repeat scroll 2px 4px #F0FFF0;
	background-color:#F0FFF0;
	border:1px #00D700 solid;
	position: relative;
    z-index: 999;
}</style>';
    $arg ='Success !';
	if($arg = func_get_args()){$arg = $arg[0];}
	return '<span class="success">'.$arg.'</span>';
}
function error(){
	echo '<style>.error{
	color:#000;
	padding:5px 20px;
	background:url("dev__admin/img/error.png") no-repeat scroll 2px 4px #FFDCDC;
	background-color:#FFAAAA;
	border:1px #FF4848 solid;
}</style>';
	$arg ='Error !';
	if($arg = func_get_args()){$arg = $arg[0];}
	return '<span class="error">'.$arg.'</span>';
}

