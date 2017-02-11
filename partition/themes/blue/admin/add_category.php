<div id="container">
<div class="title-box">
<h2><b><?php echo ($_REQUEST['type']=='post')? 'Add New Post' : 'Add New Page'; ?></b></h2>
</div>
<?php 
$nm = 'Add_page';
$val = 'Create Page';
$page_load = 'page_load.php';
if(isset($_REQUEST['type'])){
	if($_REQUEST['type']=='post'){
		$page_load = 'post_load.php';
		$nm = 'Add_post';
		$val = 'Create Post';		
	}
}
echo (isset($_REQUEST['Add_page']))? admin::add_page($_REQUEST) : ''; 
echo (isset($_REQUEST['Add_post']))? admin::add_post($_REQUEST) : ''; 
?>
<br />
        <form method="post">
        <strong>Page name:&nbsp;</strong>
        <input type="text" name="addpage" id="addpage" class="textbox" />
        <br /><br />
        <strong>Page Url:&nbsp;&nbsp;&nbsp;</strong>
        <input type="text" name="friendly_url" id="friendly_url" class="textbox" />
        <br /><br />
        <strong>Templates:&nbsp;</strong>
      
        <select name="tpl" id="tpl" onchange="return gettpl();" style="width:410px;" class="textbox">
        <option value="">Choose Template</option>
        <?php foreach(gettpl() as $tpl){ $file=basename($tpl) ?>
		<option value="<?php echo $file;?>"><?php echo $file;?></option>
		<?php } ?>
        </select>
        <br />
        <div id="pc">
        <strong>Page Contents :</strong>
        <textarea cols="30" id="editor1" name="editor1" rows="10"></textarea>
        <script>
            CKEDITOR.replace( 'editor1', {
                fullPage: true,
                allowedContent: true,
                extraPlugins: 'wysiwygarea'
            });
        </script>
        </div>
        <span style="float:right; margin:5px 185px 0 0;"><input type="submit" name="<?php echo $nm;?>" class="Button" value="<?php echo $val;?>" /></span>
        </form>
        </div>

    
    
    
        