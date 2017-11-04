<script>
function delete_plugin(plug){
	if(confirm("Are you sure want to delete?")){
	document.getElementById('plug_delete').value=plug;
	document.getElementById('pluginform').submit();
	}
}
</script>

<div id="container">
<div class="title-box">
<h2><b>Available Plugins</b></h2>
</div>
<br />
<?php $p_msg=''; global $p_msg; echo $p_msg; ?>
<form method="post" name="pluginform" id="pluginform">
<input type="hidden" name="PLUGIN" />
<input type="hidden" name="plug_a" id="plug_a" />
<input type="hidden" name="plug_d" id="plug_d" />
<input type="hidden" name="plug_delete" id="plug_delete" />
<table class="dash_count_table" cellspacing="0">
<tr class="tr_th">
<th width="120">Plugins</th>
<th width="150">Action</th>
<th width="185">Description</th>
<th width="150">Status</th>
<th width="150">Short Codes</th>
</tr>
<?php 
$check_files=array();
$i=0;
foreach(admin::plugin_list() as $plugin){ $i++;
        
		$p_name = basename($plugin);
		$PLUG = explode('.',$p_name);
		$tot += count($PLUG[0]);
	
	 		$sql = db()->query("select * from ".DB_PREFIX."plugins where plugin='".$p_name."' and status=1");		
	 		if($sql->num_rows==1){
			 $option = '<a href="javascript:de_activate('."'$PLUG[0]'".')">De-activate</a>';
			 $status = '<span style="color:darkgreen;">Active</span>';
			 }else{			 	
			 $option = '<a href="Javascript:activate('."'$PLUG[0]'".');">Activate</a>';		 
			 $status = '<span style="color:red;">InActive</span>';
			  }
		
		## shor code ##
		if(file_exists($plugin.'/short_code.txt')){ 
		$string =  file_get_contents($plugin.'/short_code.txt');
?>
<tr>
<td><?php echo ucfirst($PLUG[0]); ?></td>
<?php	
	$edit_plug = (in_array($PLUG[0], $read_plug))? '<a href="edit_plugin.php?Plugins&plug='.$PLUG[0].'">Edit</a>' : '';	
	$dlt = '<a href="javascript:delete_plugin('."'".$PLUG[0]."'".');">Delete</a>';
?>
<td><?php echo $option.' '.$dlt; ?></td>
<td>some contents about this plugin</td>
<td><?php 
echo $status;
?></td>
<input type="hidden" id="short_code<?php echo $i;?>" value="<?php echo (get_between($string.$i,'@@','@@')!='')?'@@'.get_between($string.$i,'@@','@@').'@@':'NOT ASSIGN SHORT CODE'; ?>" />
<td><a href="javascript:void(0)" onclick="prompt('Short Code',document.getElementById('short_code<?php echo $i;?>').value);">View</a></td>
<?php }} if($tot == 0): ?>
<tr>
<td colspan="5" align="center"><span class="error">No Records !</span></td>
<?php endif; ?>
</tr>
</table>
</form>

    
    
    
        
