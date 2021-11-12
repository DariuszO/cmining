
<div class="row">
                    <div class="col-sm-12">
                        
                        <center><h2 class="page-title">Пополнение баланса</h2></center>
                    </div>
                </div>



<div class="row">
<?=$this->session->flashdata("errorDepositPayeer");?>
<? foreach($List as $Coin): ?>
	<div class="col-lg-12">
		<div class="card-box">
			<table class="table table-bordered">
				<tr>
					<td align="center" style="width: 200px;">
	                    <div class="">
	                    <img style="width: 50px;" src="https://www.coinpayments.net/images/coins/<?=$Coin->cAbbr;?>.png" alt="...">
	                    </div>
	                    <strong><?=$Coin->cName;?></strong><br>
	                    <strong>Минимум <?=$Coin->cMinimum;?> <?=$Coin->cAbbr;?></strong>
                    </td>
					<td align="center">
					
						<? if($Coin->cAbbr == 'USD'): ?>
							<form class="form-inline" method="post" action="/Dashboard/EnterPayeer">
								Средства на баланс зачислятся автоматически<br>
								<input type="text" class="form-control" name="amount" placeholder="10.00">
								<input type="submit" class="btn btn-success" value="Пополнить">
							</form>
						<? endif; ?>
						<? if($Coin->bWallet): ?>
							Средства на баланс зачислятся после получения 3-х подтверждений<br>
							<div id="result_<?=$Coin->bUidCoin;?>"><div class="alert alert-success">Ваш адрес для депозита <br><b><?=$Coin->bWallet;?></b>
							<? if($Coin->cAbbr == 'XMR'): ?>
							<br>
							Идентификатор платежа<br><b><?=$Coin->bDestTag;?></b>
							<? endif; ?>
							
							</div></div>
							
						
						<? else: ?>
							<? if($Coin->cAbbr != 'USD'): ?>
								<form method="post" action="" id="idCoin_<?=$Coin->bUidCoin;?>">
								<input type="hidden" name="valuta" value="<?=$Coin->cAbbr;?>">
									Средства на баланс зачислятся после получения 3-х подтверждений<br>
									<div id="result_<?=$Coin->bUidCoin;?>"></div>
									<input id="btnCoin_<?=$Coin->bUidCoin;?>" type="submit" class="btn btn-success" onClick="Deposit('<?=$Coin->bUidCoin;?>'); return false;" value="Получить кошелек">
								</form>
							<? endif; ?>
						<? endif; ?>
						
						
					</td>
					
				</tr>
			</table>
		
	</div>
	</div>
<? endforeach; ?>
</div>