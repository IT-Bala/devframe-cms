<div id="container">
<div class="title-box">
<h2><b><?php echo ($_REQUEST['type']=='post')? 'Add New Post' : 'Add New Page'; ?></b></h2>
</div>
<?php echo (isset($_REQUEST['Add_page']))? admin::add_menu($_REQUEST) : '';?>
<br />
        <form method="post">
        <label><strong>Menu name:</strong></label>
        <input type="text" name="menu" id="addpage" class="textbox" />
        <br /><br />
        <div id="dev_link"><strong>Menu Link :</strong> <input type="text" name="menu_link" class="textbox" /></div>        
        <span style="float:right; margin:5px 108px 0 0;"><input type="submit" name="Add_page" class="Button" value="Add menu" /></span>
        </form>
        </div>
    
    
    
        