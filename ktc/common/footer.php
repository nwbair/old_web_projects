	<div id="footer">
		<ul class="unstyled">
			<li><a target="_blank" href="https://bitbucket.org/nwbair/cch-pug-natl-lookup-tool/issues">Report an issue</a></li>
		</ul>
	</div>
</div> <!-- End Container from the Header.php file. -->


    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.8.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/passwordcheck.js"></script>
    
    
    <script type="text/javascript">
	$(document).on("click", ".open-updateUserModal", function() {
		var myuserId = $(this).data('id');
		$(".modal-body #userId").val(myuserId);
		var myEmail = $(this).data('email');
		$(".modal-body #inputEmail").val(myEmail);
		var myFullname = $(this).data('name');
		$(".modal-body #inputFullname").val(myFullname);
		var myLevel = $(this).data('level');
		$(".modal-body #inputUserLevel").val(myLevel);
		$('#updateUserModal').modal('show');
	});
	
	$(document).on("click",".open-changePasswordModal", function() {
		var myuserId = $(this).data('id');
		$(".modal-body #userId").val(myuserId);
		$('#changePasswordModal').modal('show');
	});
	
	$(document).on("click",".approvetab", function() {
		alert('Bam');
	});
	
	$(document).on("click",".discardtab", function() {
		
	});
</script>

  </body>
</html>