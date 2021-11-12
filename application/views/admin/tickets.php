

        <!-- Basic table -->
        <div class="row">
          <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
              <h4 class="panel-title">Список тикетов</h4>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table" id="datatables__example">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Тема</th>
                        <th>Дата открытия</th>
                        <th>Статус</th>
                        <th>Читать</th>
                      </tr>
                    </thead>
                    <tbody>
                    <? foreach($List as $Coin): ?>
                      <tr>
                      
                      	<td><?=$Coin->tUid;?></td>
                      	<td><?=$Coin->tTheme;?></td>
                      	<td><?=date("d.m.Y H:i", $Coin->tDateAdd);?></td>
                      	<td><? if($Coin->tStatus == 0) echo 'Открыт'; else echo 'Закрыт'; if($Coin->tRead == 0) echo ' (Есть ответ)';?></td>
                      	<td><a href="/Flatpanel/ViewTicket/<?=$Coin->tUid;?>" class="btn btn-info">Читать</a></td>
                      </tr>
                      <? endforeach; ?>
                      
                      
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- / .row -->
        
        
