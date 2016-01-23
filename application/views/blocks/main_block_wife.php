<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Введите данныe супруги:</p>
            <div class = "content-radio">

                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_surname"  placeholder="Фамилия:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="spouse_name"  placeholder="Имя:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_patronymic"  placeholder="Отчество:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text"  name="spouse_birthday"  placeholder="Дата рождения:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_pass_serial"  placeholder="Серия паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="spouse_pass_number"  placeholder="Номер паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_pass_date"  placeholder="Дата выдачи паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="spouse_pass_bywho"  placeholder="Кем выдан паспорт:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_city"  placeholder="Адрес регистрации(город):">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_street"  placeholder="Адрес регистрации(улица):">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_house"  placeholder="Адрес регистрации(дом):">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_flat"  placeholder="Адрес регистрации(квартира):">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="marriage_svid_serial"  placeholder="Серия свидетельства о браке:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="marriage_svid_number"  placeholder="Номер свидетельства о браке:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="marriage_svid_date"  placeholder="Дата выдачи свидетельства о браке:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="marriage_svid_bywho"  placeholder="Kем выдано свидетельство о браке:">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Размер неустойки по договору</p>
            <div class = "content-radio">
                <div class = "content-input">
                    <input type="radio" name="penalty" value="0,02%">
                    <span class = "content-input-align">0,02%</span>
                </div>

                <div class = "content-input">
                    <input type="radio" name="penalty" value="0,05%">
                    <span class = "content-input-align">0,05%</span>
                </div>

                <div class = "content-input">
                    <input type="radio" name="penalty" value="0,1%">
                    <span class = "content-input-align">0,1%</span>
                </div>



            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class = "content-button">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                Оплатить и скачать
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Спасибо за испольование нашего сервиса.</h4>
                        </div>
                        <div class="modal-body">
                            Для того чтобы скачать документ нужно оплатить сумму в размере 210руб.
                            На указанный вами E-mail прийдет созданный для вас логин и пароль.
                            Скачать документ вы сможете после оплаты.
                            <div class="content-input-group">
                                <input class="form-control" type="text" name="email" id="user-email"  placeholder="E-mail">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="ready_button" type="submit" class="btn btn-success">Готово</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>