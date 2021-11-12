

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
                        <th>ID</th>
                        <th>Логин</th>
                        <th>Сумма</th>
                        <th>Система</th>
                        
                        <th>Дата</th>
                      </tr>
                    </thead>
                    <tbody>
                    <? foreach($List as $Coin): ?>
                      <tr>
                        
                        <td> <?=$Coin->sUid;?></td>
                        <td> <?=$Coin->uLogin;?></td>
                        <td><?=$Coin->sAmount;?></td>
                        <td><img style="width: 20px;" src="https://www.coinpayments.net/images/coins/<?=$Coin->sCoin;?>.png" alt="..."> <?=$Coin->sCoin;?></td>
                        
                        
                        <td><?=date("d.m.Y H:i", $Coin->sDateAdd);?></td>
                        
                        
                        
                        
                       
                      </tr>
                      <? endforeach; ?>
                      
                      
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- / .row -->
<div class="row">
<div class="col-lg-12">
	<center>
   		<ul class="pagination">
            <?=$this->pagination->create_links();?>
        </ul>
    </center>
</div>
</div>
        
