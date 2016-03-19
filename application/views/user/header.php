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
    <?php echo link_tag('bootstrap/css/style-responsive.css'); ?>
    <?php echo link_tag('bootstrap/css/style.css'); ?>
    <?php echo link_tag('bootstrap/css/content_style.css'); ?>
    <?php echo link_tag('bootstrap/datepicker/css/datepicker.css'); ?>

  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">


    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips"><i class="icon_menu"></i></div>
      </div>
      <a href="/" class="logo">
        <span style="color:#dc143c;font-family:'cooper black';font-size:29px;"><strong>Cars</strong></span><span style="color:#4169e1;font-family:'cooper black';font-size:29px;"><strong>Doc</strong></span>
      </a>
      <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="/user/profile"><i class="icon_profile"></i> Профиль </a>
              </li>
              <li>
                <a href="/document/create"><i class="icon_mail_alt"></i> Создать </a>
              </li>
              <li>
                <a href="/user/documents"><i class="icon_clock_alt"></i> Документы</a>
              </li>
              <li>
                <a href="/user/payment_history"><i class="icon_chat_alt"></i> Кошелёк </a>
              </li>
              <li>
                <a href="/user/logout"><i class="icon_key_alt"></i> Выход</a>
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
            <a class="" href="/user/profile">
              <i class="glyphicon glyphicon-home"></i>
              <span>Главная</span>
            </a>
          </li>
          <li class="sub-menu" style="background: #DC143C;">
            <a href="/document/create" class="">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Создать документ</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="/user/documents" class="">
              <i class="glyphicon glyphicon-file"></i>
              <span>Документы</span>
            </a>

          </li>
          <li class="sub-menu">
            <a class="" href="/user/payment_history">
              <i class="glyphicon glyphicon-align-justify"></i>
              <span>История</span>
            </a>
          </li>

          <li>
            <a class="" href="/user/subscription">
              <i class="glyphicon glyphicon-usd"></i>
              <span>Подписка</span>
            </a>
          </li>

          <li class="sub-menu">
            <a href="/user/logout" class="">
              <i class="glyphicon glyphicon-log-out"></i>
              <span>Выход</span>
            </a>
          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->