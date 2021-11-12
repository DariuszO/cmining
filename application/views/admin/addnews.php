<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
<!-- Basic table -->
        <div class="row">
          <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
              <h4 class="panel-title">Добавить новость</h4>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
<?=$this->session->flashdata('error');?>
	
	<div class="col-lg-12">
	<form method="post" action="">
		<table class="table table-bordered">
			<tr>
				<td style="width: 200px">Тема РУС:</td> <td><input type="text" name="themeru"></td>
			</tr>
			
			<tr>
				<td style="width: 200px">Тема ENG:</td> <td><input type="text" name="themeen"></td>
			</tr>
			
			<tr>
				<td style="width: 200px">Текс РУС:</td> <td><textarea rows="8" cols="60" name="textru"></textarea></td>
			</tr>
			
			<tr>
				<td style="width: 200px">Текс ENG:</td> <td><textarea rows="8" cols="60" name="texten"></textarea></td>
			</tr>
			
			
			
			<tr>
				<td colspan="2"><input type="submit" value="Сохранить" class="btn btn-success"></td>
			</tr>
			</table>
		</form>
		
		
		
		
		

		
		
		
		
		
		
	</div>
 </div>
              </div>
            </div>
          </div>
        </div> <!-- / .row -->