<?php
/**
 * Created by PhpStorm.
 * User: Swarge
* Date: 12/18/2015
* Time: 6:49 PM
*/

function document_type(){

    echo <<END
                  <div class="row">
                      <div class="col-lg-6 col-lg-offset-3">
                          <div class = "content-block">
                                    <p class = "content-header">Выберите тип договора:</p>
                              <div class = "content-radio">
                                  <div class = "content-input">

                                        <input type="radio" name="browser" value="opera">Договор купли-продажи ТС

                                  </div>

                                  <div class = "content-input">

                                        <input type="radio" name="browser" value="opera">Договор дарения ТС

                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

        END;
};