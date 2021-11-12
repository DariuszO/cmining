

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
                        <th>E-Mail</th>
                        <th>Баланс GHS</th>
                        <th>Майнит</th>
                        <th>Дата рег.</th>
                       
                        <th>Последний вход</th>
                        <th>IP рег.</th>
                        <th>Последний IP</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <? foreach($List as $Coin): ?>
                      <tr>
                        
                        <td> <?=$Coin->uUid;?></td>
                        <td> <?=$Coin->uLogin;?></td>
                        <td><?=$Coin->uEmail;?></td>
                        <td><?=$Coin->uBalanceGHS;?></td>
                        <td><?=$Coin->uMiner;?></td>
                        <td><?=date("d.m.Y H:i", $Coin->uDateReg);?></td>
                        <td><?=date("d.m.Y H:i", $Coin->uLastLogin);?></td>
                        <td><?=$Coin->uIpReg;?></td>
                        <td><?=$Coin->uLastIpLogin;?></td>
                        
                        <td><a href="/Flatpanel/EditUser/<?=$Coin->uUid;?>" class="btn btn-info">Подробнее</a></td>
                        
                        
                        
                       
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
        
