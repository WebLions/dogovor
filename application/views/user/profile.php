

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <!--logo start-->
            <a href="index.html" class="logo">Nice <span class="lite">Admin</span></a>
            <!--logo end-->

            <div class="nav search-row" id="top_menu">
                <!--  search form start -->
                <ul class="nav top-menu">                    
                    <li>
                        <form class="navbar-form">
                            <input class="form-control" placeholder="Search" type="text">
                        </form>
                    </li>                    
                </ul>
                <!--  search form end -->                
            </div>

            <div class="top-nav notification-row">                
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                    
                    <!-- task notificatoin start -->
                    <li id="task_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="icon-task-l"></i>
                            <span class="badge bg-important">0</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            
                            
                        </ul>
                    </li>
                    <!-- task notificatoin end -->
                    <!-- inbox notificatoin start-->
                    <li id="mail_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-envelope-l"></i>
                            <span class="badge bg-important">0</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            
                        </ul>
                    </li>
                    <!-- inbox notificatoin end -->
                    <!-- alert notification start-->
                    <li id="alert_notificatoin_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="icon-bell-l"></i>
                            <span class="badge bg-important">7</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                           
                        </ul>
                    </li>
                    <!-- alert notification end-->
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="img/avatar1_small.jpg">
                            </span>
                            <span class="username">JПользователь</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li class="eborder-top">
                                <a href="#"><i class="icon_profile"></i> Профиль </a>
                            </li>
                            <li>
                                <a href="#"><i class="icon_mail_alt"></i> Почта </a>
                            </li>
                            <li>
                                <a href="#"><i class="icon_clock_alt"></i> Документы</a>
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
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="form_component.html">Form Elements</a></li>                          
                          <li><a class="" href="form_validation.html">Form Validation</a></li>
                      </ul>
                  </li>       
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_desktop"></i>
                          <span>Статистика</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="general.html">Elements</a></li>
                          <li><a class="" href="buttons.html">Buttons</a></li>
                          <li><a class="" href="grids.html">Grids</a></li>
                      </ul>
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
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="basic_table.html">Basic Table</a></li>
                      </ul>
                  </li>
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
              <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Главная страница</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html">Главная страница</a></li>
                        <li><i class="fa fa-laptop"></i>Новости</li>                          
                    </ol>
                </div>
            </div>
              
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box blue-bg">
                        <i class="fa fa-cloud-download"></i>
                        <div class="count">6.674</div>
                        <div class="title">Download</div>                       
                    </div><!--/.info-box-->         
                </div><!--/.col-->
                
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box brown-bg">
                        <i class="fa fa-shopping-cart"></i>
                        <div class="count">7.538</div>
                        <div class="title">Purchased</div>                      
                    </div><!--/.info-box-->         
                </div><!--/.col-->  
                
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box dark-bg">
                        <i class="fa fa-thumbs-o-up"></i>
                        <div class="count">4.362</div>
                        <div class="title">Order</div>                      
                    </div><!--/.info-box-->         
                </div><!--/.col-->
                
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box green-bg">
                        <i class="fa fa-cubes"></i>
                        <div class="count">1.426</div>
                        <div class="title">Stock</div>                      
                    </div><!--/.info-box-->         
                </div><!--/.col-->
                
            </div><!--/.row-->
        
            
           <div class="row">
            <div class="col-lg-9 col-md-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-map-marker red"></i><strong>Countries</strong></h2>
                            <div class="panel-actions">
                                <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                                <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                                <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
                            </div>  
                        </div>
                        <div class="panel-body-map">
                            <div id="map" style="height:380px;"></div>  
                        </div>
    
                    </div>
                </div>
              <div class="col-md-3">
              <!-- List starts -->
                <ul class="today-datas">
                <!-- List #1 -->
                <li>
                  <!-- Graph -->
                  <div><span id="todayspark1" class="spark"></span></div>
                  <!-- Text -->
                  <div class="datas-text">11,500 visitors/day</div>
                </li>
                <li>
                  <div><span id="todayspark2" class="spark"></span></div>
                  <div class="datas-text">15,000 Pageviews</div>
                </li>
                <li>
                  <div><span id="todayspark3" class="spark"></span></div>
                  <div class="datas-text">30.55% Bounce Rate</div>
                </li>
                <li>
                  <div><span id="todayspark4" class="spark"></span></div>
                  <div class="datas-text">$16,00 Revenue/Day</div>
                </li> 
                <li>
                  <div><span id="todayspark5" class="spark"></span></div>
                  <div class="datas-text">12,000000 visitors every Month</div>
                </li>                                                                                                              
              </ul>
              </div>
              
             
           </div>  
            
          
          <!-- Today status end -->
            
              
                
            <div class="row">
                
                <div class="col-lg-9 col-md-12">    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-flag-o red"></i><strong>Registered Users</strong></h2>
                            <div class="panel-actions">
                                <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                                <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                                <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table bootstrap-datatable countries">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Country</th>
                                        <th>Users</th>
                                        <th>Online</th>
                                        <th>Performance</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    <tr>
                                        <td><img src="img/Germany.png" style="height:18px; margin-top:-2px;"></td>
                                        <td>Germany</td>
                                        <td>2563</td>
                                        <td>1025</td>
                                        <td>
                                            <div class="progress thin">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%">
                                                </div>
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100" style="width: 27%">
                                                </div>
                                            </div>
                                            <span class="sr-only">73%</span>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/India.png" style="height:18px; margin-top:-2px;"></td>
                                        <td>India</td>
                                        <td>3652</td>
                                        <td>2563</td>
                                        <td>
                                            <div class="progress thin">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                                </div>
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 43%">
                                                </div>
                                            </div>
                                            <span class="sr-only">57%</span>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/Spain.png" style="height:18px; margin-top:-2px;"></td>
                                        <td>Spain</td>
                                        <td>562</td>
                                        <td>452</td>
                                        <td>
                                            <div class="progress thin">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width: 93%">
                                                </div>
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100" style="width: 7%">
                                                </div>
                                            </div>
                                            <span class="sr-only">93%</span>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/India.png" style="height:18px; margin-top:-2px;"></td>
                                        <td>Russia</td>
                                        <td>1258</td>
                                        <td>958</td>
                                        <td>
                                            <div class="progress thin">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                </div>
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                </div>
                                            </div>
                                            <span class="sr-only">20%</span>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/Spain.png" style="height:18px; margin-top:-2px;"></td>
                                        <td>USA</td>
                                        <td>4856</td>
                                        <td>3621</td>
                                        <td>
                                            <div class="progress thin">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                </div>
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                </div>
                                            </div>
                                            <span class="sr-only">20%</span>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/Germany.png" style="height:18px; margin-top:-2px;"></td>
                                        <td>Brazil</td>
                                        <td>265</td>
                                        <td>102</td>
                                        <td>
                                            <div class="progress thin">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                </div>
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                </div>
                                            </div>
                                            <span class="sr-only">20%</span>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/Germany.png" style="height:18px; margin-top:-2px;"></td>
                                        <td>Coloumbia</td>
                                        <td>265</td>
                                        <td>102</td>
                                        <td>
                                            <div class="progress thin">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                </div>
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                </div>
                                            </div>
                                            <span class="sr-only">20%</span>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/Germany.png" style="height:18px; margin-top:-2px;"></td>
                                        <td>France</td>
                                        <td>265</td>
                                        <td>102</td>
                                        <td>
                                            <div class="progress thin">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                </div>
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                </div>
                                            </div>
                                            <span class="sr-only">20%</span>    
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
    
                    </div>  

                </div><!--/col-->
                <div class="col-md-3">
                    
                    <div class="social-box facebook">
                        <i class="fa fa-facebook"></i>
                        <ul>
                            <li>
                                <strong>256k</strong>
                                <span>friends</span>
                            </li>
                            <li>
                                <strong>359</strong>
                                <span>feeds</span>
                            </li>
                        </ul>
                    </div><!--/social-box-->
                </div>
                <div class="col-md-3">
                    
                    <div class="social-box google-plus">
                        <i class="fa fa-google-plus"></i>
                        <ul>
                            <li>
                                <strong>962</strong>
                                <span>followers</span>
                            </li>
                            <li>
                                <strong>256</strong>
                                <span>circles</span>
                            </li>
                        </ul>
                    </div><!--/social-box-->            
                    
                </div><!--/col-->
                <div class="col-md-3">
                    
                    <div class="social-box twitter">
                        <i class="fa fa-twitter"></i>
                        <ul>
                            <li>
                                <strong>1562k</strong>
                                <span>followers</span>
                            </li>
                            <li>
                                <strong>2562</strong>
                                <span>tweets</span>
                            </li>
                        </ul>
                    </div><!--/social-box-->            
                    
                </div><!--/col-->
                
              </div>

                    
                   
                <!-- statics end -->
              
            
                

              <!-- project team & activity start -->
          <div class="row">
            <div class="col-md-4 portlets">
              <!-- Widget -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Message</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                  <!-- Widget content -->
                  <div class="padd sscroll">
                    
                    <ul class="chats">

                      <!-- Chat by us. Use the class "by-me". -->
                      <li class="by-me">
                        <!-- Use the class "pull-left" in avatar -->
                        <div class="avatar pull-left">
                          <img src="img/user.jpg" alt=""/>
                        </div>

                        <div class="chat-content">
                          <!-- In meta area, first include "name" and then "time" -->
                          <div class="chat-meta">John Smith <span class="pull-right">3 hours ago</span></div>
                          Vivamus diam elit diam, consectetur dapibus adipiscing elit.
                          <div class="clearfix"></div>
                        </div>
                      </li> 

                      <!-- Chat by other. Use the class "by-other". -->
                      <li class="by-other">
                        <!-- Use the class "pull-right" in avatar -->
                        <div class="avatar pull-right">
                          <img src="img/user22.png" alt=""/>
                        </div>

                        <div class="chat-content">
                          <!-- In the chat meta, first include "time" then "name" -->
                          <div class="chat-meta">3 hours ago <span class="pull-right">Jenifer Smith</span></div>
                          Vivamus diam elit diam, consectetur fconsectetur dapibus adipiscing elit.
                          <div class="clearfix"></div>
                        </div>
                      </li>   

                      <li class="by-me">
                        <div class="avatar pull-left">
                          <img src="img/user.jpg" alt=""/>
                        </div>

                        <div class="chat-content">
                          <div class="chat-meta">John Smith <span class="pull-right">4 hours ago</span></div>
                          Vivamus diam elit diam, consectetur fermentum sed dapibus eget, Vivamus consectetur dapibus adipiscing elit.
                          <div class="clearfix"></div>
                        </div>
                      </li>  

                      <li class="by-other">
                        <!-- Use the class "pull-right" in avatar -->
                        <div class="avatar pull-right">
                          <img src="img/user22.png" alt=""/>
                        </div>

                        <div class="chat-content">
                          <!-- In the chat meta, first include "time" then "name" -->
                          <div class="chat-meta">3 hours ago <span class="pull-right">Jenifer Smith</span></div>
                          Vivamus diam elit diam, consectetur fermentum sed dapibus eget, Vivamus consectetur dapibus adipiscing elit.
                          <div class="clearfix"></div>
                        </div>
                      </li>                                                                                  

                    </ul>

                  </div>
                  <!-- Widget footer -->
                  <div class="widget-foot">
                      
                      <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Type your message here...">
                        </div>
                        <button type="submit" class="btn btn-info">Send</button>
                      </form>


                  </div>
                </div>


              </div> 
            </div>

                  <div class="col-lg-8">
                      <!--Project Activity start-->
                      <section class="panel">
                          <div class="panel-body progress-panel">
                            <div class="row">
                              <div class="col-lg-8 task-progress pull-left">
                                  <h1>To Do Everyday</h1>                                  
                              </div>
                              <div class="col-lg-4">
                                <span class="profile-ava pull-right">
                                        <img alt="" class="simple" src="img/avatar1_small.jpg">
                                        Jenifer smith
                                </span>                                
                              </div>
                            </div>
                          </div>
                          <table class="table table-hover personal-task">
                              <tbody>
                              <tr>
                                  <td>Today</td>
                                  <td>
                                      web design
                                  </td>
                                  <td>
                                      <span class="badge bg-important">Upload</span>
                                  </td>
                                  <td>
                                    <span class="profile-ava">
                                        <img alt="" class="simple" src="img/avatar1_small.jpg">
                                    </span>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Yesterday</td>
                                  <td>
                                      Project Design Task
                                  </td>
                                  <td>
                                      <span class="badge bg-success">Task</span>
                                  </td>
                                  <td>
                                      <div id="work-progress2"></div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>21-10-14</td>
                                  <td>
                                      Generate Invoice
                                  </td>
                                  <td>
                                      <span class="badge bg-success">Task</span>
                                  </td>
                                  <td>
                                      <div id="work-progress3"></div>
                                  </td>
                              </tr>                              
                              <tr>
                                  <td>22-10-14</td>
                                  <td>
                                      Project Testing
                                  </td>
                                  <td>
                                      <span class="badge bg-primary">To-Do</span>
                                  </td>
                                  <td>
                                      <span class="profile-ava">
                                        <img alt="" class="simple" src="img/avatar1_small.jpg">
                                      </span>
                                  </td>
                              </tr>
                              <tr>
                                  <td>24-10-14</td>
                                  <td>
                                      Project Release Date
                                  </td>
                                  <td>
                                      <span class="badge bg-info">Milestone</span>
                                  </td>
                                  <td>
                                      <div id="work-progress4"></div>
                                  </td>
                              </tr>                              
                              <tr>
                                  <td>28-10-14</td>
                                  <td>
                                      Project Release Date
                                  </td>
                                  <td>
                                      <span class="badge bg-primary">To-Do</span>
                                  </td>
                                  <td>
                                      <div id="work-progress5"></div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Last week</td>
                                  <td>
                                      Project Release Date
                                  </td>
                                  <td>
                                      <span class="badge bg-primary">To-Do</span>
                                  </td>
                                  <td>
                                      <div id="work-progress1"></div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>last month</td>
                                  <td>
                                      Project Release Date
                                  </td>
                                  <td>
                                      <span class="badge bg-success">To-Do</span>
                                  </td>
                                  <td>
                                      <span class="profile-ava">
                                        <img alt="" class="simple" src="img/avatar1_small.jpg">
                                      </span>
                                  </td>
                              </tr>
                              </tbody>
                          </table>
                      </section>
                      <!--Project Activity end-->
                  </div>
              </div><br><br>
        
        <div class="row">
            <div class="col-md-6 portlets">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h2><strong>Calendar</strong></h2>
                <div class="panel-actions">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                 
                </div><br><br><br>
                <div class="panel-body">
                  <!-- Widget content -->
                  
                    <!-- Below line produces calendar. I am using FullCalendar plugin. -->
                    <div id="calendar"></div>
                  
                </div>
              </div> 
               
            </div>
            
                 <div class="col-md-6 portlets">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-left">Quick Post</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <div class="padd">
                    
                      <div class="form quick-post">
                                      <!-- Edit profile form (not working)-->
                                      <form class="form-horizontal">
                                          <!-- Title -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="title">Title</label>
                                            <div class="col-lg-10"> 
                                              <input type="text" class="form-control" id="title">
                                            </div>
                                          </div>   
                                          <!-- Content -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="content">Content</label>
                                            <div class="col-lg-10">
                                              <textarea class="form-control" id="content"></textarea>
                                            </div>
                                          </div>                           
                                          <!-- Cateogry -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2">Category</label>
                                            <div class="col-lg-10">                               
                                                <select class="form-control">
                                                  <option value="">- Choose Cateogry -</option>
                                                  <option value="1">General</option>
                                                  <option value="2">News</option>
                                                  <option value="3">Media</option>
                                                  <option value="4">Funny</option>
                                                </select>  
                                            </div>
                                          </div>              
                                          <!-- Tags -->
                                          <div class="form-group">
                                            <label class="control-label col-lg-2" for="tags">Tags</label>
                                            <div class="col-lg-10">
                                              <input type="text" class="form-control" id="tags">
                                            </div>
                                          </div>
                                          
                                          <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
                                             <div class="col-lg-offset-2 col-lg-9">
                                                <button type="submit" class="btn btn-primary">Publish</button>
                                                <button type="submit" class="btn btn-danger">Save Draft</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                             </div>
                                          </div>
                                      </form>
                                    </div>
                  

                  </div>
                  <div class="widget-foot">
                    <!-- Footer goes here -->
                  </div>
                </div>
              </div>
              
            </div>
                        
          </div> 
              <!-- project team & activity end -->

          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

    <!-- javascripts -->
