
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <!-- profile-widget -->
                  <div class="col-lg-12">
                      <div class="profile-widget profile-widget-info">
                          <div class="panel-body">
                              <div class="col-lg-2 col-sm-2">
                                  <h4><?=$user->fio?></h4>
                                  <div class="follow-ava">
                                      <img src="/images/user.png" alt="">
                                  </div>
                                  <!--<h6>Administrator</h6>-->
                              </div>
                              <div class="col-lg-4 col-sm-4 follow-info">
                                  <p><?=$user->about?></p>
                                  <p><?=$user->email?></p>
                                  <h6>
                                      <span><i class="icon_calendar"></i><?=date("Y-m-d")?></span>
                                      <!--<span><i class="icon_clock_alt"></i>МСК<span id="now"></span></span>-->
                                  </h6>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading tab-bg-info">
                              <ul class="nav nav-tabs">
                                  <li class="active">
                                      <a data-toggle="tab" href="#recent-activity">
                                          <i class="icon-home"></i>
                                          Личная статистика
                                      </a>
                                  </li>

                                  <li class="">
                                      <a data-toggle="tab" href="#edit-profile">
                                          <i class="icon-envelope"></i>
                                          Редактировать профиль
                                      </a>
                                  </li>
                              </ul>
                          </header>
                          <div class="panel-body">
                              <div class="tab-content">
                                  <div id="recent-activity" class="tab-pane active" style=" margin-top: 40px;">
                                      <div class="profile-activity">
                                          <div class="row">
                                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                  <div class="info-box blue-bg">
                                                      <i class="fa fa-cloud-download"></i>
                                                      <div class="count"><?=$info['doc_create']?></div>
                                                      <div class="title">Созданно документов</div>
                                                  </div><!--/.info-box-->
                                              </div><!--/.col-->

                                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                  <div class="info-box brown-bg">
                                                      <i class="fa fa-shopping-cart"></i>
                                                      <div class="count"><?=$info['subscribe']?></div>
                                                      <div class="title">Подписка</div>
                                                  </div><!--/.info-box-->
                                              </div><!--/.col-->

                                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                  <div class="info-box dark-bg">
                                                      <i class="fa fa-thumbs-o-up"></i>
                                                      <div class="count"><?=$info['doc_pay']?></div>
                                                      <div class="title">Олаченных документов</div>
                                                  </div><!--/.info-box-->
                                              </div><!--/.col-->

                                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                  <div class="info-box green-bg">
                                                      <i class="fa fa-cubes"></i>
                                                      <div class="count"><?=$info['doc_all']?></div>
                                                      <div class="title">Документов в базе</div>
                                                  </div><!--/.info-box-->
                                              </div><!--/.col-->

                                          </div>

                                      </div>
                                  </div>

                                  <!-- edit-profile -->
                                  <div id="edit-profile" class="tab-pane">
                                      <section class="panel">
                                          <div class="bio-graph-info">
                                              <h1> Данные профиля</h1>
                                              <form class="form-horizontal" role="form" method="post" action="/user/save_profile">
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">ФИО</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" value="<?=$user->fio?>" name="fio" class="form-control" id="f-name" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Обо мне</label>
                                                      <div class="col-lg-10">
                                                          <textarea name="about" value="<?=$user->about?>"  id="" class="form-control" cols="30" rows="5"><?=$user->about?></textarea>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">E-mail</label>
                                                      <div class="col-lg-6">
                                                          <input type="text"  value="<?=$user->email?>" name="email" class="form-control" id="email" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Пароль</label>
                                                      <div class="col-lg-6">
                                                          <input type="password" name="password" class="form-control" id="password" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">
                                                          <button type="submit" class="btn btn-primary">Сохранить</button>
                                                      </div>
                                                  </div>
                                              </form>
                                          </div>
                                      </section>
                                  </div>
                              </div>
                          </div>
                      </section>
                  </div>
              </div>

              <!-- page end-->
          </section>
      </section>

