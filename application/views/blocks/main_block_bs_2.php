<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Общее состояние транспортного средства:</p>
            <div class = "content-radio">
                <div class = "content-input">
                    <input type="radio" name="car_allstatus" value="greate">
                    <span class = "content-input-align">Отличное</span>
                </div>

                <div class = "content-input">
                    <input type="radio" name="car_allstatus" value="good">
                    <span class = "content-input-align">Хорошее</span>
                </div>

                <div class = "content-input">
                    <input type="radio" name="car_allstatus" value="passable">
                    <span class = "content-input-align">Удовлетворительное</span>
                </div>

                <div class = "content-input">
                    <input type="radio" name="car_allstatus" value="need_to_fix">
                    <span class = "content-input-align">Не на ходу</span>
                </div>

                <div class = "content-input">
                    <input type="radio" name="car_allstatus" value="after_dtp">
                    <span class = "content-input-align">После ДТП</span>
                </div>

                <div class = "content-input">
                    <input type="radio" name="car_allstatus" value="trash">
                    <span class = "content-input-align">Восстановлению не подлежит</span>
                </div>



            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Последнее техническое обслуживание транспортного средства проведено:</p>

            <div class = "content-input-group">
                <input class="form-control" type="text"  name="maintenance_date"  placeholder="Дата:">
            </div>
            <div class = "content-input-group">
                <input class = "form-control" type="text" name="maintenance_bywho"  placeholder="Кем проведено:">
            </div>



        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class = "content-block" id="defects_block">
            <p class = "content-header">Неустраненные повреждения и эксплуатационные дефекты:</p>
            <div class = "content-radio">
                <div class = "content-input">
                    <input id="defects_yes" type="radio" name="defects" value="true" >
                    <span class = "content-input-align">Есть</span>
                </div>

                <div class = "content-input">
                    <input type="radio" name="defects" value="false">
                    <span class = "content-input-align">Нет</span>
                </div>
            </div>


        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class = "content-block" id="features_block">
            <p class = "content-header">Особенности, которые не влияют на безопасность ТС:</p>
            <div class = "content-radio">
                <div class = "content-input">
                    <input type="radio" name="features" value="true" id="features_true">
                    <span class = "content-input-align">Есть</span>
                </div>

                <div class = "content-input">
                    <input type="radio" name="features" value="false">
                    <span class = "content-input-align">Нет</span>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Сроки оплаты:</p>
            <div class = "content-radio">
                <div class = "content-input">
                    <input type="radio" name="payment_date" value="before">
                    <span class = "content-input-align">До подписания настоящего договора</span>
                </div>

                <div class = "content-input">
                    <input type="radio" name="payment_date" value="after">
                    <span class = "content-input-align">При подписании настоящего договора</span>
                </div>

                <div class = "content-input">
                    <input type="radio" name="payment_date" value="credit">
                    <span class = "content-input-align">В рассрочку по следующему графику:</span>
                </div>



            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class = "content-block content-seller-doc">
            <p class = "content-header">Продавец передает Покупателю следующие документы(Выберите из списка):</p>
            <div class = "content-radio">
                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="svid">
                    <span class = "content-input-align">Свидетельство о регистрации транспортного средства:</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="diagnostic_card">
                    <span class = "content-input-align">Диагностическую карту (талон технического осмотра)</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="garanty">
                    <span class = "content-input-align">Гарантийную (сервисную) книжку</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="instruction">
                    <span class = "content-input-align">Инструкцию (руководство) по эксплуатации транспортного средства</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="garant_talon">
                    <span class = "content-input-align">Гарантийные талоны и инструкции по эксплуатации на дополнительно установленное оборудование</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div id = "seller_tools" class = "content-block">
            <p class = "content-header">Продавец передает Покупателю следующие инструменты и принадлежности:</p>
            <div class = "content-radio">

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="keys">
                    <span class = "content-input-align">Оригинальные ключи в количестве :</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="keys_immob">
                    <span class = "content-input-align">Ключи от иммобилайзера в количестве </span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="spare_wheel">
                    <span class = "content-input-align">Запасное колесо</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="jack">
                    <span class = "content-input-align">Домкрат</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="key_wheel">
                    <span class = "content-input-align">Балонный ключ</span>
                </div>

                <div class = "content-input">
                    <input id = "accessories[]" type="checkbox"  name="accessories">
                    <span class = "content-input-align">Иное:</span>
                </div>

            </div>
        </div>
    </div>
</div

<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Автомобиль приобретен в период брака?</p>
            <div class = "content-radio">
                <div class = "content-input">
                    <input id = "wife_yes" type="radio" name="car_in_marriage" value="true">
                    <span class = "content-input-align">Да</span>
                </div>

                <div class = "content-input">
                    <input id = "wife_no" type="radio" name="car_in_marriage" value="false">
                    <span class = "content-input-align">Нет</span>
                </div>

            </div>



        </div>
    </div>
</div>