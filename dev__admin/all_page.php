<script src="js/page-popup.js"></script>
<script>
  $(document).ready(function() {
	  $("a[rel]").overlay();
    });
</script>
<?php
$type='';$new='';$old='';$get_id='';$msg='';
if(isset($_REQUEST['Frindly_Url'])){$id = $_REQUEST['h_id'];
	if(isset($_REQUEST['new_url'.$id])){
		$old = $_REQUEST['old_link'];$new = $_REQUEST['new_url'.$id];$type = $_REQUEST['type'];
		$get_id  = $_REQUEST['id'];
		$msg=admin::update_friendly_url($old,$new,$type,$get_id);
	}
}
?>
<div id="container">
<div class="title-box">
<h2><b><?php echo ($_REQUEST['type']=='post')? 'All Posts' : 'All Pages'; ?></b></h2>
</div>
<div id="ajax_view"> </div><?php echo $msg;?>
<form method="post" name="pluginform">
<input type="hidden" name="plug_a" id="plug_a" />
<input type="hidden" name="plug_d" id="plug_d" />
<table class="dash_count_table" cellspacing="0">
<tr class="tr_th">
<th width="120"><?php echo ($_REQUEST['type']=='post')?'Posts':'Pages'; ?></th>
<th width="150">Action</th>
<th width="185">View <?php echo ($_REQUEST['type']=='post')?'Post':'Page'; ?></th>
<th width="150">Dynamic link</th>
<th width="150">Change Url</th>
<th width="150">Created date</th>
</tr>
<?php 
if(isset($_REQUEST['type'])){
	if($_REQUEST['type']=='post'){
	$res = pagination(DB_PREFIX."posts",10);
	$count = num(DB_PREFIX."posts");
	$in='Posts'; $idname='p_id';
	$pageCall = 'Editpost'; 	
	}else{
	$res = pagination(DB_PREFIX."pages",10);
	$count = num(DB_PREFIX."pages");
	$in='Pages'; $idname='page_id';
	$pageCall = 'Editpage';
	}
	}
if($count > 0): $i=0;
while($page = fetch($res[0])) {$i++;
?>
<tr>
<td><?php echo ($_REQUEST['type']=='post')?limit($page->post_title,10):limit($page->page_title,10); ?></td>

<td><a href="Javascript:Goto('?<?php echo $in;?>&Admin_page=<?php echo $pageCall;?>&<?php echo $idname;?>=<?php echo ($_REQUEST['type']=='post')?$page->post_id:$page->page_id;?>');">Edit</a>&nbsp;<a onclick="return dev_delete('delete_load.php','ajax_view','<?php echo ($_REQUEST['type']=='post')?$page->post_id:$page->page_id;?>','<?php echo $in;?>');" class="oncl" >Delete</a></td>

<td><a href="<?php if($page->friendly_url!=''){echo '../'.$page->friendly_url;}else{
if($_REQUEST['type']=='post'){ echo '../page.php?p_id='.$page->post_id;}else{echo'../page.php?page_id='.$page->page_id;}}
?>" target="_blank">Click here</a></td>

<td><input type="text" readonly="readonly" id="dynamic<?php echo $i;?>" size="10" onclick="document.getElementById('dynamic<?php echo $i;?>').select();" value="<?php echo ($_REQUEST['type']=='post')?"<?php url('".encode($page->post_id)."','post');?>":"<?php url('".encode($page->page_id)."','page');?>"; ?>"></td>

<td><a href="#" onclick="document.getElementById('f_id<?php echo $i;?>').value='<?php echo $page->friendly_url;?>'" rel="#mis<?php echo $i;?>">Link</a></td>
<div class="simple_overlay" id="mis<?php echo $i;?>">
<div id="popup-header"><h2>Friendly Url</h2></div>
<div class="s_pop">
<form method="post">
<label style="float:none;">Change Url: <input type="text" id="f_id<?php echo $i;?>" name="new_url<?php echo $i;?>" class="textbox" value="" /></label>&nbsp;&nbsp;
<input type="hidden" name="h_id" value="<?php echo $i;?>" />
<input type="hidden" name="id" value="<?php echo($_REQUEST['type']=='post')?$page->post_id:$page->page_id;?>"/>
<input type="hidden" name="old_link" value="<?php echo ($_REQUEST['type']=='post')?'page.php?p_id='.$page->post_id:'page.php?page_id='.$page->page_id;?>" />
<input type="submit" value="Change" name="Frindly_Url" class="Button" /><br />
[Example : test]
</form>
</div>
</div>
<td><?php echo ($_REQUEST['type']=='post')?$page->post_date:$page->page_date; ?></td>
<?php }
 else: ?>
<tr>
<td colspan="8" align="center"><span class="error">No Records !</span></td>
<?php endif; ?>
</tr>
</table>
<?php echo $res[1]; ?>
</form>
<?php



    
    
        