



<div class="row">
	<div class="col-lg-12">
	<div class="card-box">
		<div class="row text-center">
			<a href="/Dashboard/Ticket" class="btn btn-info">Все тикеты</a>
			<hr>
			<?=$this->session->flashdata('errorTicket');?>
		</div>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<div class="row">
			<div class="col-lg-4">
				<ul>
				<li>
						Перед тем как создавать обращение, ознакомьтесь с разделом FAQ<hr>
					</li>
					<li>
						Запрещено использовать не нормативную лексику<hr>
					</li>
					<li>
						Запрещено отправлять сообщения рекламного характера<hr>
					</li>
					<li>
						Обращение должно содержать только вопросы касающиеся проекта<hr>
					</li>
					<li>
						<font color="red">Не соблюдение правил наказывается!!!</font><hr>
					</li>
				</ul>
			</div>
			
			<div class="col-lg-7">
				<form method="post" action="/Dashboard/NewTicket" class="form-group">
					<table class="table">
						<tr>
							<td>Тема обращения:</td>
							<td><input class="form-control" type="text" name="theme" placeholder="Не более 255 символов"></td>
						</tr>
						<tr>
							<td>Текст обращения:</td>
							<td><textarea rows="8" class="form-control" name="text" placeholder="Текст обращения"></textarea></td>
						</tr>
						<tr>
							<td colspan="2"><center><div class="g-recaptcha" data-sitekey="<?=$this->config->item('PublicKeyRecaptcha');?>"></div></center></td>
							
						</tr>
						<tr>
							<td colspan="2"><input type="submit" name="send" value="Отправить" class="btn btn-success"></td>							
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	</div>
	
</div>