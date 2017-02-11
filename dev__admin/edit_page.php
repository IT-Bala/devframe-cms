<div id="container">
<div class="title-box">
<h2><b><?php echo (isset($_REQUEST['p_id']))?'Edit Post':'Edit page'; ?></b></h2>
</div>
<?php 
echo (isset($_REQUEST['update_page']))? admin::update_page($_REQUEST,$_REQUEST['page_id']) : '';
echo (isset($_REQUEST['update_post']))? admin::update_post($_REQUEST,$_REQUEST['p_id']) : '';
if(isset($_REQUEST['page_id'])){
$nm = 'update_page';	
$val = 'Update Page';
$que = admin::edit_page($_REQUEST['page_id']); $edit = fetch($que);
$title = $edit->page_title;
$link = $edit->friendly_url;
$tpl = $edit->tpl;
$content = $edit->page_content;
}elseif(isset($_REQUEST['p_id'])){
$nm = 'update_post';	
$val = 'Update Post';
$que = admin::edit_post($_REQUEST['p_id']); $edit = fetch($que);
$title = $edit->post_title;
$link = $edit->friendly_url;
$tpl = $edit->tpl;
$content = $edit->post_content;
}
?>
<br />
        <form method="post">
        <strong>Page name:</strong>
        <input type="text" name="addpage" id="addpage" class="textbox" value="<?php echo $title; ?>" />
        <br /><br />
        <div id="dev__link"><strong>Page Link : </strong>
        <a href="../<?php echo $link;?>" target="_blank">View Page</a>
       </div><br />
        <strong>Templates: </strong>
        
        <select name="tpl" id="tpl" onchange="return gettpl();" style="width:410px;" class="textbox">
        <option value="">Choose Template</option>
        <?php foreach(gettpl() as $tpl_file){ $file=basename($tpl_file) ?>
		<option value="<?php echo $file;?>" <?php if($tpl==$file){?>selected="selected"<?php }?>><?php echo $file;?></option>
		<?php } ?>
        </select>
        <br />
        <div id="pc">
        <strong>Page Contents :</strong>
        <textarea cols="30" id="editor1" name="editor1" rows="10">
        <?php echo $content; ?>
        </textarea>
        <script>
            CKEDITOR.replace( 'editor1', {
                fullPage: true,
                allowedContent: true,
                extraPlugins: 'wysiwygarea'
            });
        </script>
        </div>
        <span style="float:right; margin:5px 108px 0 0;"><input type="submit" name="<?php echo $nm;?>" class="Button" value="<?php echo $val;?>" /></span>
        </form>
        </div>
    
    
    
        