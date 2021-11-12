<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="/tpl/assets/images/favicon.png">

        <!-- App title -->
        <title>bitaltearning.com - Облачный майнинг</title>

        <!-- App CSS -->
        <link href="/tpl/assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="/tpl/assets/js/modernizr.min.js"></script>
     

    </head>


    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">

        	<div class="account-bg">
                <div class="card-box m-b-0">
                    <div class="text-xs-center m-t-20">
                        <a href="/" class="logo">
                            <i class="zmdi zmdi-group-work icon-c-logo"></i>
                            <span>bitaltearning</span>
                        </a>
                    </div>
                    <div class="m-t-10 p-20">
                        <div class="row">
                            <div class="col-xs-12 text-xs-center">
                                <h6 class="text-muted text-uppercase m-b-0 m-t-0">Регистрация</h6>
                            </div>
                        </div>
                        <form class="m-t-20" action="<?=base_url();?>Auth/Register" method="post" name="loginform">
                        <input type="hidden" name="a" value="signup">

                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <?=$this->session->flashdata("error");?>
                                </div>
                            </div>
                            
                            
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input class="form-control" type="email" name="email" placeholder="E-Mail">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input class="form-control" type="email" name="email1" placeholder="Повторите E-Mail">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" name="username" placeholder="Логин">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name="password" placeholder="Пароль">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name="password2" placeholder="Повторите пароль">
                                </div>
                            </div>
                            
                            
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <center><? echo $this->session->Capt;?></center>
									<input type="text" class="form-control" name="code" placeholder="Enter validation number">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <div class="checkbox checkbox-custom">
                                        <input name="agree" id="checkbox-signup" type="checkbox">
                                        <label for="checkbox-signup">
                                            Принимаю правила сервиса
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-10">
                                <div class="col-xs-12">
                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Регистрация</button>
                                </div>
                            </div>

                            

                          

                        </form>

                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end card-box-->

            <div class="m-t-20">
                <div class="text-xs-center">
                    <p class="text-white">Есть аккаунт? <a href="/Auth" class="text-white m-l-5"><b>Войти</b></a></p>
                </div>
            </div>

        </div>
        <!-- end wrapper page -->


        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <!-- jQuery  -->
        <script src="/tpl/assets/js/jquery.min.js"></script>
        <script src="/tpl/assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="/tpl/assets/js/bootstrap.min.js"></script>
        <script src="/tpl/assets/js/waves.js"></script>
        <script src="/tpl/assets/js/jquery.nicescroll.js"></script>
        <script src="/tpl/assets/plugins/switchery/switchery.min.js"></script>

        <!-- App js -->
        <script src="/tpl/assets/js/jquery.core.js"></script>
        <script src="/tpl/assets/js/jquery.app.js"></script>

    </body>
</html>







