

        <!-- Basic table -->
        <div class="row">
          <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
              <h4 class="panel-title">Тикет #<?=$this->uri->segment(3);?></h4>
              <?=$this->session->flashdata('errorTicket');?>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table" id="datatables__example">
                    <thead>
                      <tr>
                        <th>Имя</th>
                        <th>Текст</th>
                      </tr>
                    </thead>
                    <tbody>
                    <? foreach($InfoTicket as $Coin): ?>
                      <tr>
                      
                      	<td><?=$Coin->tiLogin;?></td>
                      	<td><?=$Coin->tiText;?></td>
                      	
                      </tr>
                      <? endforeach; ?>
                      
                      
                     
                    </tbody>
                  </table>
                </div>
              </div>
              
		        <div class="row">
					<div class="col-lg-12">
					<center><h4>Быстрый ответ</h4></center>
						<form method="post" action="/Flatpanel/ViewTicket/<?=$this->uri->segment(3);?>" class="form-group">
							<table class="table">
								
								<tr>
									
									<td><textarea rows="8" class="form-control" name="text" placeholder="Текст обращения"></textarea></td>
								</tr>
								
								<tr>
									<td><input type="submit" name="send" value="Отправить" class="btn btn-success"></td>							
								</tr>
							</table>
						</form>
					</div>
				</div>
				
            </div>
          </div>
        </div> <!-- / .row -->
        