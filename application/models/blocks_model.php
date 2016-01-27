<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Blocks_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();//Работа с бд
    }

    public function bs_seller_block()
    {

       echo <<<END
        <div class="row" id="block_deal">
    <div class="col-lg-12 ">
        <div class = "content-block">
            <div class = "content-input-group">
                <input class = "form-control" type="text" name="place_of_contract"  placeholder="Место заключения договора:">
            </div>
            <div class = "content-input-group">
                <input id="date_of_contract" class="form-control datetimepicker"  name="date_of_contract"  placeholder="Дата заключения договора:">
            </div>
        </div>
    </div>
</div>

<div class="row" id="block_seller">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Продавец транспортного средства:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">

                    <input class="ajax-button" data-name="bs_block_physical" type="radio" name="type_of_giver" value="physical">
                    <span class = "content-input-align">Физическое лицо</span>
                </div>
                <div class = "content-radio">

                    <input class="ajax-button" data-name="bs_block_law" type="radio" name="type_of_giver" value="law">
                    <span class = "content-input-align">Юридическое лицо</span>

                </div>
                <div class = "content-radio">

                    <input class="ajax-button" data-name="bs_block_individual" type="radio" name="type_of_giver" value="individual">
                    <span class = "content-input-align">Индивидуальный предприниматель</span>

                </div>
            </div>
        </div>
    </div>
</div>
END;
    }

    public function bs_block_physical()
    {

        echo <<<END
        <div class="row" id="block_seller_info">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Введите данныe продавца:</p>
            <div class="content-radio-group">

                <div class = "content-radio">
                    <input class="ajax-button" data-name="bs_owned_car" type="radio" name="vendor_is_owner_car" value="own_car">
                    <span class = "content-input-align">Продавец является собственником ТС</span>
                </div>

                <div class = "content-radio">
                    <input class="ajax-button" data-name="bs_not_owned_car" type="radio" name="vendor_is_owner_car" value="not_own_car">
                    <span class = "content-input-align">Продавец не является собственником ТС и действует по доверенности</span>
                </div>
            </div>

        </div>
    </div>
</div>
END;
    }

    public function bs_owned_car()
    {

        echo <<<END
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
                <input id="vendor_birthday" class="form-control datetimepicker" type="text"  name="vendor_birthday"  placeholder="Дата рождения:">
                </div>
                <div class = "content-input-group">
                <input class = "form-control" type="text" name="vendor_passport_serial"  placeholder="Серия паспорта:">
                </div>
                <div class = "content-input-group">
                <input class="form-control" type="text" name="vendor_passport_number"  placeholder="Номер паспорта:">
                </div>
                <div class = "content-input-group">
                <input id="vendor_passport_date" class = "form-control datetimepicker" type="text" name="vendor_passport_date"  placeholder="Дата выдачи паспорта:">
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
END;
    }

    public function bs_not_owned_car()
    {

        echo <<<END
                <div class = "content-input">
                <div class = "content-input-group">
                <input class = "form-control" type="text" name="for_agent_vendor_surname"  placeholder="Фамилия:">
                </div>
                <div class = "content-input-group">
                <input class="form-control" type="text" name="for_agent_vendor_name"  placeholder="Имя:">
                </div>
                <div class = "content-input-group">
                <input class = "form-control" type="text" name="for_agent_vendor_patronymic"  placeholder="Отчество:">
                </div>
                <div class = "content-input-group">
                <input class = "form-control" type="text" name="proxy_number"  placeholder="Довереность №:">
                </div>
                <div class = "content-input-group">
                <input id="vendor_birthday" class="form-control datetimepicker" type="text"  name="proxy_date"  placeholder="Дата выдачи:">
                </div>
                <div class = "content-input-group">
                <input class="form-control" type="text" name="proxy_notary"  placeholder="Натариус:">
                </div>
END;
    }

}