

<div class="row">
                    <div class="col-sm-12">
                        
                        <center><h2 class="page-title">Exchange cryptocurrency (Comission 10%)</h2></center>
                    </div>
                </div>

<div class="row">
	<div class="col-lg-12">
	<div class="card-box">
	<div id="errorExhange"></div>
	
		<table class="table table-bordered">
			<tr>
				<td>
					<center><span id="imgCoin_1"><img src="/tpl/img/quest.png"></span>	</center>
				</td>
				<td style="width: 50%;">
					<center><span id="imgCoin_2"><img src="/tpl/img/quest.png"></span></center>
				</td>
			</tr>
		</table>
	</div>
</div>
<br>

<div class="row">
	<div class="col-lg-12">
	<div class="card-box">
	
		<table class="table table-bordered">
			<tr>
				<td>
					<select class="form-control" name="Coin_one" onchange="step1()" id="step1" >
					<option value="">Select currency</option>
						<?
						foreach($List as $Coin): //Список коинов с балансом
						?>
							<option dat="<?=$Coin->cAbbr;?>" value="<?=$Coin->cAbbr;?>"><?=$Coin->cName;?>(<?=$Coin->cAbbr;?>) - <?=$Coin->bBalance;?></option>
						<? endforeach; ?>
					</select>
				</td>
				<td style="width: 50%;">
					<select class="form-control" name="Coin_Twos" id="step2" onchange="step2()" >
						 <!--Список доступных к обмену коинов-->
					</select>
				</td>
			</tr>
		</table>
	</div>
	</div>
</div>
<br>

<div class="row">
	<div class="col-lg-12">
	
		<div id="step3" style="display: none">
		<div class="card-box">
			<table class="table table-bordered">
				<tr>
					<td style="width: 50%;">
						Give: <span id="coin_1"></span><input class="form-control" id="amount1" type="text" name="amount1" value="0">
					</td>
					<td style="width: 50%;">
						Receive: <span id="coin_2"></span><input class="form-control" type="text" id="amount2" name="amount2" value="0" disabled="disabled">
					</td>
				</tr>
				<tr>
					<td colspan="2" class="text-center">
						<input type="submit" onClick="ExchangeComplite(); return false;" class="btn btn-success" value="Exchange">
					</td>
				</tr>
			</table>
		</div>
	</div>
	</div>
</div>
</div>
<div class="row">
	<div class="col-lg-12">
	<div class="card-box">
		<h3>History exchange</h3>
			<table class="table table-bordered">
				<tr>
					<td>#</td>
					<td>Date</td>
					<td>Description</td>
				</tr>
				
				<? $i = 1; foreach($ListHistoryEchange as $List): ?>
				
					<tr>
						<td><?=$i;?></td>
						<td><?=$List->hDateAdd;?></td>
						<td><?=$List->hText;?></td>
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
	   		<ul class="pagination">
	            <?=$this->pagination->create_links();?>
	        </ul>
	    </center>
    </div>
</div>
</div>
</div>
