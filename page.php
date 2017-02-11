<?php
// PHP dev__ FRAMEWORK
include('frame/dev__.php');
$current= new $current;
if($current->theme()!=''): 
  require($current->theme()); // sub page also enabled
else: theme_empty(); endif;
