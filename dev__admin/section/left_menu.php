<?php
error_reporting(0);
/* Theme And Plugin Menu integration */
#### THEME  ####
$left_menu = array();
require('inter_menu.php');  // It will take last include file class 
if(class_exists('theme_admin')){
$current_theme_admin_class = 'theme_admin'; // get end of the class 
if($current_theme_admin_class=='theme_admin'){
$get_theme_admin_menu = new $current_theme_admin_class();
if(method_exists('theme_admin','left_menu')){
 $left_menu = $get_theme_admin_menu->left_menu();
}
}
}
#### THEME  #####
########## PLUGIN INTERFACE ##############
$plug_left_menu = admin::left_menu_integration();
########## PLUGIN INTERFACE ##############
?>
<ul id="example4" class="accordion">
    <?php 
    foreach(admin::menu() as $menu=>$submenu)
    {
		if($menu=='Menus'){ #Add theme left
			if(count($left_menu)!=0){
			 foreach($left_menu as $menu_=>$submenu_){ 
			 $menu_space = str_replace(' ', '%20', $menu_); ?>
             <!-- begin interface theme -->
			<li <?php echo ($menu_space==admin::active($menu_space))? 'class="active"' : '';?>>
            <h3><?php echo $menu_; ?></h3>
            <div class="panel loading">
            <?php 
            foreach($submenu_ as $sub_)
             {					
            ?>
                <p><?php echo $sub_; ?></p>
                <?php }?>
            </div>
        </li> 
               <!-- interface theme end-->  
		<?php } }
		} 
		if($menu=='Plugins'){ #Add plugin left
		   if(count($plug_left_menu)!=0){
			 for($i=0; $i<count($plug_left_menu); $i++){
			 foreach($plug_left_menu[$i] as $menu_=>$submenu_){ 
			 $menu_space = str_replace(' ', '%20', $menu_); ?>
             <!-- begin interface plugin -->
			<li <?php echo ($menu_space==admin::active($menu_space))? 'class="active"' : '';?>>
            <h3><?php echo $menu_; ?></h3>
            <div class="panel loading">
            <?php 
            foreach($submenu_ as $sub_)
             {					
            ?>
                <p><?php echo $sub_; ?></p>
                <?php }?>
            </div>
        </li> 
               <!-- interface plugin end-->  
		<?php } } }
		}		
		$menu_space = str_replace(' ', '%20', $menu);
    ?>
        <li <?php echo ($menu_space==admin::active($menu_space))? 'class="active"' : '';?>>
            <h3><?php echo $menu; ?></h3>
            <div class="panel loading">
            <?php 
            foreach($submenu as $sub)
             {					
            ?>
                <p><?php echo $sub; ?></p>
                <?php }?>
            </div>
        </li>
   <?php } ?>
    </ul>
