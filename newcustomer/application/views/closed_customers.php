
    
			<script >
			  $(function() {
			    $("table#sortTableExample").tablesorter({ sortList: [[1,0]] });
			  });
		   </script>
 
        <table class="zebra-striped" id="sortTableExample">
		<thead>
		           <tr>              
                <th>Date Created</th><th>Account</th><th>Firm Name</th><th>Ticket History</th><th>Date Assigned</th><th>Date Called</th><th>Who Called</th><th>Ticket Number</th>
				</tr>
				</thead>

            <?php foreach ($data as $item): ?>
                    <tr>
                        <td><?=$item->DateAdded?></td><td><a href="https://support.cch.com/inventory/protected/CustomerProfile.aspx?acct=<?=$item->CustID?>" target="_blank"><?=$item->CustID?></a></td>
						<td><a href="https://support.cch.com/inventory/protected/CustomerProfile.aspx?acct=<?=$item->CustID?>" target="_blank"><?=$item->FirmName?></td>
						<td><a href="http://support.cch.com/star/ticket_list_customer_history.aspx?customer_number=<?=$item->CustID?>" target="_blank">Ticket History</a></td>
						<?php if($item->DateAssigned == "0000-00-00") { ?>
							<td>&nbsp;</td>
						<?php } else { ?>						
							<td><?=$item->DateAssigned?></td>
						<?php } ?>
						<td><?=$item->DateCalled?></td>
						<td><?=$item->WhoCalled?></td>
						<?php if($item->ticketnum == "Existing Customer" || $item->ticketnum == "na") { ?>
						<td><?=$item->ticketnum?></td>
						<?php } else { ?>
						<td><a href="http://support.cch.com/star/ticket.aspx?ticket_id=<?=$item->ticketnum?>" target="_blank"><?=$item->ticketnum?></a></td>
						<?php } ?>
                    </tr>
            <?php endforeach; ?>

            
        </table>
 