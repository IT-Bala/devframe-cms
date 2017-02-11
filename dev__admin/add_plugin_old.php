<div id="container">
<div class="title-box">
<h2><b>Add New Plugin</b></h2>
</div>
<br />
<?php
if($_REQUEST['plug_a']!='') : admin::plug_activate($_REQUEST); endif;
if($_REQUEST['plug_d'] !='') : admin::plug_deactivate($_REQUEST); endif;
?>

<form method="post" enctype="multipart/form-data">
<label><strong>Plugin name:</strong></label>
<input type="text" id="fileName" readonly="readonly" name="p_name" class="textbox" > 
<input type="file" name="plugin" style="position:relative;opacity:0;" size="1"  onchange="javascript: document.getElementById ('fileName') . value = this.value"/>
<input type="button" id="button" class="Button" style="margin-left:-110px;" value="Browse Plugin"/>&nbsp;&nbsp;
<input type="submit" name="add_plugin" class="Button"  value="Install Now" />
</form>

<p></p>
<form method="post" name="pluginform">
<input type="hidden" name="plug_a" id="plug_a" />
<input type="hidden" name="plug_d" id="plug_d" />
<?php if(isset($_REQUEST['add_plugin'])) : admin::install_plugin($_REQUEST); endif;  ?>
</form>

    
    
    
        