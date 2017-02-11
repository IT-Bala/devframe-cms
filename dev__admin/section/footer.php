</div>
<div style="clear:both;"> </div>
</div>
<div id="footer">

</div>
<!--<script type="text/javascript" src="js/jquery-1.4.2.min.js" charset="utf-8"></script>-->
        <script type="text/javascript" src="js/jquery.accordion.2.0.js" charset="utf-8"></script>
        <script type="text/javascript">
            $('#example1, #example3').accordion();
            $('#example2').accordion({
                canToggle: true
            });
            $('#example4').accordion({
                canToggle: true,
                canOpenMultiple: true
            });
            $(".loading").removeClass("loading");
        </script>
    </body>
</html>