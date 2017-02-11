<?php
// Remove the install directory
unlink("../install.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Remove the install directory</title>
<script>
function Home(){window.open('../');}
function Admin(){window.open('../dev__admin/');}
</script>
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
	color:#090;
}
</style>
<body>
<div id="wrapper">
<div class="container">
<p><strong>The Dev__ Framework Installed Successfully !</strong></p>
<span style="padding:0 0 0 80px;"><input type="button" name="Remove" value="Go To Site" onclick="Home();" /><input type="button" name="Remove" value="Go To Admin" onclick="Admin();" /></span>
</div>
</div>
</body>
</html>