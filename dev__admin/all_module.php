<?php 
$msg='';
if(isset($_SESSION['theme_msg_time'])){ if($_SESSION['theme_msg_time']<time()){unset($_SESSION['theme_msg']);}} 
$msg = admin::theme_delete();
?>
<script>
function delete_theme(theme){
	if(confirm("Are you sure want to delete?")){
	document.getElementById('theme_delete').value=theme;
	document.getElementById('themeform').submit();
	}
}
</script>
<div id="container">
<div class="title-box">
<h2><b>Site Module</b></h2>
</div>
<br />
<?php echo(!empty($_SESSION['theme_msg']))?$_SESSION['theme_msg']:''.$msg; ?>
<form method="post" name="pluginform" id="themeform">
<input type="hidden" name="THEME" />
<input type="hidden" name="plug_a" id="plug_a" />
<input type="hidden" name="plug_d" id="plug_d" />
<input type="hidden" name="theme_delete" id="theme_delete" value="" />
<table class="dash_count_table" cellspacing="0">
<tr class="tr_th">
<th width="120">Themes</th>
<th width="150">Action</th>
<th width="185">Preview</th>
<th width="150">Status</th>
</tr>
<?php 
$themes = count(admin::themes());
foreach(admin::themes() as $theme){	
 if(file_exists($theme.'/index.php')){
	 $theme_name = basename($theme);
?>
<tr>
<td><?php echo ucfirst($theme_name); ?></td>
<?php
	$option = (admin::active_theme($theme_name)==1) ? '<a href="javascript:de_activate('."'$theme_name'".')">De-activate</a>' : '<a href="Javascript:activate('."'$theme_name'".');">Activate</a>';
	
	$edit_theme = (in_array($PLUG[0], $read_plug))? '<a href="edit_plugin.php?Plugins&plug='.$PLUG[0].'">Edit</a>' : '';	
	
	$delete_theme = '<a href="javascript:delete_theme('."'$theme_name'".');">Delete</a>';

?>
<td><?php echo $option.'&nbsp;'.$edit_plug.'&nbsp;'.$delete_theme; ?></td>
<td>click here</td>
<td><?php 
echo (admin::active_theme($theme_name)==1) ? '<span style="color:darkgreen;">Active</span>' : '<span style="color:red;">Inactive</span>';
?></td>
<?php } } if($themes == 0): ?>
<tr>
<td colspan="5" align="center"><span class="error">No Records !</span></td>
<?php endif; ?>
</tr>
</table>
</form>

    
    
    
        