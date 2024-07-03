        
    <h1>New Customers Report</h1>

        <table id="hor-minimalist-b">
            <tr>              
                <th>Created</th><th>Account</th><th>Firm Name</th><th>Ticket History</th><th>Assigned</th><th>Called</th><th>Who Called</th>

            <?php foreach ($data as $item): ?>
                    <tr>
                        <td><?=$item->DateAdded?></td><td><?=$item->CustID?></td><td><a href="https://support.cch.com/inventory/protected/CustomerProfile.aspx?acct=<?=$item->CustID?>"><?=$item->FirmName?></a></td><td><a href="http://support.cch.com/star/ticket_list_customer_history.aspx?customer_number=<?=$item->CustID?>">Ticket History</a></td><td><?=$item->DateAssigned?></td><td><?=$item->DateCalled?></td><td><?=$item->WhoCalled?></td>
                    </tr>
            <?php endforeach; ?>

            </tr>
        </table>
