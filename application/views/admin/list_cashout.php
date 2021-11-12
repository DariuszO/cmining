

        <!-- Basic table -->
        <div class="row">
          <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
              <h4 class="panel-title">Список валют</h4>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Логин</th>
                        <th>Система</th>
                        <th>Сумма</th>
                        <th>Дата</th>
                        
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <? foreach($ListCashOut as $Coin): ?>
                      <tr>
                        
                        <td> <?=$Coin->sUid;?></td>
                        <td> <a href="/Flatpanel/EditUser/<?=$Coin->uUid;?></a>"><?=$Coin->uLogin;?></a></td>
                        <td><?=$Coin->sCoin;?></td>
                        <td><?=$Coin->sAmount;?></td>
                        
                        <td><?=date("d.m.Y H:i", $Coin->sDateAdd);?></td>
                       
                        
                        <td><a href="/Flatpanel/SendCashOut/<?=$Coin->sUid;?>" class="btn btn-info">Выплатить</a>
                        <a href="/Flatpanel/DeleteCashOut/<?=$Coin->sUid;?>" class="btn btn-info">Удалить</a></td>
                        
                        
                        
                       
                      </tr>
                      <? endforeach; ?>
                      
                      
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- / .row -->

        
