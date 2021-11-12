

<div class="row">
                    <div class="col-sm-12">
                        
                        <center><h2 class="page-title">Мой профиль</h2></center>
                    </div>
                </div>

<div class="row">
<?=$this->session->flashdata('error');?>
	<div class="col-lg-4">
	<div class="card-box">
	<form method="post" action="/Dashboard/SetAvatar" enctype="multipart/form-data">
		<table  class="table table-bordered text-center">
			<tr>
				<td><?=$this->session->Login;?></td>
			</tr>
			<tr>
			<?
				if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/avatar/' . $this->session->Login . $this->session->UserId . '.jpg')):
	            	$Ava = '/avatar/' . $this->session->Login . $this->session->UserId . '.jpg';
	            else:
	            	$Ava = '/avatar/noava.jpg';
	            endif;
			?>
			
				<td><center><img style="width: 200px; height: 200px;" src="<?=$Ava;?>" alt="..."></center></td>
			</tr>
			<tr>
				<td><input type="file" name="userfile" class="btn btn-success"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Изменить фото" class="btn btn-success"></td>
			</tr>
		</table>
	</form>
		<h3>Балансы</h3>
		<table class="table table-bordered">
		<? foreach($List as $Coin): ?>
			<tr>
				<td>
					<img style="width: 30px;" src="https://www.coinpayments.net/images/coins/<?=$Coin->cAbbr;?>.png" alt="...">
	            </td>   
	             
	            <td> 
	                <i> <?=$Coin->bBalance;?> <?=$Coin->cAbbr;?></i>
	            </td>
				</td>
			</tr>
		<? endforeach; ?>
		</table>
	</div>
	</div>
	<div class="col-lg-7">
	<div class="card-box">
		<table class="table table-bordered">
			<tr>
				<td style="width: 200px">Логин:</td> <td><?=$this->session->Login;?></td>
			</tr>
			<tr>
				<td>E-Mail:</td> <td> <?=$User['uEmail'];?></td>
			</tr>
			<tr>
				<td>Дата регистрации:</td> <td> <?=date("d.m.Y", $User['uDateReg']);?></td>
			</tr>
			<tr>
				<td>ФИО:</td> <td> <?=$User['uFIO'];?></td>
			</tr>
			<tr>
				<td>Страна:</td> <td> <?=$User['uCity'];?></td>
			</tr>
			<tr>
				<td>Город:</td> <td> <?=$User['uCountry'];?></td>
			</tr>
			<tr>
				<td>Skype:</td> <td> <?=$User['uSkype'];?></td>
			</tr>
			<tr>
				<td>Последний вход:</td> <td> <?=date("d.m.Y H:i", $User['uLastLogin']);?></td>
			</tr>
			
			<tr>
				<td>Майнит:</td> <td> <?=$User['uMiner'];?></td>
			</tr>
			
			
		</table>
		<br>
		<h3>Изменение профиля</h3>
		<form method="post" action="">
		<input type="hidden" name="profile_save" value="1" />
			<table class="table table-bordered">
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
		<br>
		<h3>Изменение пароля</h3>
		<form method="post" action="">
		<input type="hidden" name="password_save" value="1" />
			<table class="table table-bordered">
				
				<tr>
					<td>Новый пароль:</td> <td> <input class="form-control" type="text" name="newpass" value=""></td>
				</tr>
				<tr>
					<td>Повтор пароля:</td> <td> <input class="form-control" type="text" name="renewpass" value=""></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Сохранить" class="btn btn-success"></td>
				</tr>
			</table>
		</form>
	</div>
	</div>
</div>