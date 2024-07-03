<?php
include_once 'common/base.php';
$pageTitle = "KTC Search";
include_once 'common/header.php';

  if(!empty($_POST['search'])):
    echo "ttt<ul id='results'>n";

    include_once 'inc/class.search.inc.php';
    $searchTerm = new KTCSearch($db);
    list($AN, $PAN) = $searchTerm->searchAccount();
    print_r($AN);

    echo "ttt</ul>";

  else:
?>
<div class="myhero-unit">
	<div class="hero-content">
		<div class="row">
			<div class="span12">1</div>
		</div>
		<div class="row">
			<div class="span4">2</div>
			<div class="span4">3</div>
			<div class="span4">4</div>
		</div>
		<div class="row">
			<div class="span12">5</div>
		</div>
	</div>
</div>

	<div class="search">
		<form id="searchForm" method="get" action="search.php">
			<fieldset> 
				<input id="s" name="s" type="text" />
				<input type="submit" value="submit" name="submit" id="submitButton" />
			</fieldset>
		</form>
	</div>
<?php

  endif;
  include_once 'common/close.php';
  include_once 'common/footer.php';
?>