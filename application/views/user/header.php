
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
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
              <i class="icon_house_alt"></i>
              <span>Новости</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="document" class="">
              <i class="icon_document_alt"></i>
              <span>Документы</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_desktop"></i>
              <span>Статистика</span>
            </a>

          </li>
          <li>
            <a class="" href="widgets.html">
              <i class="icon_genius"></i>
              <span>Транзакции</span>
            </a>
          </li>

          <li>
            <a class="" href="chart-chartjs.html">
              <i class="icon_piechart"></i>
              <span>Помощь</span>
            </a>
          </li>

          <li class="sub-menu">
            <a href="login" class="">
              <i class="icon_table"></i>
              <span>Выход</span>
            </a>
          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->