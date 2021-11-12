

<div class="row">
                    <div class="col-sm-12">
                        
                        <center><h2 class="page-title">Ticket #<?=$this->uri->segment(3);?></h2></center>
                    </div>
                </div>


<div class="row">
	<div class="col-lg-12">
	
		<div class="row text-center">
			<center><a href="/Dashboard/Ticket" class="btn btn-info">All ticket</a></center>
			<hr>
			<?=$this->session->flashdata('errorTicket');?>
		</div>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<div class="row">
			<div class="col-lg-12">
			<div class="card-box">
			
			<div class="timeline">
			<? foreach($List as $Lists): ?>
				<article class="timeline-item <? if($Lists->tiLogin == 'Support') echo 'alt';?>">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow-<? if($Lists->tiLogin == 'Support') echo 'alt';?>"></span>
                                <span class="timeline-icon bg-<? if($Lists->tiLogin == 'Support') echo 'danger'; else echo 'success';?>"><i class="zmdi zmdi-circle"></i></span>
                                <h4 class="text-<? if($Lists->tiLogin == 'Support') echo 'danger'; else echo 'success';?>"><? if($Lists->tiLogin == 'Support') echo '<font color="red">' .$Lists->tiLogin. '</font>'; else echo '<font color="green">' .$Lists->tiLogin. '</font>';?><br><br><?=date("d.m.Y", $Lists->tiDateAdd);?></h4>
                                <p class="timeline-date text-muted"><small><?=date("H:i", $Lists->tiDateAdd);?></small></p>
                                <p><?=$Lists->tiText;?></p>
                            </div>
                        </div>
                    </div>
                </article>
			
			
			
			
				
			<? endforeach; ?>
			
			</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
			<div class="card-box">
			<center><h4>Quick reply</h4></center>
				<form method="post" action="/Dashboard/TicketView/<?=$this->uri->segment(3);?>" class="form-group">
					<table class="table">
						
						<tr>
							
							<td><textarea rows="8" class="form-control" name="text" placeholder="The text of the appeal"></textarea></td>
						</tr>
						<tr>
							<td><center><div class="g-recaptcha" data-sitekey="<?=$this->config->item('PublicKeyRecaptcha');?>"></div></center></td>
							
						</tr>
						<tr>
							<td><input type="submit" name="send" value="Send" class="btn btn-success"></td>							
						</tr>
					</table>
				</form>
			</div>
			</div>
		</div>
	</div>

	
</div>