<?php
$admin = new admin;  
if(isset($_REQUEST['fb'])){$admin->update_font_family($_REQUEST);} 
if(isset($_REQUEST['fs'])){$admin->update_font_size($_REQUEST);}
echo $admin->font_family();
echo $admin->font_size();
$q= db()->query("select * from ".DB_PREFIX.'admin_design'); $fb=''; $fs='';
if($q->num_rows!=0){ $ft=$q->fetch_object(); $fb = $ft->font_family; $fs = $ft->font_size;}
 ?>
<strong>Dev__ Frame Admin Panel</strong>
<div style="float:right; display:inline;">
Choose Font: <select name="fb" id="ff" onChange="update_admin_font('ff');">
<?php foreach($admin->select_family() as $family): ?>
<option value="<?php echo $family;?>" <?php echo($family==$fb)?'selected':''?>><?php echo $family;?></option>
<?php endforeach; ?>
</select>
Px: <select name="fs" id="fs" onChange="update_admin_font('fs');">
<?php 
foreach($admin->select_size() as $size): ?>
<option value="<?php echo $size;?>" <?php echo($size==$fs)?'selected':''?>><?php echo $size;?></option>
<?php endforeach; ?>
</select>
<div class="clr"> </div>
</div>
