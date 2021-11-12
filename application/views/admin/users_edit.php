
<!-- Basic table -->
        <div class="row">
          <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
              <h4 class="panel-title">Детали пользователя <?=$User['uLogin'];?></h4>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
<?=$this->session->flashdata('error');?>
	<div class="col-lg-5">
	
		<table class="table text-center table-bordered">
			<tr>
				<td><?=$User['uLogin'];?></td>
			</tr>
			<tr>
			<?
				if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/avatar/' . $User['uLogin'] . $User['uUid'] . '.jpg')):
	            	$Ava = '/avatar/' . $User['uLogin'] . $User['uUid'] . '.jpg';
	            else:
	            	$Ava = '/avatar/noava.jpg';
	            endif;
			?>
			
				<td><img style="width: 200px;" src="<?=$Ava;?>" alt="..."></td>
			</tr>
			
		</table>
	
		<h4><a href="#" onclick="ShowElement('balance'); return false;">Балансы (Показать/Скрыть)</a></h4>
		<table class="table table-bordered" id="balance" style="display: none">
		<? foreach($Balance as $Coin): ?>
			<tr>
				<td>
					<img style="width: 30px;" src="https://www.coinpayments.net/images/coins/<?=$Coin->cAbbr;?>.png" alt="...">
	            </td>   
	             
	            <td> 
	               <center> <b id="error_<?=$Coin->bUid;?>"></b></center>
	                <form method="post" action="" class="form-inline" id="Coins_<?=$Coin->bUid;?>">
		                <input type="hidden" name="user" value="<?=$User['uUid'];?>">
		                <input type="hidden" name="coin" value="<?=$Coin->bUid;?>">
		                <?=$Coin->cAbbr;?>
		                <input type="text" style="width: 150px;" class="form-control" name="amount" value="<?=$Coin->bBalance;?>"> 
		                <input type="submit" onClick="UpdateBalanceUser('<?=$Coin->bUid;?>'); return false;" value="Сохранить" class="btn btn-info">
	                	
	                </form>
	            </td>
				
			</tr>
		<? endforeach; ?>
		</table>
	</div>
	<div class="col-lg-7">
	<form method="post" action="">
		<table class="table table-bordered">
			<tr>
				<td style="width: 200px">Логин:</td> <td><?=$User['uLogin'];?></td>
			</tr>
			
			<tr>
				<td>Дата регистрации:</td> <td> <?=date("d.m.Y H:i", $User['uDateReg']);?></td>
			</tr>
			
			<tr>
				<td>Последний вход:</td> <td> <?=date("d.m.Y H:i", $User['uLastLogin']);?></td>
			</tr>
			
			<tr>
				<td>IP регистрации:</td> <td> <?=$User['uIpReg'];?></td>
			</tr>
			
			<tr>
				<td>IP входа:</td> <td> <?=$User['uLastIpLogin'];?></td>
			</tr>
			
			<tr>
				<td>Майнит:</td> <td> <?=$User['uMiner'];?></td>
			</tr>
			
			<tr>
				<td>Партнеров:</td> <td><?=$Partners;?> чел.</td>
			</tr>
			
			<tr>
				<td>E-Mail:</td> <td> <input class="form-control" type="text" name="fio" value="<?=$User['uEmail'];?>"></td>
			</tr>
			
			<tr>
				<td>ФИО:</td> <td> <input class="form-control" type="text" name="fio" value="<?=$User['uFIO'];?>"></td>
			</tr>
			
			<tr>
				<td>Skype:</td> <td> <input class="form-control" type="text" name="skype" value="<?=$User['uSkype'];?>"></td>
			</tr>
			
			<tr>
				<td>Страна:</td> <td> <input class="form-control" type="text" name="city" value="<?=$User['uCity'];?>"></td>
			</tr>
			
			<tr>
				<td>Город:</td> <td> <input class="form-control" type="text" name="country" value="<?=$User['uCountry'];?>"></td>
			</tr>
			
			<tr>
				<td colspan="2"><input type="submit" value="Сохранить" class="btn btn-success"></td>
			</tr>
			</table>
		</form>
		
		
		
		<h4><a href="#" onclick="ShowElement('enter'); return false;">Статистика пополнений юзера (Показать/Скрыть)</a></h4>
		<table class="table table-bordered" id="enter" style="display: none">
			<thead>
				<th>Система</th>
				<th>Сумма</th>
				
			</thead>
			
			<tbody>
			
			
			
				<?
				foreach($Enter as $Cashs):
				
				$this->db->where("sUserId", $User['uUid']);
				$this->db->where("sType", 1);
				$this->db->where("sCoin", $Cashs->cAbbr);
				$this->db->select_sum("sAmount");
				$query = $this->db->get("db_stat_coin");
				$row = $query->row_array();
				
				?>
				
				<tr>
					<td><?=$Cashs->cName;?></td>
					<td><?=sprintf("%.8f", $row['sAmount']);?> <?=$Cashs->cAbbr;?></td>
				</tr>
				<? endforeach; ?>
				
			</tbody>
		</table>
		
		<h4><a href="#" onclick="ShowElement('cashout'); return false;">Статистика вывода юзера (Показать/Скрыть)</a></h4>
		<table class="table table-bordered" id="cashout" style="display: none">
			<thead>
				<th>Система</th>
				<th>Сумма</th>
				
			</thead>
			
			<tbody>			
				<?
				foreach($Cashout as $Cash):
				
				$this->db->where("sUserId", $User['uUid']);
				$this->db->where("sType", 2);
				$this->db->where("sCoin", $Cash->cAbbr);
				$this->db->select_sum("sAmount");
				$query = $this->db->get("db_stat_coin");
				$row = $query->row_array();
				
				?>
				
				<tr>
					<td><?=$Cash->cName;?></td>
					<td><?=sprintf("%.8f", $row['sAmount']);?> <?=$Cash->cAbbr;?></td>
				</tr>
				<? endforeach; ?>
			</tbody>
		</table>
		
		
		<h4><a href="#" onclick="ShowElement('exch'); return false;">Последние 30 обменов (Показать/Скрыть)</a></h4>
		<table class="table table-bordered" id="exch" style="display: none">
			<thead>
				<th>Дата</th>
				<th>Текст</th>
				
			</thead>
			
			<tbody>			
				<?
				foreach($Exchange as $Cash):
				
				
				
				?>
				
				<tr>
					<td><?=$Cash->hDateAdd;?></td>
					<td><?=$Cash->hText;?></td>
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