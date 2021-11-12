

<div class="row">
	<div class="col-lg-12">
	<div class="card-box">
		<div class="row text-center">
			<a href="/Dashboard/Ticket" class="btn btn-info">All tickets</a>
			<hr>
			<?=$this->session->flashdata('errorTicket');?>
		</div>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<div class="row">
			<div class="col-lg-4">
				<ul>
				<li>
						Before you create a case, see FAQ<hr>
					</li>
					<li>
						Prohibited use not normative lexicon<hr>
					</li>
					<li>
						It is forbidden to send advertising messages<hr>
					</li>
					<li>
						The appeal must contain only questions related to the project<hr>
					</li>
					<li>
						<font color="red">Not following the rules is punished!!!</font><hr>
					</li>
				</ul>
			</div>
			
			<div class="col-lg-7">
				<form method="post" action="/Dashboard/NewTicket" class="form-group">
					<table class="table">
						<tr>
							<td>Topic:</td>
							<td><input class="form-control" type="text" name="theme" placeholder="No more than 255 characters"></td>
						</tr>
						<tr>
							<td>The text of the appeal:</td>
							<td><textarea rows="8" class="form-control" name="text" placeholder="The text of the appeal"></textarea></td>
						</tr>
						<tr>
							<td colspan="2"><center><div class="g-recaptcha" data-sitekey="<?=$this->config->item('PublicKeyRecaptcha');?>"></div></center></td>
							
						</tr>
						<tr>
							<td colspan="2"><input type="submit" name="send" value="Send" class="btn btn-success"></td>							
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	</div>
	
</div>