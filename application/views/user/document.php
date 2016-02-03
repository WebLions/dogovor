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
                      <form method="post" action="/document/go_buy_sale">
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
                      <div class="content-block" style="height: 600px;">
                          <canvas id="canvas" width="550" height="800">
                              <script>



                                  $.getJSON( "/document/data_for_canvas", function( data ) {

                                      $.each( data , function(key , val){

                                          var canvas = document.getElementById("canvas");
                                          var context = canvas.getContext("2d");
                                          var text = val['text'];
                                          context.textBaseline = val['align'] ;
                                          context.font = "13pt "+val['style'];

                                          function wrapText(context, text, marginLeft, marginTop, maxWidth, lineHeight)
                                          {
                                              var words = text.split(" ");
                                              var countWords = words.length;
                                              var line = "";
                                              for (var n = 0; n < countWords; n++) {
                                                  var testLine = line + words[n] + " ";
                                                  var testWidth = context.measureText(testLine).width;
                                                  if (testWidth > maxWidth) {
                                                      context.fillText(line, marginLeft, marginTop);
                                                      line = words[n] + " ";
                                                      marginTop += lineHeight;
                                                  }
                                                  else {
                                                      line = testLine;
                                                  }
                                              }
                                              context.fillText(line, marginLeft, marginTop);
                                          }

                                          var maxWidth = 500; //размер поле, где выводится текст
                                          var lineHeight = 15;
                                          /*если мы знаем высоту текста, то мы можем
                                           предположить, что высота строки должна быть именно такой*/
                                          var marginLeft = 20;
                                          var marginTop = 40;



                                          context.font = " Calibri";
                                          context.fillStyle = "#000";

                                          wrapText(context, text, marginLeft, marginTop, maxWidth, lineHeight);


                                      })

                                  });




                             </script>
                          </canvas>
                      </div>
                  </div>
          </div>
          </section>
      </section>
      <!--main content end-->
  </section>

