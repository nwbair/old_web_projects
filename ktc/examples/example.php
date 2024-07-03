<?php
include_once 'common/base.php';
$pageTitle = "Search Results";
include_once 'common/header.php';

  if(!empty($_POST['search']) || !empty($_GET['s'])):
	  
	  // Set the search term based on $_POST or $_GET
  	if(isset($_POST['search'])) {
		$acctList = $_POST['search'];
		$searchTerm = $_POST['search'];
  	}
	elseif(isset($_GET['s'])) {
  	  $L = $db->prepare('SELECT assoc_key FROM sub_accounts WHERE 
  	  					   sub_account_num = :term');
	  $L->bindValue(':term', $_GET['s']);
	  $L->execute();
	  $L->setFetchMode(PDO::FETCH_ASSOC);
	  
	  $res = $L->fetch();
	  
	  $acctList = $res['assoc_key'];
	  $searchTerm = $_GET['s'];
	  
	  // If the acctList comes back empty then the account must be a primary
	  // search the primary_accounts table.
	  if(empty($acctList)) {
	  	  $L = $db->prepare('SELECT assoc_key FROM primary_accounts WHERE 
	  	  					   primary_account_num = :term');
		  $L->bindValue(':term', $_GET['s']);
		  $L->execute();
		  $L->setFetchMode(PDO::FETCH_ASSOC);
		  
		  $res = $L->fetch();
		  
		  $acctList = $res['assoc_key'];	  	
	  }
  	}
	

	  
	  /**
	   * Get the list of account numbers associated with the searched account #
	   * 
	   * @array $account_group
	   */
	  $STH = $db->prepare('SELECT * FROM primary_accounts AS pa WHERE pa.assoc_key = :term
	  						UNION
						   SELECT * FROM sub_accounts AS sa WHERE sa.assoc_key = :term');
	  //echo "<pre>";print_r($searchTerm);
	  
	  $STH->bindValue(':term', $acctList);
	  $STH->execute();
	  $STH->setFetchMode(PDO::FETCH_ASSOC);
	  
      while ($row = $STH->fetch()) {          
          $account_group[] = $row;
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
	  
  	  $STH4 = $db->prepare('SELECT status from customers WHERE account_number = :term LIMIT 1');
	  $STH4->bindValue(':term', $searchTerm);
	  $STH4->execute();
	  $STH4->setFetchMode(PDO::FETCH_ASSOC);
	  
	  $status = $STH4->fetch();
?>
<div class="container">
	<div id="searchResults">
		<div class="card">
			<div class="row">
				<div class="span7">
					
					<div class="row">
						<div class="span1 left"><h3><?php echo $row['CustID']; ?></h3></div>
						<div class="span3 center"><h3><?php echo $row['FirmName']; ?></h3></div>
						<div class="span3 right"><h3><?php echo $row['FirmPhone']; ?></h3></div>
					</div>
					<div class="row">
						<div class="span2"><?php echo $row['ShipCity'] . ", " . $row['ShipState']; ?></div>
						<div class="span3"><?php echo $row['ShipAddress'] . " " . $row["ShipAddress2"]; ?></div>
						<div class="span2 right">
							<?php if ($status['status'] == 'enabled'): ?>
								<button class="btn btn-success" type="button">Active</button>
							<?php else: ?>
								<button class="btn btn-danger" type="button">Inactive</button>
							<?php endif; ?>
						</div>
					</div>
					<div class="row">
						<div class="span7">
							<h3>KTC Contact List</h3>
							<?php
							if(empty($ktcs)):
							?>
							
							<div class="text-warning">
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
					</div>
					<div class="row">
						<div class="span7">
						<h3>Associated Accounts</h3>
						<?php
							if (sizeof($account_group) == 1):
						?>
							<div class="text-warning">
								<p>There are no additional accounts associated with this account.</p>
							</div>
						<?php else: ?>
						<table class="table">
							<thead>
								<tr>
									<th>Account</th>
									<th>City, State</th>
								</tr>
							</thead>
							<tbody>
						<?php
						
						$i = 0;				
						while ($i < sizeof($account_group)){
							foreach ($account_group as $key=>$value){
								if($value['primary_account_num'] != $row['CustID']){
									echo "<tr>";			
									echo "<td><a href='search.php?s=" . $value['primary_account_num'] . "'>" 
										.  $value['primary_account_num'] .  "</a></td>";
									
									$A = $db2->prepare('SELECT ShipCity, ShipState from current_profile WHERE CustID = :acct');
									$A->bindValue(':acct', $value['primary_account_num']);
									$A->execute();
									$A->setFetchMode(PDO::FETCH_ASSOC);
									
									$cs = $A->fetch();
									
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
  endif;
  include_once 'common/close.php';
  include_once 'common/footer.php';
?>