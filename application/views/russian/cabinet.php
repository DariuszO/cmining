

<input type="hidden" id="Speed" value="<?=$Speedmine;?>" />
<input type="hidden" id="Miner" value="<?=$SelectMinerd;?>" />

<style>
	.blockMine
	{
		
		
		border: 1px solid #999595;
		border-radius: 10px;
		display: block;
		padding: 10px 10px;
	}
	
	.blockMinee
	{
		
		display: block;
		padding: 10px 10px;
	}
</style>		

<!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        
                        <center><h4 class="page-title">Кабинет</h4></center>
                    </div>
                </div>



<div class="deposit_page">
<center>
		<div class="row">
		
		<div class="col-lg-4">
		<div class="card-box">
				<div class="blockMine" id="GHS">
					 <input type="hidden" id="OldBalance" value="<?=$BalanceGHS;?>" />
						<h4>
						<div class="table__avatar">
                            <img style="width: 50px;" src="/tpl/img/GHS.png" alt="...">
                        </div>
						GHS</h4>
						<hr>
						Баланс: <span id="Balance"><?=$BalanceGHS;?></span> GHS
						<hr>
						Стоимость: <span id="Price"><?=sprintf("%.8f", $this->config->item('PriceCloudGHS'));?></span> BTC
						<hr>
						<?
						$SPedding = (($this->config->item('PriceCloudGHS') * $BalanceGHS) / (60 * 60 * 24 * $this->config->item('ReturnDayFromDeposit'))) / $this->config->item('PriceCloudGHS');
						?>
						Доход в час: ~<?=sprintf("%.8f", $SPedding * 3600);?> GHS
						<hr>
						
						Сумма: <span id="Cash"><?=sprintf("%.8f", $this->config->item('PriceCloudGHS') * $BalanceGHS);?></span> BTC
						<hr>
						
						
					
				</div>
				</div>
				
			</div>
			
			
			
			
			<div class="col-lg-4">
		<div class="card-box">
				<div class="blockMinee">
				Advertising<br>
<!--
<a href="https://cloud.bitaltearning.com/Dashboard/Ticket"><img src="/tpl/dfhsfgsdf_ru.jpg"></a>

<script src="//catcut.net/adv/14716"></script>
	-->
<a href="https://millhash.com/Welcome/Partner/1" target="_blank"><img src="https://millhash.com/aff/MH-200.gif"></a>	
					
				</div>
				</div>
				
			</div>
		
		
		
		<? foreach($List as $Coin): ?>
			<div class="col-lg-4">
			<div class="card-box">
				<div class="blockMine" id="<?=$Coin->cAbbr;?>">
					 <input type="hidden" id="OldBalance" value="<?=sprintf("%.15f", $Coin->bBalance);?>" />
						<h4>
						<div class="table__avatar">
                            <img style="width: 50px;" src="https://www.coinpayments.net/images/coins/<?=$Coin->cAbbr;?>.png" alt="...">
                        </div>
						<?=$Coin->cName;?> (<?=$Coin->cAbbr;?>)</h4>
						<hr>
						Баланс: <span id="Balance"><?=$Coin->bBalance;?></span> <?=$Coin->cAbbr;?>
						<hr>
						Стоимость: <span id="Price"><?=$Coin->cPrice;?></span> BTC
						<hr>
						<?
						$SPedding = ((($this->config->item('PriceCloudGHS') * $BalanceGHS) / (60 * 60 * 24 * $this->config->item('ReturnDayFromDeposit'))) / $Coin->cPrice);
						?>
						Доход в час: ~<?=sprintf("%.8f", $SPedding * 3600);?> <?=$Coin->cAbbr;?>
						<hr>
						
						Сумма: <span id="Cash"><?=sprintf("%.8f", $Coin->cPrice * $Coin->bBalance);?></span> BTC
						<hr>
						<input type="submit" 
											<? if($SelectMinerd != $Coin->cAbbr): ?> 
												onClick="SetMine('<?=$Coin->cUid;?>'); return false;" 
												class="btn btn-info"
											<? else: ?> 
												disabled="disabled" 
												class="btn btn-success"
											<? endif; ?> 
											 value="Mining">
						
					<br>
					<br>
					<br>
					<br>
				</div>
				
			</div>
			</div>
			<? endforeach; ?>
		</div>
		
</center>	
	
		
	
	
	
	
	</div>

					