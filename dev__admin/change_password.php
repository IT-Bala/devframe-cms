<div id="container">
<div class="title-box">
<h2><b>Change Password</b></h2>
</div>
<?php echo (isset($_REQUEST['Update']))? admin::update_login($_REQUEST) : ''; $view = admin::login();?>
<br />
        <form method="post">
        <label><strong>Username :</strong></label>
        <input type="text" name="uname" id="addpage" value="<?php echo $view->username; ?>" class="textbox" />
        <br /><br />
        <div id="dev_link"><strong>Password :&nbsp;</strong> <input type="text" name="psword" class="textbox" value="<?php echo $view->password; ?>" /></div>        
        <span style="float:right; margin:5px 230px 0 0;"><input type="submit" name="Update" class="Button" value="Update " /></span>
        </form>
        </div>

    
    
    
        