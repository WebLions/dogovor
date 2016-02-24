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


      <!-- Modal -->
      <div class="modal fade" id="consent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-body">
                      <div class = "content-input-inlane">
                          <p><input type="checkbox" id="yes_consent">Настоящим я даю разрешение web-сервису «Конструктор договоров» получать, систематизировать, накапливать, хранить, уточнять (обновлять, изменять) и иным образом обрабатывать мои персональные данные, размещаемые мною на сайте 74nedvizhimost.ru. Целями обработки персональных данных могут быть:</p>
                          <p>1. Генерация, по моему запросу, текста договора купли-продажи квартиры и предварительного договора купли-продажи квартиры, для использования в моих частных интересах, и не подлежащего распространению в необезличенном виде.</p>
                          <p>2. Обеспечение возможности обратной связи с администрацией сайта 74nedvizhimost.ru. Согласие дается на срок размещения персональных данных на Сайте. Я подтверждаю, что разрешаю web-сервису «Конструктор договоров» направлять мне корреспонденцию на указанный мной адрес электронной почты и\или на указанный мной номер телефона.</p>
                          <p>Я уведомлен (-а), что генерация документов происходит на моем компьютере, а мои персональные данные не будут отправлены на сервера Сайта, и не смогут быть доступны кому-либо.</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>




