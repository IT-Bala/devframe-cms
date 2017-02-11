<?php
error_reporting(0);
$menu = '';
?>
<ul id="example4" class="accordion">
    <?php
    $slt = select('dev_admin_menu where status=1');
    while($ft=fetch($slt)){ $menu = $ft->menu
    ?>
        <li <?php echo ($menu==admin::active($menu))? 'class="active"' : '';?>>
            <h3><?php echo $menu; ?></h3>
            <div class="panel loading">
            <?php 
            $slt_ = select('dev_admin_submenu where menu_id='.$ft->menu_id);
			while($fte = fetch($slt_)){	 $submenu=$fte->submenu; $link=$fte->link;			
            ?>
            <p><a href="<?php echo $link; ?>" <?php if($link=='../'){?> target="_blank"<?php } ?>><?php echo $submenu; ?></a></p>
            <?php }?>
            </div>
        </li>
   <?php } ?>
    </ul>
