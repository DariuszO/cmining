
<div class="row">
                    <div class="col-sm-12">
                        
                        <center><h2 class="page-title">List of cryptocurrencies</h2></center>
                    </div>
                </div>


<style>
.table__status.online {
    color: #81c784;
}

.table__status.offline {
    color: #e57373;
}
</style>
        <!-- Basic table -->
        <div class="row">
          <div class="col-xs-12">
          <div class="card-box">
            <div class="panel panel-default">
              
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table" id="datatables__example">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Abbreviation</th>
                        <th>Price BTC</th>
                       
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <? foreach($List as $Coin): ?>
                    
                    <?
                    	$query = $this->db->where("bUidCoin", $Coin->cUid)->where("bUserId", $this->session->UserId)->get("db_user_balance");
                    ?>
                    
                      <tr>
                        <td align="center">
                          <div class="">
                            <img style="width: 50px;" src="https://www.coinpayments.net/images/coins/<?=$Coin->cAbbr;?>.png" alt="...">
                          </div>
                          <strong><?=$Coin->cName;?></strong>
                        </td>
                        <td align="center"> <?=$Coin->cAbbr;?></td>
                        <td align="center"> <?=$Coin->cPrice;?> BTC</td>
                        
                        <td align="center">
                          <div id="coin_<?=$Coin->cUid;?>" class="table__status <? if($query->num_rows() == 1) echo 'online'; else echo 'offline'; ?>">
                            <i class="fa fa-circle-o"></i> <b class="table__status <? if($query->num_rows() == 1) echo 'online'; else echo 'offline'; ?>" id="statusCoin_<?=$Coin->cUid;?>"><? if($query->num_rows() == 1) echo 'Online'; else echo 'Offline'; ?></b>
                          </div>
                        </td>
                        
                        <?
                        if($query->num_rows() == 1):
                        ?>
                        <td align="center"><button type="button" disabled="disabled" class="btn btn-success">Included</button></td>
                        <? else: ?>
                        
                        <td align="center">
                        <b id="ButtonCoins_<?=$Coin->cUid;?>"></b>
                        <input  id="ButtonCoin_<?=$Coin->cUid;?>" type="submit" class="<? if($query->num_rows() == 0) echo 'btn btn-warning'; ?>" value="<? if($query->num_rows() == 0) echo 'Include'; ?>" onClick="ResetOnlineOfflineCoin('<?=$Coin->cUid;?>'); return false;"></td>
                        
                        <? endif; ?>
                      </tr>
                      <? endforeach; ?>
                      
                      
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div> <!-- / .row -->
        
        
