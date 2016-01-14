<div class="row">
    <div class="col-lg-12 ">
        <div class = "content-block">

            <div class = "content-input-group">
                <input class = "form-control" type="text" name="place_of_contract"  placeholder="Место заключения договора:">
            </div>

            <div class = "content-input-group">
                <input class="form-control datepicker" data-provide="datepicker"aria-describedby="sizing-addon3" name="date_of_contract"  placeholder="Дата заключения договора:">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Продавец транспортного средства:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">

                    <input type="radio" name="type_of_giver" value="physical">
                    <span class = "content-input-align">Физическое лицо</span>
                </div>
                <div class = "content-radio">

                    <input type="radio" name="type_of_giver" value="law">
                    <span class = "content-input-align">Юридическое лицо</span>

                </div>
                <div class = "content-radio">

                    <input type="radio" name="type_of_giver" value="individual">
                    <span class = "content-input-align">Индивидуальный предприниматель</span>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Введите данныe продавца:</p>
            <div class="content-radio-group">

                <div class = "content-radio">
                    <input type="radio" name="vendor_is_owner_car" value="own_car">
                    <span class = "content-input-align">Продавец является собственником ТС</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="vendor_is_owner_car" value="not_own_car">
                    <span class = "content-input-align">Продавец не является собственником ТС и действует по доверенности</span>
                </div>
            </div>

            <div class = "content-input">
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_surname"  placeholder="Фамилия:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_name"  placeholder="Имя:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_patronymic"  placeholder="Отчество:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text"  name="vendor_birthday"  placeholder="Дата рождения:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_passport_serial"  placeholder="Серия паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_passport_number"  placeholder="Номер паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_passport_date"  placeholder="Дата выдачи паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_passport_bywho"  placeholder="Кем выдан паспорт:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_city"  placeholder="Город (адрес регистрации):">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_street"  placeholder="Улица:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_house"  placeholder="№ Дома:">
                </div>

                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_flat"  placeholder="Квартира:">
                </div>

                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_phone"  placeholder="Телефон:">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class = "content-block" id="buyer">
            <p class = "content-header">Покупатель транспортного средства:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">

                    <input type="radio" name="type_of_taker" value="physical">
                    <span class = "content-input-align">Физическое лицо</span>

                </div>

                <div class = "content-radio">

                    <input type="radio" name="type_of_taker" value="law">
                    <span class = "content-input-align">Юридическое лицо</span>

                </div>

                <div class = "content-radio">

                    <input type="radio" name="type_of_taker" value="individual">
                    <span class = "content-input-align">Индивидуальный предприниматель</span>

                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Введите данныe покупателя:</p>
            <div class = "content-radio">

                <div class = "content-input">
                    <div class = "content-input-group">
                        <input class = "form-control" type="text" name="buyer_surname"  placeholder="Фамилия:">
                    </div>
                    <div class = "content-input-group">
                        <input class="form-control" type="text" name="buyer_name"  placeholder="Имя:">
                    </div>
                    <div class = "content-input-group">
                        <input class = "form-control" type="text" name="buyer_patronymic"  placeholder="Отчество:">
                    </div>
                    <div class = "content-input-group">
                        <input class="form-control" type="text"  name="buyer_birthday"  placeholder="Дата рождения:">
                    </div>
                    <div class = "content-input-group">
                        <input class = "form-control" type="text" name="buyer_passport_serial"  placeholder="Серия паспорта:">
                    </div>
                    <div class = "content-input-group">
                        <input class="form-control" type="text" name="buyer_passport_number"  placeholder="Номер паспорта:">
                    </div>
                    <div class = "content-input-group">
                        <input class = "form-control" type="text" name="buyer_passport_date"  placeholder="Дата выдачи паспорта:">
                    </div>
                    <div class = "content-input-group">
                        <input class="form-control" type="text" name="buyer_passport_bywho"  placeholder="Кем выдан паспорт:">
                    </div>
                    <div class = "content-input-group">
                        <input class = "form-control" type="text" name="buyer_city"  placeholder="Город (адрес регистрации):">
                    </div>
                    <div class = "content-input-group">
                        <input class = "form-control" type="text" name="buyer_street"  placeholder="Улица:">
                    </div>
                    <div class = "content-input-group">
                        <input class = "form-control" type="text" name="buyer_house"  placeholder="№ Дома:">
                    </div>
                    <div class = "content-input-group">
                        <input class = "form-control" type="text" name="buyer_flat"  placeholder="Квартира:">
                    </div>
                    <div class = "content-input-group">
                        <input class="form-control" type="text" name="buyer_phone"  placeholder="Телефон">
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Сведения о траспортном средстве:</p>
            <div class = "content-radio">

                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="mark"  placeholder="Модель,марка:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vin"  placeholder="Идентификационный номер (VIN):">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="reg_gov_number"  placeholder="Государственный регистрационный знак:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text"  name="car_type"  placeholder="Наименование(тип):">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="category"  placeholder="Категория:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="date_of_product"  placeholder="Год изготовления:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="engime_model"  placeholder="Модель, номер двигателя:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="shassi"  placeholder="Номер рамы,шасси:">
                </div><div class = "content-input-group">
                    <input class = "form-control" type="text" name="color_carcass"  placeholder="Цвет кузова,кабины,прицепа:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="other_parametrs"  placeholder="Иные индивидуальные признаки:">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Сведения о паспорте транспортного средства(ПТС):</p>

                <div class = "content-input-group">
                    <input class="form-control" type="text"  name="serial_car"  placeholder="Серия:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="number_of_serial_car"  placeholder="Номер:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="date_of_serial_car"  placeholder="Дата выдачи:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="bywho_serial_car"  placeholder="Кем выдан">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Стоимость транспортного средства по договору:</p>

            <div class = "content-input-group">
                <input class="form-control" type="text"  name="price_car"  placeholder="Стоимость:">
            </div>
            <div class = "content-input-group">
                <input class = "form-control" type="text" name="currency"  placeholder="Валюта:">
            </div>


        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Серийное и дополнительное оборудование, установленное на ТС(Указать?):</p>
            <div class = "content-radio-header">
                <div class = "content-input">

                    <input id = "mods_yes" type="radio" name="additional_devices" value="true">
                    <span class = "content-input-align">Да</span>

                </div>

                <div class = "content-input">

                    <input id = "mods_no"  type="radio" name="additional_devices" value="false">
                    <span class = "content-input-align">Нет</span>

                </div>

            </div>
        </div>
    </div>
</div>