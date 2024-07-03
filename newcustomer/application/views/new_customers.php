        
       
    
         <script >
			  $(function() {
			    $("table#sortTableExample").tablesorter({ sortList: [[1,0]] });
			  });			  
		   </script>
		
		<table class="zebra-striped" id="sortTableExample">
		<thead>
            <tr>              
                <th>Created</th><th>Account</th><th>Firm Name</th><th>Ticket History</th><th></th>
			</tr>
		</thead>
            <?php foreach ($data as $item): ?>
                    <tr>
                        <td><?=$item->DateAdded?></td>
						<td><a href="https://support.cch.com/inventory/protected/default.aspx?acct=<?=$item->CustID?>" target="_blank"><?=$item->CustID?></a></td>
						<td><a href="https://support.cch.com/inventory/protected/CustomerProfile.aspx?acct=<?=$item->CustID?>"><?=$item->FirmName?></a></td>
						<td><a href="http://support.cch.com/star/ticket_list_customer_history.aspx?customer_number=<?=$item->CustID?>" target="_blank" rel='twipsy'>Ticket History</a></td>
						<td>
						<!-- sample modal content -->
          <div id="modal-from-dom<?=$item->CustID?>" class="modal hide fade">
            <div class="modal-header">
              <a href="#" class="close">&times;</a>
              <h3>Select User to Assign</h3>
            </div>
            <div class="modal-body">
			  	
				<table>
					<?php foreach ($users as $datas): ?>
					<tr>
						<td><?=$datas->fullname;?></td><td style="text-align: right;"><a href="<?=base_url();?>index.php/admin/AssignNewCustomers/<?=$item->CustID?>/<?=$datas->fullname;?>" class="btn small primary">Assign Customer</a></td>
					</tr>
					<?php endforeach; ?>													
				</table>				
            </div>
            <div class="modal-footer">
			&nbsp;
            </div>
          </div>						
						<button data-controls-modal="modal-from-dom<?=$item->CustID?>" data-backdrop="true" data-keyboard="true" class="btn primary">Assign Customer</button>&nbsp;<a href="<?=base_url();?>index.php/admin/closeExistingCustomer/Existing%20Customer/<?=$item->id?>/Admin"class="btn danger">Existing Customer</a></td>
                    </tr>
            <?php endforeach; ?>
            
        </table>