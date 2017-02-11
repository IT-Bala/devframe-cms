<div id="container">
<div class="title-box">
<h2><b>Install New Theme</b></h2>
</div>
<br />
<?php
if($_REQUEST['plug_a']!='') : admin::theme_active($_REQUEST); endif;
?>
<form method="post" enctype="multipart/form-data">
<label><strong>Plugin name:</strong></label>
<input type="text" id="fileName" readonly="readonly" name="p_name" class="textbox" > 
<input type="file" name="plugin" style="position:relative;opacity:0;" size="1"  onchange="javascript: document.getElementById ('fileName') . value = this.value"/>
<input type="button" id="button" class="Button" style="margin-left:-110px;" value="Browse Theme"/>&nbsp;&nbsp;
<input type="submit" name="add_theme" class="Button"  value="Install Now" />
</form>

<p></p>
<form method="post" name="pluginform" enctype="multipart/form-data">
<input type="hidden" name="plug_a" id="plug_a" />
<input type="hidden" name="plug_d" id="plug_d" />
<?php if(isset($_REQUEST['add_theme'])) : admin::install_theme($_REQUEST); endif;  ?>
</form>

    
    
    
        