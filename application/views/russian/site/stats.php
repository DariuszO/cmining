<!-- Begin page-broadcom -->
		<div class="section overlay-80 page-broadcom broadcom-bg slider-bottom-fix ptb-110"> 
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumb-wrap">
							<ol class="breadcrumb text-left">
							  <li class="breadcrumb-item"><a href="/">Главная</a></li>
							  <li class="breadcrumb-item active">Статистика</li>
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
                                    <h3 class="title">Живая статистика</h3>
                                    
                                </div>
                                <!-- End section-title -->
                            </div>
                        </div>
                        <center><div class="row">
	                        <div class="col-lg-6 col-md-6 col-sm-6">
	                            <div class="info-box info-box-style-5">
	                                <div class="info-box-top">
	                                    <span><i class="icofont icofont-labour"></i></span>
	                                </div>
	                                <div class="info-box-desc">
	                                    <p>Инвесторов<br><?=$CountUsers + 8;?></p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-6 col-md-6 col-sm-6">
	                            <div class="info-box info-box-style-5">
	                                <div class="info-box-top">
	                                    <span><i class="icofont icofont-space-shuttle"></i></span>
	                                </div>
	                                <div class="info-box-desc">
	                                    <p>Дата старта<br><?=$this->config->item('DateStartProject');?></p>
	                                    
	                                </div>
	                            </div>
	                        </div>
                       
                       
                    	</div></center>
                    <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="contents">
                                <h4>Последние 20 пополнений</h4>
                                
                                <table class="table">
                                	<tr>
                                		<td>Логин</td>
                                		<td>Coin</td>
                                		<td>Сумма</td>
                                		<td>Дата</td>
                                	</tr>
                                	
                                	<? foreach($LastDeposit as $List): ?>
                                	<tr>
                                		<td><?=$List->uLogin;?></td>
                                		<td><img style="width: 20px;" src="https://www.coinpayments.net/images/coins/<?=$List->sCoin;?>.png" alt="..."> <?=$List->sCoin;?></td>
                                		<td><?=$List->sAmount;?></td>
                                		<td><?=date("d.m.Y H:i", $List->sDateAdd);?></td>
                                	</tr>
                                	
                                	<? endforeach; ?>
                                </table>
                                
                                
                                
                                
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="contents">
                                <h4>Последние 20 выплат</h4>
                                
                                <table class="table">
                                	<tr>
                                		<td>Логин</td>
                                		<td>Coin</td>
                                		<td>Сумма</td>
                                		<td>Дата</td>
                                	</tr>
                                	
                                	<? foreach($LastCashOut as $List): ?>
                                	<tr>
                                		<td><?=$List->uLogin;?></td>
                                		<td><img style="width: 20px;" src="https://www.coinpayments.net/images/coins/<?=$List->sCoin;?>.png" alt="..."> <?=$List->sCoin;?></td>
                                		<td><?=$List->sAmount;?></td>
                                		<td><?=date("d.m.Y H:i", $List->sDateAdd);?></td>
                                	</tr>
                                	
                                	<? endforeach; ?>
                                </table>
                                
                                
                                
                                
                                </div>
                            </div>
                            
                         </div>
                    </div>
                    
                </div>
            </div>
        </div>
                                
                                