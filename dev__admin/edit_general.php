<div id="container">
<div class="title-box">
<h2><b>Edit File</b></h2>
</div>
<?php 
if(isset($_REQUEST['file'])): $Edit_plug = admin::edit_file($_REQUEST['file']); else: header("location:all_plugin.php?Plugins"); endif; // edit plugin  
global $general_msg; echo $general_msg;
?>
<br />
        <form method="post">
        <label><strong>File Name:</strong></label>&nbsp;&nbsp;<?php echo ucfirst($_REQUEST['file']).' section'; ?>
        <br /><br />

        <label><strong>Edit File :</strong></label>
        <textarea cols="80" id="editor1" name="content" rows="10"><?php foreach($Edit_plug as $edit): echo $edit; endforeach; ?></textarea>
        <span style="float:right; margin:5px 108px 0 0;"><input type="submit" name="Update_general_file" class="Button" value="Update  Page" /></span>
        </form>
        </div>

    
    
    
        