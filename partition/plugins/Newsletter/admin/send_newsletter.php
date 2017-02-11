<?php 
require('function.php');tables();
$tit='Send A Newsletter'; $name='Send_News'; $val='Send Newsletter';
 ?>
<link href="<?php echo current_theme_url_news();?>style.css" rel="stylesheet" />
<style>.lbg{width:210px;background:#DDD; margin:3px 0;padding:0px;}label{ padding:5px 5px 0 5px; float:none !important; margin:0px !important; }.multiple{height:100px; width:230px; padding:5px; overflow-y:scroll; border:1px #EEE solid;}</style>
<div id="container">
<div class="title-box">
<h2><b><?php echo $tit; ?></b></h2>
</div>
<?php 
echo (isset($_REQUEST['Send_News']))?send_news($_REQUEST) : '';
$emails = Get_All_User_Email();
?>
<br />
<form method="post" enctype="multipart/form-data">
       <fieldset>
       <ul style="float:left;">     
       <p><li>Email:*</li></p>
       <p style="margin:105px 0 0 0;"><li>Subject:*</li></p>
       <p><li>Message:*</li></p>
       </ul>
       <ul>
       <p><li><div class="multiple">       
       <?php $i=0;
	   foreach($emails as $email){ $i++; echo '<div class="lbg"><label for="c_'.$i.'"><input type="checkbox" id="c_'.$i.'" name="news_email[]" /> &nbsp;&nbsp;'.$email.'</label></div>';
	   }
	   ?>
       </div></li></p>
       <p><li><input type="text" name="news_subject" value="<?php echo(!empty($_REQUEST['news_subject']))?$_REQUEST['news_subject']:'';?>" /></li></p><br /><br />
       <p><li><textarea cols="30" id="editor1" name="news_msg" rows="10"></textarea>
        <script>
            CKEDITOR.replace( 'editor1', {
                fullPage: true,
                allowedContent: true,
                extraPlugins: 'wysiwygarea'
            });
        </script> </li></p>
       <p><li><input type="submit" name="<?php echo $name; ?>" class="Button" value="<?php echo $val; ?>" /></li></p>
       </ul>
       </fieldset> 
       </form>       
        </div>