<div class="row">				
				<div id="card_header">
					<div class="span4">
						<div class="card-header-account">
							<h1><?php echo $row['CustID']; ?></h1>
						</div>
					</div>
					<div class="span4">
						<div class="card-header-firmname">
							<h1><?php echo $row['FirmName']; ?></h1>
						</div>
					</div>
					<div class="span4">
						<div class="card-header-firmphone">
							<h1><?php echo $row['FirmPhone']; ?></h1>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span4">
					<div class="card-city">
						<?php echo $row['ShipCity'] . ", " . $row['ShipState']; ?>
					</div>
				</div>
				<div class="span4">
					<div class="card-street">
						<?php echo $row['ShipAddress'] . " " . $row["ShipAddress2"]; ?>
					</div>
				</div>
				<div class="span4">
					<button class="btn btn-success" type="button">Active</button>
				</div>
			</div>
			<div class="row">
				<div class="span9">
					<div class="card-ktc-list">
						<h1>KTC Contact List</h1>
						<table class="table table-condensed">
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
										echo "<td>" . $ktc['ktc_email'] . "</td>";
										echo "</tr>";
										$i++;
									}
								}				
						?>
							</tbody>
						</table>
	
					</div>
				</div>
				<div class="span3">
					<div class="card-more-accounts">
						<h2>Sub Acct #</h2>
						<table class="table table-condensed">
						<?php
						foreach ($account_group as $obj_key=>$account)
						{					
							foreach($account as $key=>$value) {
								echo "<tr>";
								if($key == "account_number")	
									echo "<td>$value</td>";	
								
								echo "</tr>";	
							}
						}
						?>
						</table>
					</div>
				</div>
			</div>