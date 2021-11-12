

<div class="row">
                    <div class="col-sm-12">
                        
                        <center><h2 class="page-title">Ticket</h2></center>
                    </div>
                </div>

<div class="row">
	<div class="col-lg-12">
	<div class="card-box">
		<div class="row text-center">
			<a href="/Dashboard/NewTicket" class="btn btn-info">To create a ticket</a>
			<hr>
			<?=$this->session->flashdata('errorTicket');?>
		</div>
		
		<div class="row text-center">
			<table class="table table-bordered">
				<thead>
					<th>#</th>
					<th>Theme</th>
					<th>Created date</th>
					<th>Status</th>
					<th>Read</th>
				</thead>
				
				<tbody>
				<? foreach($List as $Ticket): ?>
					<tr>
						<td><?=$Ticket->tUid;?></td>
						<td><?=$Ticket->tTheme;?></td>
						
						<td><?=date("d.m.Y H:i", $Ticket->tDateAdd);?></td>
						<td><? if($Ticket->tStatus == 0) echo '<font color="green">Open</font>'; else echo '<font color="red">Close</font>'; if($Ticket->tRead == 1) echo ' <b>(Is the answer)</b>';?></td>
						<td><a href="/Dashboard/TicketView/<?=$Ticket->tUid;?>" class="btn btn-info">Read</a></td>
					</tr>
				<? endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	</div>
	
</div>