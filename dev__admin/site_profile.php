<div id="container">
<div class="title-box">
<h2><b>Site Profile</b></h2>
</div>
<?php echo (isset($_REQUEST['Make']))? admin::make_default_run($_REQUEST) : ""; ?>
<br />
        <form method="post">
        <div id="make_default">
        <ul>
        <?php $make = admin::make_default();
		$r = select(DB_PREFIX."pages where default_page=1");
		$get = fetch($r);
		while($view = fetch($make))
		{
		 ?>
         <li><input type="radio" name="default" <?php if($get->page_id==$view->page_id){?>checked="checked"<?php } ?> value="<?php echo $view->page_id; ?>" />&nbsp;&nbsp;<?php echo $view->page_title; ?></li>
        <?php } //make default has pending ?>
        </ul>
        </div>       
        <span style="float:left; margin:5px 0;"><input type="submit" name="Make" class="Button" value="Make Default" /></span>
        </form>
        </div>

    
    
    
        