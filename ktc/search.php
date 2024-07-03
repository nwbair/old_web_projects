<?php
include_once 'common/base.php';
$pageTitle = "Search Results";
include_once 'common/header.php';


if(!empty($_GET['s'])):
	
	$searchTerm = $_GET['s'];
	
	if (is_numeric($_GET['s'])){
		$searchType = "Account #";
		// gid = Group ID. We are getting the GROUP NUMBER here
		$gid = $db->prepare('SELECT group_number from accounts
							 WHERE account_number = :term AND group_number !=0');
		$gid->bindValue(':term', $searchTerm);
		$gid->execute();
		$gid->setFetchMode(PDO::FETCH_ASSOC);
		
		$gid_results = $gid->fetch();
		
	} elseif (is_string($_GET['s'])) {
		$searchType = "Firm Name";
		// gid = Group ID. We are getting the GROUP NUMBER here
		$gid = $db2->prepare("SELECT GroupID from current_profile 
							  WHERE FirmName Like :term AND GroupID !=0 LIMIT 1");
		$gid->bindValue(':term','%' . $searchTerm . '%');
		$gid->execute();
		$gid->setFetchMode(PDO::FETCH_ASSOC);
		
		$gid_results = $gid->fetch();
		$gid_results['group_number'] = ltrim($gid_results['GroupID'], '0');

	}
	
	// aan = Associated Account Numbers. Getting all of the accounts
	// with the same group Number.
	$aan = $db->prepare('SELECT account_number FROM accounts
				  WHERE group_number = :group');
	$aan->bindValue(':group', $gid_results['group_number']);
	$aan->execute();
	$aan->setFetchMode(PDO::FETCH_ASSOC);
	
	while ($aan_results = $aan->fetch()) {
		$account_group[] = $aan_results;
	}
	
	$STH3 = $db->prepare('SELECT * from ktcs WHERE account_number = :term');
	$STH3->bindValue(':term', $searchTerm);
	$STH3->execute();
	$STH3->setFetchMode(PDO::FETCH_ASSOC);
	
	while ($row3 = $STH3->fetch()) {
		$ktcs[] = $row3;
	}
	 
	$STH2 = $db2->prepare('SELECT * from current_profile WHERE CustID = :term LIMIT 1');
	$STH2->bindValue(':term', $searchTerm);
	$STH2->execute();
	$STH2->setFetchMode(PDO::FETCH_ASSOC);
	 
	$row = $STH2->fetch();
	
	$STH4 = $db->prepare('SELECT status, category from accounts WHERE account_number = :term LIMIT 1');
	$STH4->bindValue(':term', $searchTerm);
	$STH4->execute();
	$STH4->setFetchMode(PDO::FETCH_ASSOC);
	
	$status = $STH4->fetch();
?>
<div id="content">
	
<?php if($searchType == "Account #"): ?>	
	<div id="accountStats">
		<div class="data">
			<div class="accountInfo">
				<h1><?php echo $row['FirmName']; ?></h1>
				<h3><?php echo $row['ShipCity'] . ", " . $row['ShipState']; ?></h3>
				<h4>Firm Phone #: <?php echo $row['FirmPhone']; ?></h4>
				<h2>Account #: <?php echo $row['CustID']; ?></h2>
			</div>
			<div class="firmStatus">
				<?php if ($status['status'] == 'enabled'): ?>
					<button class="btn btn-large btn-success" type="button">Active <?php echo $status['category']; ?></button>
				<?php else: ?>
					<button class="btn btn-large btn-danger" type="button">Inactive</button>
				<?php endif; ?>
			</div>
			<div class="sep">
				<div class="left">
					<a href="https://support.cch.com/star/ticket_list_customer_history.aspx?customer_number=<?php echo $row['CustID']; ?>" target="_blank">History</a>
				</div>
				<div class="right">
					<a href="https://support.cch.com/inventory/protected/CustomerProfile.aspx?acct=<?php echo $row['CustID']; ?>" target="_blank">Profile</a>
				</div>
			</div>
		</div> <!-- End Data -->
	</div> <!-- End accountStats -->
	
	<div id="changes">
		<div class="data">
			<h3>Suggest an Update or Change</h3>
			<br />
			<form class="form-inline" method="post" action="changes.php">
					<label>Assign a group:
					<select name="category" class="span2">
						<option value="PUG" <?php if($status['category'] == 'PUG') echo 'selected'; ?>>PUG</option>
						<option value="NATL" <?php if($status['category'] == 'NATL') echo 'selected'; ?>>NATIONAL</option>
						<option value="STRATEGIC" <?php if($status['category'] == 'STRATEGIC') echo 'selected'; ?>>STRATEGIC</option>
						<?php if ($status['status'] == 'enabled'): ?>
							<option value="disabled">Disable</option>
						<?php else: ?>
							<option value="enabled">Enable</option>
						<?php endif; ?>
					</select>
					</label>
					<input type="hidden" name="s" value="<?php echo $row['CustID']; ?>" />
					<input type="hidden" name="cat_update" value="329f72jh3is" />
					<input type="submit" value="Do it!" name="submit" class="btn" />
			</form>
		</div>
	</div>
	
	<div id="contacts">
		<div class="data">
			<h3>KTC Contact List</h3>
			<?php
				if(empty($ktcs)):
			?>
	
			<div class="text-error">
			<p>There is no KTC information associated with this account.</p>
			</div>
	
			<?php else: ?>
	
			<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Phone</th>
						<th>Email</th>
					</tr>
				</thead>
			<tbody>
				<?php							
				$i = 0;				
				while ($i < sizeof($ktcs)){
					foreach ($ktcs as $obj=>$ktc){
						echo "<tr>";
						echo "<td>" .  $ktc['ktc_name'] .  "</td>";
						echo "<td>" . $ktc['ktc_phone'] . "</td>";
						echo "<td><a href='mailto:" . $ktc['ktc_email'] . "'>" 
				 				. $ktc['ktc_email'] . "</a></td>";
						echo "</tr>";
						$i++;
					}
				}				
				?>
			</tbody>
			</table>
			<?php endif; ?>
		</div>
	</div>	<!-- End Contacts -->

<?php endif; ?>
	
	<div id="accounts">
		<div class="data">
		<h3>Associated Accounts</h3>
		<?php
			if (empty($account_group) || sizeof($account_group) == 1):
		?>
			<div class="text-error">
				<p>There are no additional accounts associated with this account.</p>
			</div>
		<?php else: ?>
		<table class="table">
			<thead>
				<tr>
					<th>Account</th>
					<th>Firm Name</th>
					<th>City, State</th>
				</tr>
			</thead>
			<tbody>
		<?php
		
		$i = 0;				
		while ($i < sizeof($account_group)){
			foreach ($account_group as $key=>$value){
				if($value['account_number'] != $row['CustID']){
					echo "<tr>";			
					echo "<td><a href='search.php?s=" . $value['account_number'] . "'>" 
						.  $value['account_number'] .  "</a></td>";
					
					$A = $db2->prepare('SELECT FirmName, ShipCity, ShipState from current_profile WHERE CustID = :acct');
					$A->bindValue(':acct', $value['account_number']);
					$A->execute();
					$A->setFetchMode(PDO::FETCH_ASSOC);
					
					$cs = $A->fetch();
					
					echo "<td>" . $cs['FirmName'] . "</td>";
					echo "<td>" .  $cs['ShipCity'] . ", " . $cs['ShipState'] .  "</td>";
					echo "</tr>";
				}
				$i++;
			}
		}	
		?>
			</tbody>
		</table>
		<?php endif; ?>
		</div>
	</div><!-- End Accounts -->
</div> <!-- End Content -->

<?php
  endif;
  
  include_once 'common/close.php';
  include_once 'common/footer.php';
?>