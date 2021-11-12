<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Cloud Mining">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="/tpl/assets/images/favicon.png">

        <!-- App title -->
        <title>bitaltearning.com - Cloud Mining</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="/tpl/assets/plugins/morris/morris.css">

        <!-- Switchery css -->
        <link href="/tpl/assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="/tpl/assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="/tpl/assets/js/modernizr.min.js"></script>
    
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  }
})});
</script>
    </head>


    <body>
<script type="text/javascript" src="//go.oclaserver.com/apu.php?zoneid=1133389"></script>
        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="/" class="logo">
                            <i class="zmdi zmdi-cloud-outline icon-c-logo"></i>
                            <span>bitaltearning</span>
                        </a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav pull-right">

                            <li class="nav-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>

                           <li class="nav-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <font color="#fff">Information</font>
                                    
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                                    

                                    <!-- item-->
                                    <a href="/Dashboard/VoteCoin" class="dropdown-item notify-item">Vote coin</a>
                                    

                                   
                                </div>
                            </li>

                            <li class="nav-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <i class="zmdi zmdi-pin noti-icon"></i>
                                    
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                                    

                                    <!-- item-->
                                    <a href="/Dashboard/SetLang/english" class="dropdown-item notify-item">Engish</a>
                                    <a href="/Dashboard/SetLang/russian" class="dropdown-item notify-item">Russian</a>

                                   
                                </div>
                            </li>

                            

                            <?
								if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/avatar/' . $this->session->Login . $this->session->UserId . '.jpg')):
					            	$Ava = '/avatar/' . $this->session->Login . $this->session->UserId . '.jpg';
					            else:
					            	$Ava = '/avatar/noava.jpg';
					            endif;
							?>

                            <li class="nav-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="<?=$Ava;?>" alt="user" class="img-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="text-overflow"><small>Welcome ! <?=$this->session->Login;?></small> </h5>
                                    </div>
                                    
                                     <!-- item-->
                                    <a href="/Dashboard/Profile" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                    </a>

                                    <!-- item-->
                                    <a href="/Dashboard/LogOut" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-power"></i> <span>Logout</span>
                                    </a>

                                   

                                </div>
                            </li>

                        </ul>

                    </div> <!-- end menu-extras -->
                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->


            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li style="margin-right: -20px;">
                                <a href="/Dashboard"><i class="zmdi zmdi-view-dashboard"></i> <span> Cabinet </span> </a>
                            </li>
                            
                            <li style="margin-right: -20px;">
                                <a href="/Dashboard/Deposit"><i class="zmdi zmdi-balance"></i> <span> Deposit </span> </a>
                            </li>
                            
                            <li style="margin-right: -20px;">
                                <a href="/Dashboard/Withdraw"><i class="zmdi zmdi-balance-wallet"></i> <span> Withdraw </span> </a>
                            </li>
                            
                            <li style="margin-right: -20px;">
                                <a href="/Dashboard/UserCoins"><i class="zmdi zmdi-money-box"></i> <span> Coins </span> </a>
                            </li>
                            
                            <li style="margin-right: -20px;">
                                <a href="/Dashboard/Exchange"><i class="zmdi zmdi-refresh"></i> <span> Exchange </span> </a>
                            </li>
                            
                            <li style="margin-right: -20px;">
                                <a href="/Dashboard/HistoryPayment"><i class="zmdi zmdi-calendar-note"></i> <span> History </span> </a>
                            </li>
                            
                            <li style="margin-right: -20px;">
                                <a href="/Dashboard/Partners"><i class="zmdi zmdi-accounts"></i> <span> Partners </span> </a>
                            </li>
							
							<li style="margin-right: -20px;">
                                <a href="/Dashboard/Promo"><i class="zmdi zmdi-rss"></i> <span> Promo </span> </a>
                            </li>
                            
                            <li style="margin-right: -20px;">
                                <a href="/Dashboard/Ticket"><i class="zmdi zmdi-comments"></i> <span> Ticket </span> </a>
                            </li>
                            
                            <li style="margin-right: -20px;">
                                <a href="/Dashboard/Profile"><i class="zmdi zmdi-settings"></i> <span> Profile </span> </a>
                            </li>
                            

                        </ul>
                        <!-- End navigation menu  -->
                    </div>
                </div>
            </div>
        </header>
        <!-- End Navigation Bar-->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

                <hr/>


                <center><iframe data-aa='467366' src='//ad.a-ads.com/467366?size=468x60' scrolling='no' style='width:468px; height:60px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe></center>
 


               