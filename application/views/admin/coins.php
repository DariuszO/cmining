

        <!-- Basic table -->
        <div class="row">
          <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
              <h4 class="panel-title">Список валют</h4>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table" id="datatables__example">
                    <thead>
                      <tr>
                        <th>Название</th>
                        <th>Абривиатура</th>
                        <th>Стоимость BTC</th>
                        <th>Мин. Депозит</th>
                       
                        <th>Статус</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <? foreach($List as $Coin): ?>
                      <tr>
                        <td>
                          <div class="table__avatar">
                            <img src="https://www.coinpayments.net/images/coins/<?=$Coin->cAbbr;?>.png" alt="...">
                          </div>
                          <strong><?=$Coin->cName;?></strong>
                        </td>
                        <td> <?=$Coin->cAbbr;?></td>
                        <td> <?=$Coin->cPrice;?> BTC</td>
                        <td> 
                        <span id="cc_<?=$Coin->cUid;?>"></span>
                        <form class="form-inline" id="Coins_<?=$Coin->cUid;?>">
                        <input type="hidden" name="val" value="<?=$Coin->cUid;?>">
                        <input class="form-control input-sm" type="text" name="minamount" value="<?=$Coin->cMinimum;?>">
                        
                        <input type="submit" class=" btn btn-info" onClick="ChangeMinDeposit('<?=$Coin->cUid;?>'); return false;" value="Изменить">
                        </form>
                        </td>
                        
                        <td>
                          <div id="coin_<?=$Coin->cUid;?>" class="table__status <? if($Coin->cOnline == 1) echo 'online'; else echo 'offline'; ?>">
                            <i class="fa fa-circle-o"></i> <b id="statusCoin_<?=$Coin->cUid;?>"><? if($Coin->cOnline == 1) echo 'Online'; else echo 'Offline'; ?></b>
                          </div>
                        </td>
                        
                        <td><input  id="ButtonCoin_<?=$Coin->cUid;?>" type="submit" class="<? if($Coin->cOnline == 1) echo 'btn btn-success'; else echo 'btn btn-danger'; ?>" value="<? if($Coin->cOnline == 1) echo 'Отключить'; else echo 'Включить'; ?>" onClick="ResetOnlineOfflineCoin('<?=$Coin->cUid;?>'); return false;"></td>
                      </tr>
                      <? endforeach; ?>
                      
                      
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- / .row -->
        
        
