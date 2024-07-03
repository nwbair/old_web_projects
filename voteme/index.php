<?php include_once "common/header.php"; ?>

<div id="main">

	<noscript>This site just doesn't work without Javascript, period.</noscript>

	<!-- IF LOGGED IN -->
		<ul id="list">
			<li class="colorGreen">
				<span>Code Nugget</span>
				<div class="voteuptab tab"></div>
				<div class="votedowntab tab"></div>
				<div class="deletetab tab"></div>
				<div class="donetab tab"></div>
			</li>

			<li class="colorGreen">
				<span>Code Fish</span>
				<div class="voteuptab tab"></div>
				<div class="votedowntab tab"></div>
				<div class="deletetab tab"></div>
				<div class="donetab tab"></div>
			</li>

			<li class="colorYellow">
				<span>Code Bee</span>
				<div class="voteuptab tab"></div>
				<div class="votedowntab tab"></div>
				<div class="deletetab tab"></div>
				<div class="donetab tab"></div>
			</li>

			<li class="colorRed">
				<span>Code Cube</span>
				<div class="voteuptab tab"></div>
				<div class="votedowntab tab"></div>
				<div class="deletetab tab"></div>
				<div class="donetab tab"></div>
			</li>
		</ul>

		<form action="" id="add-new">

			<div>
				<input type="text" id="new-list-item-text" name="new-list-item-text" />
				<input type="submit" id="add-new-submit" value="Add" class="button" />
			</div>

		</form>

		<div id="share-area">
			<p>Public list URL: <a href="#">URL GOES HERE</a>
			<small>(Nobody but YOU will be able to edit this list)</small></p>
		</div>

	<!-- IF LOGGED OUT -->

		<ul id="list">
			<li class="colorGreen">
				<span>Code Nugget</span>
			</li>

			<li class="colorGreen">
				<span>Code Fish</span>
			</li>

			<li class="colorYellow">
				<span>Code Bee</span>
			</li>

			<li class="colorRed">
				<span>Code Cube</span>
			</li>
		</ul>

</div>

<?php include_once "common/sidebar.php"; ?>

<?php include_once "common/footer.php"; ?>