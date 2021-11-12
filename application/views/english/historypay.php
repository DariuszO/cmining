




<div class="row">
	<div class="col-lg-12">
	<div class="card-box">
		<h3>Payment History</h3>
			<table class="table table-bordered">
				<tr>
					<td>#</td>
					<td>Date</td>
					<td>Coin</td>
					<td>Amount</td>
					<td>TXid</td>
				</tr>
				
				<? $i = 1; foreach($ListHistoryEchange as $List): ?>
				
					<tr>
						<td><?=$i;?></td>
						<td><?=date("d.m.Y H:i", $List->sDateAdd);?></td>
						<td><?=$List->sCoin;?></td>
						<td><?=$List->sAmount;?></td>
						<? if($List->sTxStatus == 0): ?>
						<td>Waiting...</td>
						<? else: ?>
						<td><?=$List->sTxId;?></td>
						<? endif; ?>
					</tr>
				<? $i++; endforeach; ?>
			</table>
		
	</div>
	</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="card-box">
	<div class="dataTables_paginate paging_simple_numbers">
		<center>
		

<br>
		
	   		<ul class="pagination">
	            <?=$this->pagination->create_links();?>
	        </ul>
	    </center>
    </div>
</div>
</div>
</div>
