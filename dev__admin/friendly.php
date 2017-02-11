<div id="container">
<div class="title-box">
<h2><b>SEO Friendly Url</b></h2>
</div>
<?php echo (isset($_REQUEST['Update_url']))? admin::update_friendly_url($_REQUEST) : '';?>
<br />
        <form method="post">
        <strong>Friendly Url :</strong>
        <select name="seo_url">
        <option value="">Choose Options</option>
        <option value="dot_php">.php [sample.php]</option>
        <option value="dot_html">.html [sample.html]</option>
        <option value="dot_null">Without Extension [sample]</option>
        </select>               
        <span style="float:right; margin:-2px 230px 0 0;"><input type="submit" name="Update_url" class="Button" value="Change" /></span>
        </form>
        </div>

    
    
    
        