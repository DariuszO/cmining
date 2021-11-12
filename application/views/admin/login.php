
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="/tpl/admin/assets/ico/favicon.ico">

  <title>Kite: Sign In</title>

  <!-- CSS Plugins -->
  <link rel="stylesheet" href="/tpl/admin/assets/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/tpl/admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css">

  <!-- CSS Global -->
  <link href="/tpl/admin/assets/css/styles.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300,500' rel='stylesheet' type='text/css'>

  </head>

  <body>


    <!-- MAIN CONTENT
    ================================================== -->
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
          
          <!-- Sign In -->
          <div class="sign__container">

            <div class="panel panel-default">

              <div class="panel-heading">
                <h4 class="panel-title">
                  Вход в админпанель
                </h4>
              </div> <!-- / .panel-heading -->

              <div class="panel-body">
              <?=$this->session->flashdata('error');?>
                <form method="post" action="">
                  <div class="form-group">
                    <label for="sign-in__email">Логин</label>
                    <input type="text" name="login" class="form-control" id="sign-in__email">
                  </div>
                  <div class="form-group">
                    <label for="sign-in__password">Пароль</label>
                    <input type="password" name="pass" class="form-control" id="sign-in__password"> 
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="checkbox">
                        
                      </div>
                    </div>
                    <div class="col-sm-6 text-right">
                      <input type="submit" class="btn btn-primary" value="Войти">
                        
                      
                    </div>
                  </div>
                </form>
              </div> <!-- / .panel-body -->

              <div class="panel-footer">
               
                <div class="collapse" id="sign__resend-password">
                 
                </div>
              </div> <!-- / .panel-footer -->

            </div> <!-- / .panel -->

            <p class="sign__extra text-muted text-center">
              Developed <b>WmRush</b> <a href="#">SKYPE: <b>molart111</b></a>.
            </p>

          </div> <!-- / .sign__conteiner -->

        </div>
      </div>
    </div>


    <!-- JavaScript
    ================================================== -->
    
    <!-- JS Global -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/tpl/admin/assets/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- JS Plugins -->
    <script src="/tpl/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    
    <!-- JS Custom -->
    <script src="/tpl/admin/assets/js/custom.js"></script>

  </body>
</html>