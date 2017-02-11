<?php 
include('frame/dev__.php');  
if(isset($_REQUEST['fb'])){admin::update_font_family($_REQUEST);} 
if(isset($_REQUEST['fs'])){admin::update_font_size($_REQUEST);}
