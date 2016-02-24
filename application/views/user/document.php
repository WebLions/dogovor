      <!--main content start-->
      <section>
          <section class="wrapper">            
              <!--overview start-->
              <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <?if(isset($_SESSION['user_id'])){?>
                        <li><i class="fa fa-home"></i><a href="/user/profile">Профиль</a></li>
                        <?}else{?>
                        <li><i class="fa fa-home"></i><a href="/">Главная страница</a></li>
                        <?}?>
                        <li><i class="fa fa-laptop"></i>Создание документа</li>
                    </ol>
                </div>
              </div>
              <div class="row" style="min-height: 625px;">
                  <div class="col-lg-6">
                      <form id="document_form" method="post" action="/document/save">
                      <div class = "document" id="doc_create">
                      <div class = "row" id="block_main">
                          <div class = "col-lg-12">

                      <div class = "content-block" >
                          <p class = "content-header">Выберите тип договора:</p>
                          <div class = "content-radio-header">
                              <div class = "content-input-inlane">

                                  <input data-id="block_main" class="ajax-button" data-name="bs_vendor_block" id = "bs_deal" type="radio" name="type_of_contract" value="buy_sell">
                                  <span class = "content-input-align">Договор купли-продажи ТС</span>


                                  <input data-id="block_main" class="ajax-button" data-name="gift_vendor_block" type="radio" name="type_of_contract" value="gift">
                                  <span class = "content-input-align">Договор дарения ТС</span>

                              </div>
                          </div>
                      </div>
                          </div>
                      </div>
                      </div>
                      </form>

                </div>
                  <div id="sticky-anchor"></div>
                  <div class="col-lg-6" id="sticky">
                      <div class="content-block" style="height: 1000px;">
                          <canvas id="canvas" width="550" height="1000">



                          </canvas>
                      </div>
                  </div>
          </div>
          </section>
      </section>
      <!--main content end-->
  </section>


      <div class="modal fade in" id="consent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      <h4 class="modal-title" id="myModalLabel">Обработка персональнх данных</h4>
                  </div>
                  <div class="modal-body"> <!-- Пофиксиить текст под заказчика-->
                      Настоящим я даю разрешение ООО «Электронный риэлтор» (ОГРН 1127746683789) получать, систематизировать, накапливать, хранить, уточнять (обновлять, изменять) и иным образом обрабатывать мои персональные данные, размещаемые мною на сайте parari.ru.


                      Целями обработки персональных данных могут быть:

                      1. Генерация, по моему запросу, текста договора найма жилого помещения, для использования в моих частных интересах, и не подлежащего распространению в необезличенном виде.

                      2. Обеспечение возможности обратной связи с администрацией сайта parari.ru. Согласие дается на срок размещения персональных данных на Сайте.


                      Я подтверждаю, что разрешаю ООО «Электронный риэлтор» направлять мне корреспонденцию на указанный мной адрес электронной почты и\или на указанный мной номер телефона.


                      Я уведомлен (-а), что после размещения на Сайте персональные данные хранятся в заблокированном виде до прекращения деятельности ООО «Электронный риэлтор» как юридического лица для их возможного анализа на предмет мошенничества Пользователя в отношении третьих лиц. При этом ООО «Электронный риэлтор» не удаляет персональные данные по запросу Пользователя, основываясь на п.5 ст.21 Федерального Закона №152-ФЗ «О персональных данных».
                  </div>
                  <div class="modal-footer">
                      <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                      <button type="button" class="btn btn-primary" id="yes_consent" data-dismiss="modal">Согласен/Согласна</button>
                  </div>
              </div>
          </div>
      </div>




