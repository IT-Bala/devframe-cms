<div id="container">
<div class="title-box">
<h2><b>Edit Menus</b></h2>
</div>
<?php echo (isset($_REQUEST['Update']))? admin::update_menu($_REQUEST,$_REQUEST['menu_id']) : '';
if(isset($_REQUEST['menu_id']))
{
 $que = admin::edit_menu($_REQUEST['menu_id']);
 $edit = fetch($que);
}
else
{
	header("location:all_menu.php?Menus");
}
?>
<br />
        <form method="post">
        <label><strong>Menu name:</strong></label>
        <input type="text" name="menu" id="addpage" class="textbox" value="<?php echo $edit->menu; ?>" />
        <br /><br />
        <div id="dev__link"><strong>Menu Link :</strong> <input type="text" class="textbox" name="menu_link" value="<?php echo $edit->menu_link; ?>" /></div>
        <br />
        <span style="float:right; margin:5px 108px 0 0;"><input type="submit" name="Update" class="Button" value="Update  menu" /></span>
        </form>
        </div>
    
    
    
        