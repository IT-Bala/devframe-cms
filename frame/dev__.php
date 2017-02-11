<?php
// PHP dev__ FRAMEWORK
// DEFINE SECTION
echo 12312;
define('PLUG_BASE','plugins/');
define('THEME_PATH','partition/themes/');
include('frame/function.php');
include("load/dev__.php");
include("plug_load/plug_load.php");
$user = new user;
require('get_theme.php');

##############################
#   CHECK INSTALL DIRECTORY  #
##############################

// Go to install directory
if(file_exists('install.php')){ header("location:install.php"); }
$check_rm = basename($_SERVER['REQUEST_URI']);
if(!file_exists('install.php')){ if(is_dir('un-install')){ rrmdir('un-install'); } }

