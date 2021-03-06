<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="/tpl/admin/assets/ico/favicon.ico">

  <title>Kite: Dashboard</title>

  <!-- CSS Plugins -->
  <link rel="stylesheet" href="/tpl/admin/assets/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/tpl/admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css">

  <!-- CSS Global -->
  <link href="/tpl/admin/assets/css/styles.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300,500' rel='stylesheet' type='text/css'>

  </head>

  <body>

    <div class="wrapper">

      <!-- SIDEBAR
      ================================================== -->
      <div class="sidebar">

        <!-- Close button (mobile devices) -->
        <div class="sidebar__close">
          <img src="/tpl/admin/assets/img/close.svg" alt="Close sidebar">
        </div>
        
        <!-- Sidebar user -->
        <div class="sidebar__user">

          <!-- Sidebar user avatar -->
          <div class="sidebar-user__avatar">
            <img src="/tpl/admin/assets/img/user_1.jpg" alt="...">
          </div>

          <!-- Sidebar user info -->
          <a class="sidebar-user__info">
            <h4>Richard Roe</h4>
            <p>Administrator <i class="fa fa-caret-down"></i></p>
          </a>

        </div>

        <!-- Sidebar user nav -->
        <nav class="sidebar-user__nav">
          <ul class="sidebar__nav">
            <li>
              <a href="profile.html"><i class="fa fa-user"></i> Profile</a>
            </li>
            <li>
              <a href="edit-profile.html"><i class="fa fa-edit"></i> Edit profile</a>
            </li>
            <li>
              <a href="inbox.html"><i class="fa fa-envelope-o"></i> Inbox</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-sign-out"></i> Sign out</a>
            </li>
          </ul>
        </nav>

        <!-- Sidebar nav -->
        <nav>
          <ul class="sidebar__nav">
            <li class="sidebar-nav__heading">Dashboard</li>
            <li>
              <a href="/Flatpanel/index"><i class="fa fa-th-large"></i> ??????????????</a>
            </li>
            <li class="sidebar-nav__heading">????????????</li>
           
            <li>
              <a href="/Flatpanel/Coins"><i class="fa fa-btc"></i> ????????????????????????</a>
            </li>
            <li>
              <a href="/Flatpanel/Users"><i class="fa fa-users"></i> ????????????????????????</a>
            </li>
            <li>
              <a href="/Flatpanel/Tickets"><i class="fa fa-envelope-o"></i> ???????????? (<?=$this->session->CountTicket;?>)</a>
            </li>
            <li>
              <a href="/Flatpanel/CashOutList"><i class="fa fa-money"></i> ?????????????? ???? ??????????</a>
            </li>
            <li>
              <a href="/Flatpanel/CashOutListFull"><i class="fa fa-usd"></i> ???????????????????? ????????????</a>
            </li>
            
            <li>
              <a href="/Flatpanel/InsertListFull"><i class="fa fa-credit-card"></i> ???????????????????? ????????????????????</a>
            </li>
			<li>
              <a href="/Flatpanel/AddNews"><i class="fa fa-credit-card"></i> ???????????????? ??????????????</a>
            </li>
          </ul>
        </nav>

      </div>

      <!-- MAIN CONTENT
      ================================================== -->
      <div class="container-fluid">

        <!-- Navbar -->
        <div class="row">
          <div class="col-xs-12">

            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbar_main">
                  
                  <a href="#" class="btn btn-default navbar-btn navbar-left" id="sidebar__toggle">
                    <i class="fa fa-bars"></i>
                  </a>

                  <form class="navbar-form navbar-left hidden-xs" role="search">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-default">
                          <i class="fa fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>

                  <a href="/Flatpanel/logout" class="btn btn-primary navbar-btn navbar-right">
                    ??????????
                  </a>

                  

                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
            
          </div>
        </div> <!-- / .row -->

        
               <div class="row">
          <div class="col-xs-12">
            
            <h3 class="page-header">
              ?????????????????????? <small>No Razrab</small>
            </h3>

          </div>
        </div> <!-- / .row -->