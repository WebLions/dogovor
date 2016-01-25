<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Admin panel</title>

    <?php echo link_tag('bootstrap/css/bootstrap.min.css'); ?>    
    <?php echo link_tag('bootstrap/css/bootstrap-theme.css'); ?>
    <?php echo link_tag('bootstrap/css/elegant-icons-style.css'); ?>
    <?php echo link_tag('bootstrap/css/font-awesome.min.css'); ?>
    <?php echo link_tag('bootstrap/css/widgets.css'); ?>
    <?php echo link_tag('bootstrap/css/style-responsive.css'); ?>
    <?php echo link_tag('bootstrap/css/jquery-ui-1.10.4.min.css'); ?>
    <?php echo link_tag('bootstrap/css/jquery-jvectormap-1.2.2.css'); ?>
    <?php echo link_tag('bootstrap/css/style.css'); ?>
    <?php echo link_tag('bootstrap/css/content_style.css'); ?>
    <?php echo link_tag('bootstrap/datepicker/css/datepicker.css'); ?>

  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">


    <header class="header dark-bg">
      <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="#"><i class="icon_profile"></i> Профиль </a>
              </li>
              <li>
                <a href="/document"><i class="icon_mail_alt"></i> Создать </a>
              </li>
              <li>
                <a href="/documents"><i class="icon_clock_alt"></i> Документы</a>
              </li>
              <li>
                <a href="#"><i class="icon_chat_alt"></i> Кошелёк </a>
              </li>
              <li>
                <a href="login.html"><i class="icon_key_alt"></i> Выход</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="profile">
              <i class="glyphicon glyphicon-home"></i>
              <span>Главная</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="document" class="">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Создать</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="documents" class="">
              <i class="glyphicon glyphicon-file"></i>
              <span>Документы</span>
            </a>

          </li>
          <li class="sub-menu">
            <a class="" href="payment_history">
              <i class="glyphicon glyphicon-align-justify"></i>
              <span>История</span>
            </a>
          </li>

          <li>
            <a class="" href="wallet">
              <i class="glyphicon glyphicon-usd"></i>
              <span>Кошелёк</span>
            </a>
          </li>

          <li class="sub-menu">
            <a href="home" class="">
              <i class="glyphicon glyphicon-log-out"></i>
              <span>Выход</span>
            </a>
          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->