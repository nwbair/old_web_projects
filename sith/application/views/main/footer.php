<h4><span>Copyright &copy; 2011, AlmostLabs, LLC. All rights reserved.</span></h4>

<ul class="social">
	<li><a href="http://www.facebook.com/pages/AlmostLabs/193338420728083" class="twitter" target="new">Like AlmostLabs on Facebook</a></li>
	<li><a href="http://twitter.com/#!/AlmostLabs" target="new">Follow AlmostLabs on Twitter</a></li>
</ul>

<?php if(isset($_SESSION['userlevel']) && ($_SESSION['userlevel'] == 777)): ?>
	   <?php echo anchor("admin/dashboard", "Admin Dashboard"); ?>
<?php endif; ?>