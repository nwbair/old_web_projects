    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    	<script src="js/jquery-1.10.1.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/dropzone.js"></script>
		<script src="js/jquery.jeditable.js"></script>
		<script type="text/javascript">
		$(function() {
		  $(".edit_click").editable("live_edit.php", { 
			  indicator : "<img src='img/indicator.gif'>",
			  tooltip   : "Click to edit..."
		  });
		});
	</script>
  </body>
</html>