<?php require('function.php');tables(); ?>
<script>
function delete_newsletter(id){
	if(confirm('Are you want to delete?')){
		document.getElementById('news_id').value=id;
		document.getElementById('news_dlt').click();
	}else{
		return false;
	}
}
</script>
<div id="container">
<div class="title-box">
<h2><b>All Newsletter</b></h2>
</div>
<?php echo (isset($_REQUEST['news_id']) && $_REQUEST['news_id']!='')?delete_newsletter(): ''; ?>
<br />
<form method="post"><input type="hidden" id="news_id" /><input type="submit" id="news_dlt" style="display:none;" /></form>
<form method="post" name="pluginform" enctype="multipart/form-data">
<input type="hidden" name="plug_a" id="plug_a" />
<input type="hidden" name="plug_d" id="plug_d" />
<table class="dash_count_table" cellspacing="0">
<tr class="tr_th">
<th width="280">Email</th>
<th width="250">Message</th>
<th width="250">Action</th>
<th width="150">Created date</th>
</tr>
<?php 
$res = sub_pagination(DB_PREFIX."newsletter order by news_id desc",10,"Newsletter_Admin=all_newsletter&Newsletter");
$count = num(DB_PREFIX."newsletter");
if($count > 0):
while($page = fetch($res[0])) {
?>
<tr>
<td><?php echo $page->news_email; ?></td>
<td><?php echo $page->news_msg; ?></td>
<td><a onClick="return delete_newsletter('<?=$page->news_id;?>');" href="javascript:void('0');" class="oncl" >Delete</a></td>
<td><?php echo $page->news_date; ?></td>
</tr>
<?php }
 else: ?>
<tr>
<td colspan="5" align="center"><span class="error">No Records !</span></td>
<?php endif; ?>
</tr>
</table>
<?php echo $res[1]; ?>
</form>
</div>