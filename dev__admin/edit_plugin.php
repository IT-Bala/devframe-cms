<?php
// PHP dev__ FRAMEWORK
include('frame/dev__.php');
dev_header();
left_menu();
?>
<div id="container">
<div class="title-box">
<h2><b>Edit Plugin</b></h2>
</div>
<?php 
if(isset($_REQUEST['plug'])): $Edit_plug = admin::edit_plug($_REQUEST['plug']); else: header("location:all_plugin.php?Plugins"); endif; // edit plugin
if(isset($_REQUEST['Update'])): admin::update_plug($_REQUEST['plug'],$_REQUEST); endif;
?>
<br />
        <form method="post">
        <label><strong>Plugin Name:</strong></label>&nbsp;&nbsp;&nbsp;Plugin
        <br /><br />

        <label><strong>Edit Plugin :</strong></label>
        <textarea cols="80" id="editor1" name="content" rows="10">
        <?php foreach($Edit_plug as $edit): echo $edit; endforeach; ?>
        </textarea>
        <span style="float:right; margin:5px 108px 0 0;"><input type="submit" name="Update" class="Button" value="Update  Page" /></span>
        </form>
        </div>
<?php dev_footer(); ?>
    
    
    
        