<?php
// Remove the install directory
if(isset($_REQUEST['back']))
{
header("location:../index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Remove the install directory</title>
</head>
<style>
body
{
	margin:auto;
}
#wrapper
{
	margin:auto;
}
.container
{
	background:#eee;
	margin:10px;
	padding:0 0 20px 280px;
	border-radius:5px;
	box-shadow:1px 1px 5px #444;
}
p
{
	padding:30px;
	color:red;
}
</style>
<body>
<div id="wrapper">
<div class="container">
<p><strong>Error occured at install time !</strong></p>
<form method="post">
<span style="padding:0 0 0 100px;"><input type="submit" name="back" value="Click here to back" /></span></form>
</div>
</div>
</body>
</html>