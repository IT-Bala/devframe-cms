<div id="container">
<div class="title-box">
<h2><b>All Category</b></h2>
</div>
<div class="dash_count">
<table width="350" class="dash_count_table" cellspacing="0">
<tr class="tr_th">
<th>Content</th>
<th>Count</th>
</tr>
<?php foreach(admin::admin_counts() as $name=>$count) {?>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $count; ?></td>
<?php } ?>
</tr>
</table>
</div>
</div>    