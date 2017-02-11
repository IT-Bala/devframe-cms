<div id="container">
<div class="title-box">
<h2><b>Available Plugins</b></h2>
</div>
<br />
<?php
if(isset($_REQUEST['PLUGIN'])&&$_REQUEST['plug_a']!='') : admin::plug_activate($_REQUEST); endif;
if(isset($_REQUEST['PLUGIN'])&&$_REQUEST['plug_d'] !='') : admin::plug_deactivate($_REQUEST); endif;
?>
<form method="post" name="pluginform">
<input type="hidden" name="PLUGIN" />
<input type="hidden" name="plug_a" id="plug_a" />
<input type="hidden" name="plug_d" id="plug_d" />
<table class="dash_count_table" cellspacing="0">
<tr class="tr_th">
<th width="120">Plugins</th>
<th width="150">Action</th>
<th width="185">Description</th>
<th width="150">Status</th>
<th width="150">Short Codes</th>
</tr>
<?php 
$pl = glob("../plugins/*",GLOB_ONLYDIR);
foreach($pl as $PL)
{
	$read_plug[] = basename($PL);
}
foreach(admin::plugin_list() as $plugin)
		{
		$p_name = basename($plugin);
		$PLUG = explode('.',$p_name);
		$tot += count($PLUG[0]);		
?>
<tr>
<td><?php echo ucfirst($PLUG[0]); ?></td>
<?php

	$option = (in_array($PLUG[0], $read_plug)) ? '<a href="javascript:de_activate('."'$PLUG[0]'".')">De-activate</a>' : '<a href="Javascript:activate('."'$PLUG[0]'".');">Activate</a>';
	
	$edit_plug = (in_array($PLUG[0], $read_plug))? '<a href="edit_plugin.php?Plugins&plug='.$PLUG[0].'">Edit</a>' : '';	

?>
<td><?php echo $option.'&nbsp;'.$edit_plug; ?></td>
<td>some contents about this plugin</td>
<td><?php 
echo (in_array($PLUG[0], $read_plug)) ? '<span style="color:darkgreen;">Active</span>' : '<span style="color:red;">Inactive</span>';

?></td>
<td>@@<?php echo encode($PLUG[0]); ?>@@</td>
<?php } if($tot == 0): ?>
<tr>
<td colspan="5" align="center"><span class="error">No Records !</span></td>
<?php endif; ?>
</tr>
</table>
</form>

    
    
    
        