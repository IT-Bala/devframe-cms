<div id="container">
<div class="title-box">
<h2><b>General File</b></h2>
</div>
<br />
<form method="post" name="pluginform">
<table class="dash_count_table" cellspacing="0">
<tr class="tr_th">
<th width="160">File name</th>
<th width="150">Action</th>
<th width="225">Description</th>
<th width="150">Status</th>
</tr>
<?php 
$tot = count(admin::general_file());
foreach(admin::general_file() as $plugin)
		{
			$base =  basename($plugin);	
			$file = explode('.php',$base);
			$common =  $file[0];
?>
<tr>
<td><?php echo ucfirst($common); ?></td> 
<?php
	$edit_plug = '<a href="?Settings&Admin_page=Editgeneral&file='.$common.'">Edit</a>';
	$active = '<span style="color:darkgreen;">Active</span>';	
?>
<td><?php echo $edit_plug; ?></td>
<td><?php echo "This is $common section"; ?></td>
<td><?php echo $active;?></td>
<?php } if($tot == 0): ?>
<tr>
<td colspan="5" align="center"><span class="error">No Records !</span></td>
<?php endif; ?>
</tr>
</table>
</form>

    
    
    
        