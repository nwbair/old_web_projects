<?php
include_once 'common/base.php';
$pageTitle = "KTC Search";
include_once 'common/header.php';
?>

<div class="myhero-unit">
	<div class="header_message">
		<h1><span>Welcome</span> to the PUG/NATL KTC Lookup Tool</h1>
		<p>Look up KTCs and other account numbers associated with your current account</p>
	</div>
	<div class="search">
		<form id="searchForm form-inline" method="get" action="search.php">
			<fieldset> 
				<input id="s" name="s" type="text" />				
				<input type="submit" value="submit" name="submit" id="submitButton" />
				
			</fieldset>
			<span class="help-block dark">Search supports account #'s and firm name searches.</span>
		</form>
	</div>

</div>


<?php
  include_once 'common/close.php';
  include_once 'common/footer.php';
?>