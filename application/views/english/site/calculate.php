<script>
	var Oksup = <?=$this->config->item('ReturnDayFromDeposit');?>;
	var PriceCloud = <?=$this->config->item('PriceCloudGHS');?>;
	var ww = <?=((($this->config->item('PriceCloudGHS') * 10) / (60 * 60 * 24 * $this->config->item('ReturnDayFromDeposit'))) / $this->config->item('PriceCloudGHS')) * 3600;?>
</script>

<!-- Begin page-broadcom -->
		<div class="section overlay-80 page-broadcom broadcom-bg slider-bottom-fix ptb-110"> 
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumb-wrap">
							<ol class="breadcrumb text-left">
							  <li class="breadcrumb-item"><a href="/">Home</a></li>
							  <li class="breadcrumb-item active">Calculate</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!-- End page-broadcom -->
        <!-- Begin intro-section -->
        <div class="intro-section clear bg-white ptb-110">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Begin section-title -->
                                <div class="section-title title-divider text-left mb-40">
                                    <h3 class="title">Calculate profitability</h3>
                                    
                                </div>
                                <!-- End section-title -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="contents">
                                   <table class="table table-bordered">
                                   	<tr>
                                   	
                                   	<td>Currency: <select onchange="SelectCoin()" class="form-control" id="SelectCoin">
                                   	
                                   	<? foreach($ListCoin as $Coin): ?>
                                   		<option price="<?=$Coin->cPrice;?>" value="<?=$Coin->cAbbr;?>"><?=$Coin->cName;?>(<?=$Coin->cAbbr;?>)</option>
                                   	<? endforeach; ?>
                                   	</select></td>
                                   	
                                   	</tr>
                                   	
                                   	
                                   	
                                   	<tr><td>Cloud GHS: <input class="form-control" type="text" id="CountCloud" value=""></td></tr>
                                   	<tr><td>Amount <span id="qqq">BTC</span>: <input class="form-control" type="text" id="CountCrypto" value=""></td></tr>
                                   	<tr><td>Amount BTC: <input disabled="disabled" class="form-control" type="text" id="CountCryptoBtc" value=""></td></tr>
                                   </table>
                                </div>
                            </div>
                            
                            <div class="col-lg-8">
                                <div class="contents">
                                   <table class="table table-bordered">
                                   	<tr>
                                   	
                                   	<td>Time</td>
                                   	<td>Income <span id="coinName">BTC</span></td>
                                   	<td>Income BTC</td>
                                   	<td>Income %</td>
                                   	
                                   	</tr>
                                   	
                                   	<tr>
                                   		<td>1 час</td>
                                   		<td><span id="HourCoin"></span></td>
                                   		<td><span id="HourBtc"></span></td>
                                   		<td><span id="HourPerc"></span></td>
                                   	</tr>
                                   	
                                   	<tr>
                                   		<td>Сутки</td>
                                   		<td><span id="DayCoin"></span></td>
                                   		<td><span id="DayBtc"></span></td>
                                   		<td><span id="DayPerc"></span></td>
                                   	</tr>
                                   	
                                   	
                                   	<tr>
                                   		<td>Неделя</td>
                                   		<td><span id="WeekCoin"></span></td>
                                   		<td><span id="WeekBtc"></span></td>
                                   		<td><span id="WeekPerc"></span></td>
                                   	</tr>
                                   	
                                   	<tr>
                                   		<td>Месяц</td>
                                   		<td><span id="MothCoin"></span></td>
                                   		<td><span id="MothBtc"></span></td>
                                   		<td><span id="MothPerc"></span></td>
                                   	</tr>
                                   	
                                   	<tr>
                                   		<td>3 Месяца</td>
                                   		<td><span id="Moth3Coin"></span></td>
                                   		<td><span id="Moth3Btc"></span></td>
                                   		<td><span id="Moth3Perc"></span></td>
                                   	</tr>
                                   	
                                   	<tr>
                                   		<td>Год</td>
                                   		<td><span id="YearCoin"></span></td>
                                   		<td><span id="YearBtc"></span></td>
                                   		<td><span id="YearPerc"></span></td>
                                   	</tr>
                                   	
                                   	
                                   	
                                   	<tr></tr>
                                   </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- End intro-section -->
       
       
       