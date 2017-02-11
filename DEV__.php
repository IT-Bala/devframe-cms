<?php
 
###############################
#                             #
#     PHP dev__ FRAMEWORK     #
#                             #
###############################
                             
#  DOUBLE OPTION FOR INDEX    
                             
/*
Option I :

CODE : $view->index();
it is normaly using for get template file from templates folder

Option II :

CODE : site::index();
it is using for control home page from dev__admin , go to
==> Setting ==> Site Profile ==> you can set the home page here
*/
include('frame/dev__.php');
$current= new $current; 
if($current->theme()!=''): 
  require($current->theme()); 
else: theme_empty(); endif;
?>


