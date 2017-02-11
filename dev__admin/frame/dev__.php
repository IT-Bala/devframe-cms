<?php
// PHP dev__ FRAMEWORK FRAME
include('../config/config.php');
include('../frame/function.php');
inc('./load/dev__');
if(file_exists('../install.php')){ header("location:../install.php"); }
#if(!file_exists('../install.php')){ if(is_dir('../un-install')){ rrmdir('../un-install'); } }
?>
