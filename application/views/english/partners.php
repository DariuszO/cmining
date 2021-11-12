
<div class="row">
                    <div class="col-sm-12">
                        
                        <center><h2 class="page-title">My partners</h2></center>
                    </div>
                </div>


<style>
	.blockMine
	{
		border: 1px solid #999595;
		border-radius: 10px;
		display: block;
		padding: 10px 10px;
	}
	
	
	
	.loadersref
	{
		background-image: url(/tpl/img/loading.gif);
		margin: 100px 100px;
		display: none;
	}
</style>


<div id="myModalBox" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Statistics accrued</h4>
      </div>
     
      <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
        <div id="loadersref"></div>
        <div id="loadDataParter"></div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
		<center>
		<div class="row">
		
			<? foreach($List as $Users): ?>
			<?
				if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/avatar/' . $Users->uLogin . $Users->uUid . '.jpg')):
	            	$Ava = '/avatar/' . $Users->uLogin . $Users->uUid . '.jpg';
	            else:
	            	$Ava = '/avatar/noava.jpg';
	            endif;
			?>
				<div class="col-lg-4">
				<div class="card-box">
					<div class="blockMine">
						
							<h4><?=$Users->uLogin;?></h4>
							<div class="table__avatar">
	                            <img src="<?=$Ava;?>" style="width: 100px; height: 100px;">
	                        </div>
	                        <hr>
								Name: <?=$Users->uFIO;?><br/>
							
								Country: <?=$Users->uCity;?><br/>
							
								City: <?=$Users->uCountry;?><br/>
							
								Skype: <font color="#00ACEC"><?=$Users->uSkype;?></font><br/>
							
								Registration date: <?=date("d.m.Yг. в H:i", $Users->uDateReg);?><br/>
								Last visit: <?=date("d.m.Yг. в H:i", $Users->uLastLogin);?><br/>
							<hr>
								<a class="btn btn-info" onclick="ViewHistoryRef('<?=$Users->uUid;?>'); return false;" href="#">History Ref. deductions</a>
							
							
					</div>
					
				</div>
				</div>
				
			<? endforeach; ?>
			
		</div>
		</center>
<div class="row">
<div class="col-lg-12">
	<center>
   		<ul class="pagination">
            <?=$this->pagination->create_links();?>
        </ul>
    </center>
</div>
</div>