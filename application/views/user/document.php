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




