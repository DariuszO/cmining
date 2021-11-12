
<div class="row">
                    <div class="col-sm-12">
                        
                        <center><h2 class="page-title">Вывод средств</h2></center>
                    </div>
                </div>


<div class="row">
<? foreach($List as $Coin): ?>
	<div class="col-lg-12">
	<div class="card-box">
		<form method="post" action="" id="idCoin_<?=$Coin->bUidCoin;?>">
		<input type="hidden" name="valuta" value="<?=$Coin->cAbbr;?>">
			<table class="table table-bordered">
				<tr>
					<td align="center" style="width: 300px;">
	                    <div class="">
	                    <img style="width: 50px;" src="https://www.coinpayments.net/images/coins/<?=$Coin->cAbbr;?>.png" alt="...">
	                    </div>
	                    <strong><?=$Coin->cName;?></strong><br>
	                    <strong>Минимум <?=$Coin->cMinimum;?> <?=$Coin->cAbbr;?></strong><br>
	                    <i>Баланс <?=$Coin->bBalance;?> <?=$Coin->cAbbr;?></i><br>
						Комиссия плат. системы
                    </td>
					<td align="center">
					
						Сумма <b><?=$Coin->cAbbr;?></b>: <input type="text" class="form-control" name="amount" placeholder="<?=$Coin->bBalance;?>">
						Кошелек <?=$Coin->cName;?>: <input type="text" class="form-control" name="wallet" placeholder="Wallet">
						
						
					</td>
					<td align="center" style="width: 300px;">
					
						<br>
						<br>
						<input onClick="withdrawal('<?=$Coin->bUidCoin;?>'); return false;" id="btns_<?=$Coin->bUidCoin;?>" type="submit" class="btn btn-success" value="Вывести">
						<div id="info_withdraw_<?=$Coin->bUidCoin;?>"></div>
						
					</td>
					
				</tr>
			</table>
		</form>
	</div>
	</div>
<? endforeach; ?>
</div>