
	<script src="ckeditor.js"></script>
	<script src="samples/sample.js"></script>
	<link rel="stylesheet" href="samples/sample.css">
	
    <textarea cols="20" id="editor1" name="editor1" rows="10">
    </textarea>
    <script>
        CKEDITOR.replace( 'editor1', {
            fullPage: true,
            allowedContent: true,
            extraPlugins: 'wysiwygarea'
        });
    </script>