<?php 
// PHP dev__ FRAMEWORK
include('frame/dev__.php'); 
$admin = new admin;
$msg = (isset($_REQUEST['Dev_Login']))?$admin->dev_login($_REQUEST):"";
if(isset($_REQUEST['timeout'])){
if(isset($_SESSION['Login']) && isset($_SESSION['expire'])){ 
session_destroy();
}header('location:login.php');}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DevFrame Admin Panel</title>
</head>
<link rel="stylesheet" href="login.css">
<script type="text/javascript" src="login.js"></script>
<body onload="onload();">
<div class="logo">
<h1><img src="img/logo.png" /></h1>
</div>
<div class="form">
<h1>Login</h1>
<div class="line"></div>
<?php echo $msg; ?>
<?php 
$admin->login_form(); ?>
</div>
</body>
<div id="social_share" style="position:fixed; top:170px;">
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js"></script>
<!-- Horizondal toolbox -->
<!--<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
  <a class="addthis_counter_facebook"></a>
  <a class="addthis_counter_twitter"></a>
  <a class="addthis_counter_pinterest_share"></a>
  <a class="addthis_counter_reddit"></a>
  <a class="addthis_counter_linkedin"></a>
</div>-->
<!-- Vertical toolbox -->
<div class="addthis_toolbox addthis_floating_style addthis_32x32_style">
  <a class="addthis_counter_facebook"></a>
  <a class="addthis_counter_twitter"></a>
  <a class="addthis_counter_pinterest_share"></a>
  <a class="addthis_counter_reddit"></a>
  <a class="addthis_counter_linkedin"></a>
  <a class="addthis_counter_google_plusone_share"></a>
</div>
</div>
</body>
</html>