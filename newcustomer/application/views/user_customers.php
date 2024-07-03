        
		<script >
			  $(function() {
			    $("table#sortTableExample").tablesorter({ sortList: [[1,0]] });
			  });	  
			  		  
		   </script>
		   <?php
		   		echo $this->session->flashdata('formError');
		?>		
			
         
		 <table class="condensed-table" id="sortTableExample">
		 
		 
		 <thead>
            <tr>              
                <th>Created</th><th>Account</th><th>Firm Name</th><th>Ticket History</th><th>Assigned</th><th>Assigned To</th><th>STAR</th>
			
			</tr>
			</thead>
				
            <?php foreach ($data as $item): ?>			
                    <tr>
                        <td><?=$item->DateAdded?></td>
						<td><a href="https://support.cch.com/inventory/protected/default.aspx?acct=<?=$item->CustID?>" target="_blank"><?=$item->CustID?></a></td>
						<td><a href="https://support.cch.com/inventory/protected/CustomerProfile.aspx?acct=<?=$item->CustID?>" target="_blank"><?=$item->FirmName?></a></td>
						<td><a href="http://support.cch.com/star/ticket_list_customer_history.aspx?customer_number=<?=$item->CustID?>" target="_blank">Ticket History</a></td>
						<td><?=$item->DateAssigned?></td>
						<td><?=$item->AssignedTo?></td>
						<td>
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
							<form method="POST" action="<?=base_url();?>index.php/customers/updateOpenCustomers/">
							<input type="hidden" value="<?=$item->id?>" name="id">
							<input class="span2" name="ticketNum">&nbsp;<input type="submit" class="btn small primary" value="Close Customer" name="submit" >&nbsp;<a href="http://support.cch.com/star/ticket_new.aspx?customer_number=<?=$item->CustID?>" class="btn small danger" target="_blank">New Star Ticket</a>
							<?php
	if($this->session->userdata('fullname') && $this->session->userdata('userLevel') > 0)
	{								
	?>
							&nbsp;<button data-controls-modal="modal-from-dom<?=$item->CustID?>" data-backdrop="true" data-keyboard="true" class="btn small">Reassign Customer</button>
							<?php
								}
								?>
							</form>
							
							</td>
                    </tr>
					
            <?php endforeach; ?>		                     
		</table>
		
		
		
		
		
       
    
