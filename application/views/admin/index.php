<div class="row">
          <div class="col-xs-12">
            
            <h3 class="page-header">
              Dashboard <small>Статистика проекта</small>
            </h3>

          </div>
        </div> <!-- / .row -->
        
        <!-- Dashboard: Stats -->
        <div class="row">
          <div class="col-xs-12 col-sm-3">

            <div class="dashboard-stats__item bg-orange">
              <i class="fa fa-comments"></i>
              <h3 class="dashboard-stats__title">
                <span class="count-to" data-from="0" data-to="<?=$CountUsers;?>">0</span> 
                <small>Пользователей</small>
              </h3>
            </div>
            
          </div>
          <div class="col-xs-12 col-sm-3">

            <div class="dashboard-stats__item bg-pink">
              <i class="fa fa-globe"></i>
              <h3 class="dashboard-stats__title">
                <span class="count-to" data-from="0" data-to="<?=$CountCashOut;?>">0</span> 
                <small>Кол-во пополнений</small>
              </h3>
            </div>
            
          </div>
          <div class="col-xs-12 col-sm-3">

            <div class="dashboard-stats__item bg-accent">
              <i class="fa fa-pie-chart"></i>
              <h3 class="dashboard-stats__title">
                <span class="count-to" data-from="0" data-to="<?=$CountEnter;?>">0</span> 
                <small>Кол-во Выплат</small>
              </h3>
            </div>
            
          </div>
          <div class="col-xs-12 col-sm-3">

            <div class="dashboard-stats__item bg-teal">
              <i class="fa fa-eur"></i>
              <h3 class="dashboard-stats__title">
                <span class="count-to" data-from="0" data-to="<?=$CountEnterWait;?>">0</span>
                <small>Заявок на выплату</small>
              </h3>
            </div>
            
          </div>
        </div> <!-- / .row -->

        <div class="row">

          <!-- Dashboard: Visitors -->
          <div class="col-xs-12 col-sm-6">
            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  Список валют которыми пополнялись
                </h4>
              </div>
              <div class="panel-body">
                <table class="table">
                <? foreach($ListCoinEnter as $Coin): ?>
                	<tr>
                		<td><?=$Coin->seUidCoin;?></td>
                		<td><img style="width: 20px;" src="https://www.coinpayments.net/images/coins/<?=$Coin->seNameCoin;?>.png" alt="..."> <?=$Coin->seNameCoin;?></td>
                		<td><?=$Coin->seAmount;?></td>
                	</tr>
                <? endforeach; ?>
                </table>
              </div>
            </div>

          </div>

          <!-- Dashboard: Revenue -->
          <div class="col-xs-12 col-sm-6">
            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  Список выплаченых валют
                </h4>
              </div>
              <div class="panel-body">
                <table class="table">
                <? foreach($ListCoinCashOut as $Coin): ?>
                	<tr>
                		<td><?=$Coin->scUidCoin;?></td>
                		<td><img style="width: 20px;" src="https://www.coinpayments.net/images/coins/<?=$Coin->scNameCoin;?>.png" alt="..."> <?=$Coin->scNameCoin;?></td>
                		<td><?=$Coin->scAmount;?></td>
                	</tr>
                <? endforeach; ?>
                </table>
              </div>
            </div>

          </div>
        </div> <!-- / .row -->

        
