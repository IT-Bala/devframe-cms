<div id="container">
<div class="title-box">
<h2><b>Menu List</b></h2>
</div>
<br />
<div id="ajax_view"> </div>
<?php
if($_REQUEST['plug_a']!='') : admin::menu_activate($_REQUEST['plug_a']); endif;
if($_REQUEST['plug_d'] !='') : admin::menu_deactivate($_REQUEST['plug_d']); endif;
if(isset($_REQUEST['Set'])):admin::set_submenu($_REQUEST['plug_d']); endif;
?>
<form method="post" name="pluginform">
<input type="hidden" name="plug_a" id="plug_a" />
<input type="hidden" name="plug_d" id="plug_d" />
<table class="dash_count_table" cellspacing="0">
<tr class="tr_th">
<th width="10">ID</th>
<th width="120">Menus</th>
<th width="150">Action</th>
<th width="185">Menu link</th>
<th width="185">Sub menu</th>
<th width="185">Status</th>
<th width="150">Created date</th>
</tr>
<?php 
$query = admin::all_menu();
$count = mysql_num_rows($query);
if($count > 0):
while($menu = fetch($query)) {
?>
<tr>
<td><?php echo $menu->menu_id; ?></td>
<td><?php echo $menu->menu; ?></td>
<?php $option = ($menu->status==1) ? '<a href="javascript:de_activate('."'$menu->menu_id'".')">De-activate</a>' : '<a href="Javascript:activate('."'$menu->menu_id'".');">Activate</a>'; ?>

<td><?php echo $option; ?>&nbsp;<a href="Javascript:Goto('?Menus&menu_id=<?php echo $menu->menu_id;?>&Admin_page=Editmenu');">Edit</a>&nbsp;<a onclick="return dev_delete('delete_load.php','ajax_view','<?php echo $menu->menu_id;?>','menu');" class="oncl" >Delete</a></td>
<td><a href="../<?php echo $menu->menu_link;?>" target="_blank"><?php echo $menu->menu_link; ?></a></td>
<td><form method="post"><input type="text" size="1" name="submenu" value="<?php echo $menu->submenu_id;; ?>" /><input type="hidden" value="<?php echo $menu->menu_id;?>" name="menu" /><input type="submit" size="1" name="Set" value="set" /></form></td>
<td><?php echo ($menu->status==1) ? '<span style="color:darkgreen;">Active</span>' : '<span style="color:red;">Inactive</span>'; ?></td>
<td><?php echo $menu->menu_date; ?></td>
<?php } else: ?>
<tr>
<td colspan="7" align="center"><span class="error">No Records !</span></td>
<?php endif; ?>
</tr>
</tr>
</table>
</form>
    
    
    
        