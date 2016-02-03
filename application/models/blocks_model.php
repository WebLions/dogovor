<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Blocks_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();//Работа с бд
    }

    //Базовые блоки продавца
    public function bs_block_deal()
    {
        echo <<<END
        <div class="row" id="block_deal" data-id="1">
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
END;
    }
    public function bs_block_seller()
    {

        echo <<<END
<div class="row" id="block_seller">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Продавец транспортного средства:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_physical_seller" type="radio" name="type_of_giver" value="physical">
                    <span class = "content-input-align">Физическое лицо</span>
                </div>
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_law_seller" type="radio" name="type_of_giver" value="law">
                    <span class = "content-input-align">Юридическое лицо</span>

                </div>
                <div class = "content-radio">

                    <input class="ajax-button" data-name="bs_block_individual_seller" type="radio" name="type_of_giver" value="individual">
                    <span class = "content-input-align">Индивидуальный предприниматель</span>

                </div>
            </div>
        </div>
    </div>
</div>
END;
    }
    public function bs_block_seller_info()
    {
        echo <<<END
<div class="row" id="block_seller_info">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Статус продавца:</p>
            <div class="content-radio-group">

                <div class = "content-radio">
                    <input data-id="block_seller_info" class="ajax-button" data-block-name="block_seller_info" data-name="bs_owned_car" type="radio" name="vendor_is_owner_car" value="own_car">
                    <span class = "content-input-align">Продавец является собственником ТС</span>
                </div>

                <div class = "content-radio">
                    <input data-id="block_seller_info" class="ajax-button" data-block-name="block_seller_info" data-name="bs_not_owned_car" type="radio" name="vendor_is_owner_car" value="not_own_car">
                    <span class = "content-input-align">Продавец не является собственником ТС и действует по доверенности</span>
                </div>
            </div>

        </div>
    </div>
</div>
END;
    }
    public function bs_block_vendor_info()
    {
        echo <<<END
         <div class="row" id="vendor_info">
            <div class="col-lg-12">
            <div class = "content-block">
             <p class = "content-header">Введите данныe продавца:</p>
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
                </div>
            </div>
        </div>
END;
    }
    public function bs_block_buyer()
    {
        echo <<<END
<div class="row" id="block_buyer">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Покупатель транспортного средства:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_physical_buyer" type="radio" name="type_of_giver" value="physical">
                    <span class = "content-input-align">Физическое лицо</span>
                </div>
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_law_buyer" type="radio" name="type_of_giver" value="law">
                    <span class = "content-input-align">Юридическое лицо</span>

                </div>
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_individual_buyer" type="radio" name="type_of_giver" value="individual">
                    <span class = "content-input-align">Индивидуальный предприниматель</span>

                </div>
            </div>
        </div>
    </div>
</div>
END;
    }
    public function bs_block_buyer_info()
    {
        echo <<<END
        <div class="row" id="block_buyer_info">
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
                    <input id="buyer_birthday" class="form-control datatimepicker" type="text"  name="buyer_birthday"  placeholder="Дата рождения:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_passport_serial"  placeholder="Серия паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_passport_number"  placeholder="Номер паспорта:">
                </div>
                <div class = "content-input-group">
                    <input id="buyer_passport_date" class = "form-control datetimepicker" type="text" name="buyer_passport_date"  placeholder="Дата выдачи паспорта:">
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
</div>
END;
    }
    public function bs_block_ts_info()
    {
        echo <<<END
<div class="row" id="block_ts_info" data-id="7">
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
                    <input id="date_of_product" class="form-control datetimepicker" type="text" name="date_of_product"  placeholder="Год изготовления:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="engime_model"  placeholder="Модель, номер двигателя:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="shassi"  placeholder="Номер рамы,шасси:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="carcass"  placeholder="Кузов(кабина,прицеп):">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="color_carcass"  placeholder="Цвет кузова,кабины,прицепа:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="other_parametrs"  placeholder="Иные индивидуальные признаки:">
                </div>
            </div>
        </div>
    </div>
</div>
END;
    }
    public function bs_block_serial_car()
    {
        echo <<<END
<div class="row" id="block_serial_car" data-id="8">
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
                <input id="date_of_serial_car" class="form-control datetimepicker" type="text" name="date_of_serial_car"  placeholder="Дата выдачи:">
            </div>
            <div class = "content-input-group">
                <input class = "form-control" type="text" name="bywho_serial_car"  placeholder="Кем выдан">
            </div>
        </div>
    </div>
</div>
END;
    }
    public function bs_block_car_price()
    {
        echo <<<END
<div class="row" id="block_car_price" data-id="9">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Стоимость транспортного средства по договору:</p>

            <div style="width:100%"class = "content-input-group">
                   <input style="width:80%;float:left;"class="form-control" type="text"  name="price_car"  placeholder="Стоимость:">
                <select style="width:15%" class="form-control" name="currency">
                    <option value="RUB">RUB</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>


        </div>
    </div>
</div>

END;
    }
    public function bs_block_additional_devices()
    {
        echo <<<END
<div class="row" id="block_additional_devices">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Серийное и дополнительное оборудование, установленное на ТС(Указать?):</p>
            <div class = "content-radio-header">
                <div class = "content-input-inlane">

                    <input data-id="block_additional_devices" class="ajax-button" data-name="bs_additional_devices_yes" id = "mods_yes" type="radio" name="additional_devices" value="true">
                    <span class = "content-input-align">Да</span>

                    <input data-id="block_additional_devices" class="ajax-button" data-name="bs_additional_devices_no" id = "mods_no"  type="radio" name="additional_devices" value="false">
                    <span class = "content-input-align">Нет</span>

                </div>

            </div>
        </div>
    </div>
</div>

END;
    }
    public function bs_block_additional_devices_list()
    {
        echo <<<END
<div class="row" id="block_additional_devices">
    <div class="col-lg-12">
        <div class = "content-block">
            <div class = "content-input-group">
                <input class="form-control" type="text"  name="oil_in_car"  placeholder="Залитое в двигатель масло">
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class = "content-radio-group">

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Левый руль">
                            <span class = "content-input-align">Левый руль</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Правый руль">
                            <span class = "content-input-align">Правый руль</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Бензиновый ДВС">
                            <span class = "content-input-align">Бензиновый ДВС</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Дизельный ДВС">
                            <span class = "content-input-align">Дизельный ДВС</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Газовое оборудование">
                            <span class = "content-input-align">Газовое оборудование</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Турбонаддув">
                            <span class = "content-input-align">Турбонаддув</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Интеркулер">
                            <span class = "content-input-align">Интеркулер</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Карбюратор">
                            <span class = "content-input-align">Карбюратор</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Инжектор">
                            <span class = "content-input-align">Инжектор</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Механическая КПП">
                            <span class = "content-input-align">Механическая КПП</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Автоматическая КПП">
                            <span class = "content-input-align">Автоматическая КПП</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Галогеновые фары">
                            <span class = "content-input-align">Галогеновые фары</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Противотуманные фары">
                            <span class = "content-input-align">Противотуманные фары</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Омыватель фар">
                            <span class = "content-input-align">Омыватель фар</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Противоугонная система штатная">
                            <span class = "content-input-align">Противоугонная система штатная</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Противоугонная система механическая">
                            <span class = "content-input-align">Противоугонная система механическая</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Противоугонная система электронная">
                            <span class = "content-input-align">Противоугонная система электронная</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Центральный замок">
                            <span class = "content-input-align">Центральный замок</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Аудиосистема">
                            <span class = "content-input-align">Аудиосистема</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Антенна наружная">
                            <span class = "content-input-align">Антенна наружная</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Антенна на ветровом стекле">
                            <span class = "content-input-align">Антенна на ветровом стекле</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Электрические стеклоподъемники">
                            <span class = "content-input-align">Электрические стеклоподъемники</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Окрашенные бамперы">
                            <span class = "content-input-align">Окрашенные бамперы</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Накладки окрашенные">
                            <span class = "content-input-align">Накладки окрашенные</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Накладки хромированные">
                            <span class = "content-input-align">Накладки хромированные</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Привод передний">
                            <span class = "content-input-align">Привод передний</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Привод задний">
                            <span class = "content-input-align">Привод задний</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Полный привод">
                            <span class = "content-input-align">Полный привод</span>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class = "content-radio">

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Антиблокировочная тормозная система">
                            <span class = "content-input-align">Антиблокировочная тормозная система</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Гидроусилитель руля">
                            <span class = "content-input-align">Гидроусилитель руля</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Электроусилитель руля">
                            <span class = "content-input-align">Электроусилитель руля</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Регулируемая рулевая колонка">
                            <span class = "content-input-align">Регулируемая рулевая колонка</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Тонированное ветровое стекло">
                            <span class = "content-input-align">Тонированное ветровое стекло</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Тонированные стекла прочие">
                            <span class = "content-input-align">Тонированные стекла прочие</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Диски легкосплавные">
                            <span class = "content-input-align">Диски легкосплавные</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Диски штампованные">
                            <span class = "content-input-align">Диски штампованные</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Корректор фар">
                            <span class = "content-input-align">Корректор фар</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Спойлер передний">
                            <span class = "content-input-align">Спойлер передний</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Спойлер задний">
                            <span class = "content-input-align">Спойлер задний</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Люк механический">
                                <span class = "content-input-align">Люк механический</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Люк с электроприводом">
                            <span class = "content-input-align">Люк с электроприводом</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Люк стеклянный">
                            <span class = "content-input-align">Люк стеклянный</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Люк металлический">
                            <span class = "content-input-align">Люк металлический</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Зеркала с электроприводом">
                            <span class = "content-input-align">Зеркала с электроприводом</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Зеркала с подогревом">
                            <span class = "content-input-align">Зеркала с подогревом</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Салон кожаный">
                            <span class = "content-input-align">Салон кожаный</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Салон велюровый">
                            <span class = "content-input-align">Салон велюровый</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Подогрев сидений">
                            <span class = "content-input-align">Подогрев сидений</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Подушка безопасности водителя">
                            <span class = "content-input-align">Подушка безопасности водителя</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Подушка безопасности пассажира">
                            <span class = "content-input-align">Подушка безопасности пассажира</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Прочие подушки безопасности">
                            <span class = "content-input-align">Прочие подушки безопасности</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Кондиционер">
                            <span class = "content-input-align">Кондиционер</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Климат-контроль">
                            <span class = "content-input-align">Климат-контроль</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Круиз-контроль">
                            <span class = "content-input-align">Круиз-контроль</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Круиз-контроль">
                            <span class = "content-input-align">Круиз-контроль</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" name="additional_devices_array[]" value="Парктроник">
                            <span class = "content-input-align">Парктроник</span>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
END;
    }
    public function bs_block_car_state()
    {
        echo <<<END
<div class="row" id="block_car_state" data-id="12">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Общее состояние транспортного средства:</p>

            <div class = "content-radio-group">
                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="greate">
                    <span class = "content-input-align">Отличное</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="good">
                    <span class = "content-input-align">Хорошее</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="passable">
                    <span class = "content-input-align">Удовлетворительное</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="need_to_fix">
                    <span class = "content-input-align">Не на ходу</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="after_dtp">
                    <span class = "content-input-align">После ДТП</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="trash">
                    <span class = "content-input-align">Восстановлению не подлежит</span>
                </div>
            </div>

        </div>
    </div>
</div>
END;
    }
    public function bs_block_maintenance()
    {
        echo <<<END
<div class="row" id="block_maintenance" data-id="13">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Последнее техническое обслуживание транспортного средства проведено:</p>

            <div class = "content-input-group">
                <input id="maintenance_date" class="form-control datetimepicker" type="text"  name="maintenance_date"  placeholder="Дата:">
            </div>
            <div class = "content-input-group">
                <input class = "form-control" type="text" name="maintenance_bywho"  placeholder="Кем проведено:">
            </div>

        </div>
    </div>
</div>
END;
    }
    public function bs_block_defects()
    {
        echo <<<END
        <div class="row" id="block_defects" data-id="14">
    <div class="col-lg-12">
        <div class = "content-block" id="defects_block">
            <p class = "content-header">Неустраненные повреждения и эксплуатационные дефекты:</p>

            <div class = "content-radio-header">
                <div class = "content-input-inlane">
                    <input id="defects_yes" type="radio" name="defects" value="true">
                    <span class = "content-input-align">Есть</span>

                    <input type="radio" name="defects" value="false">
                    <span class = "content-input-align">Нет</span>
                </div>
            </div>

        </div>
    </div>
</div>
END;
    }
    public function bs_block_features()
    {
        echo <<<END
<div class="row" id="block_features" data-id="15">
    <div class="col-lg-12">
        <div class = "content-block" id="features_block">
            <p class = "content-header">Особенности, которые не влияют на безопасность ТС:</p>

            <div class = "content-radio-header">
                <div class = "content-input-inlane">
                    <input id="features_yes" type="radio" name="features" value="true">
                    <span class = "content-input-align">Есть</span>

                    <input type="radio" name="features" value="false">
                    <span class = "content-input-align">Нет</span>
                </div>
            </div>

        </div>
    </div>
</div>

END;
    }
    public function bs_block_payment_date()
    {
        echo <<<END
<div class="row" id="block_payment_date" data-id="16">
    <div class="col-lg-12">
        <div class = "content-block" id="payment_data">
            <p class = "content-header">Сроки оплаты:</p>
            <div class = "content-radio-group">

                <div class = "content-radio">
                    <input type="radio" name="payment_date" value="before">
                    <span class = "content-input-align">До подписания настоящего договора</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="payment_date" value="after">
                    <span class = "content-input-align">При подписании настоящего договора</span>
                </div>

                <div class = "content-radio">
                    <input id="credit" type="radio" name="payment_date" value="credit">
                    <span class = "content-input-align">В рассрочку по следующему графику:</span>
                </div>

            </div>
        </div>
    </div>
</div>


END;
    }
    public function bs_block_documents()
    {
        echo <<<END
<div class="row" id="documents" data-id="17">
    <div class="col-lg-12">
        <div class = "content-block content-seller-doc">
            <p class = "content-header">Продавец передает Покупателю следующие документы(Выберите из списка):</p>
            <div class = "content-radio-group">

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="Свидетельство о регистрации транспортного средства">
                    <span class = "content-input-align">Свидетельство о регистрации транспортного средства:</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="Диагностическую карту (талон технического осмотра)">
                    <span class = "content-input-align">Диагностическую карту (талон технического осмотра)</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="Гарантийную (сервисную) книжку">
                    <span class = "content-input-align">Гарантийную (сервисную) книжку</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="Инструкцию (руководство) по эксплуатации транспортного средства">
                    <span class = "content-input-align">Инструкцию (руководство) по эксплуатации транспортного средства</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="Гарантийные талоны и инструкции по эксплуатации на дополнительно установленное оборудование">
                    <span class = "content-input-align">Гарантийные талоны и инструкции по эксплуатации на дополнительно установленное оборудование</span>
                </div>

            </div>
        </div>
    </div>
</div>

END;
    }
    public function bs_block_accessories()
    {
        echo <<<END
<div class="row" id="block_accessories_other" data-id="18">
    <div class="col-lg-12">
        <div class = "content-block" id="block_accessories">
            <p class = "content-header">Продавец передает Покупателю следующие инструменты и принадлежности:</p>
            <div class = "content-radio-group">

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="Оригинальные ключи в количестве">
                    <span class = "content-input-align">Оригинальные ключи в количестве :</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="Ключи от иммобилайзера в количестве">
                    <span class = "content-input-align">Ключи от иммобилайзера в количестве </span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="Запасное колесо">
                    <span class = "content-input-align">Запасное колесо</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="Домкрат">
                    <span class = "content-input-align">Домкрат</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="Балонный ключ">
                    <span class = "content-input-align">Балонный ключ</span>
                </div>

                <div class = "content-input">
                    <input type="radio" id="accessories_other">
                    <span class = "content-input-align">Иное:</span>
                </div>

            </div>
        </div>
    </div>
</div>

END;
    }
    public function bs_block_car_in_marriage()
    {
        echo <<<END
<div class="row" id="block_car_in_marriage" data-id="19">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Автомобиль приобретен в период брака?</p>
            <div class = "content-radio-header">

                <div class = "content-input-inlane">
                    <input  class="ajax-button" data-name="bs_wife_true" id = "wife_yes" type="radio" name="car_in_marriage" value="true">
                    <span class = "content-input-align">Да</span>

                    <input  class="ajax-button" data-name="bs_wife_false" id = "wife_no" type="radio" name="car_in_marriage" value="false">
                    <span class = "content-input-align">Нет</span>
                </div>

            </div>
        </div>
    </div>
</div>

END;
    }
    public function bs_block_spounse()
    {
        echo <<<END
<div class="row" id="block_spouse" data-id="20">
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
                    <input id="spouse_birthday" class="form-control datetimepicker" type="text"  name="spouse_birthday"  placeholder="Дата рождения:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_pass_serial"  placeholder="Серия паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="spouse_pass_number"  placeholder="Номер паспорта:">
                </div>
                <div class = "content-input-group">
                    <input id="spouse_pass_date" class = "form-control datetimepicker" type="text" name="spouse_pass_date"  placeholder="Дата выдачи паспорта:">
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
                    <input id="marriage_svid_date" class="form-control datetimepicker" type="text" name="marriage_svid_date"  placeholder="Дата выдачи свидетельства о браке:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="marriage_svid_bywho"  placeholder="Kем выдано свидетельство о браке:">
                </div>

            </div>
        </div>
    </div>
</div>

END;
    }
    public function bs_block_penalty()
    {
        echo <<<END
        <div class="row" id="block_penalty" data-id="21">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Размер неустойки по договору</p>
            <div class = "content-radio-header">

                <div class = "content-input-inlane">
                    <input type="radio" name="penalty" value="0,02%">
                    <span class = "content-input-align">0,02%</span>

                    <input type="radio" name="penalty" value="0,05%">
                    <span class = "content-input-align">0,05%</span>

                    <input type="radio" name="penalty" value="0,1%">
                    <span class = "content-input-align">0,1%</span>
                </div>

            </div>
        </div>
    </div>
</div>
END;
    }
    public function bs_block_ready()
    {
        echo <<<END
<div class="row" id="block_ready">
    <div class="col-lg-12">
        <div class = "content-button">
            <button type="button" id="modal_pay" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                Оплатить и скачать
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            </div>
        </div>
    </div>
</div>
END;

    }




    public function bs_block_individual_seller()
    {

        echo <<<END
         <div class="row" id="block_seller_info">
<div class="col-lg-12">
    <div class = "content-block">
        <p class = "content-header">Введите данныe продавца:</p>
        <div class = "content-radio">

            <div class = "content-input">
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_individual_actor_surname"  placeholder="Фамилия:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="seller_individual_actor_name "  placeholder="Имя:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_individual_actor_patronymic"  placeholder="Отчество:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_individual_company_name"  placeholder="Наименование: ">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="seller_individual_actor_position"  placeholder="В лице: ">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_individual_document_osn"  placeholder="Действующего на основании:">
                </div>
                <div class = "content-input-group">
                    <input id="seller_birthday" class="form-control datatimepicker" type="text"  name="seller_individual_proxy_date"  placeholder="Дата выдачи доверенности:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_individual_proxy_number"  placeholder="Номер доверенности: ">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_inn"  placeholder="Номер паспорта:">
                </div>
                <div class = "content-input-group">
                    <input id="seller_passport_date" class = "form-control" type="text" name="props_ogrn"  placeholder="Дата выдачи паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_inn"  placeholder="ИНН:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_ogrn "  placeholder="ОГРН:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_individual_adress"  placeholder="Юридический адрес: ">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_phone"  placeholder="Телефон:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_bank_acc"  placeholder="Расчетный счет">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_bank_name"  placeholder="Наименование банка:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_korr_acc "  placeholder="Корр.счет:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_bik"  placeholder="БИК:">
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
<div class="row" id="block_seller">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Покупатель транспортного средства:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_physical_buyer" type="radio" name="type_of_giver" value="physical">
                    <span class = "content-input-align">Физическое лицо</span>
                </div>
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_law_buyer" type="radio" name="type_of_giver" value="law">
                    <span class = "content-input-align">Юридическое лицо</span>

                </div>
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_individual_buyer" type="radio" name="type_of_giver" value="individual">
                    <span class = "content-input-align">Индивидуальный предприниматель</span>

                </div>
            </div>
        </div>
    </div>
</div>
END;
    }
    public function bs_block_law_seller()
    {

        echo <<<END
         <div class="row" id="block_seller_info">
<div class="col-lg-12">
    <div class = "content-block">
        <p class = "content-header">Введите данныe продавца:</p>
        <div class = "content-radio">

            <div class = "content-input">
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_law_actor_surname"  placeholder="Фамилия:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="seller_law_actor_name "  placeholder="Имя:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_law_actor_patronymic"  placeholder="Отчество:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_law_company_name"  placeholder="Наименование: ">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="seller_law_actor_position"  placeholder="В лице: ">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_law_document_osn"  placeholder="Действующего на основании:">
                </div>
                <div class = "content-input-group">
                    <input id="seller_birthday" class="form-control datatimepicker" type="text"  name="seller_law_proxy_date"  placeholder="Дата выдачи доверенности:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_law_proxy_number"  placeholder="Номер доверенности: ">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_inn"  placeholder="Номер паспорта:">
                </div>
                <div class = "content-input-group">
                    <input id="seller_passport_date" class = "form-control" type="text" name="props_ogrn"  placeholder="Дата выдачи паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_inn"  placeholder="ИНН:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_ogrn "  placeholder="ОГРН:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_law_adress"  placeholder="Юридический адрес: ">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_phone"  placeholder="Телефон:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_bank_acc"  placeholder="Расчетный счет">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_bank_name"  placeholder="Наименование банка:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_korr_acc "  placeholder="Корр.счет:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_bik"  placeholder="БИК:">
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
<div class="row" id="block_seller">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Покупатель транспортного средства:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_physical_buyer" type="radio" name="type_of_giver" value="physical">
                    <span class = "content-input-align">Физическое лицо</span>
                </div>
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_law_buyer" type="radio" name="type_of_giver" value="law">
                    <span class = "content-input-align">Юридическое лицо</span>

                </div>
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_individual_buyer" type="radio" name="type_of_giver" value="individual">
                    <span class = "content-input-align">Индивидуальный предприниматель</span>

                </div>
            </div>
        </div>
    </div>
</div>
END;
    }

    //Владелец ТС

    public function bs_block_for_agent()
    {

        echo <<<END
        <div class="row" id="for_agent_block">
            <div class="col-lg-12">
            <div class = "content-block">

             <p class = "content-header">Введите данныe довереного лица:</p>
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
                <input class="form-control" type="text" name="proxy_notary"  placeholder="Нотариус:">
                </div>
                </div>

                </div>
             </div>
        </div>
END;
    }

    //Базовые блоки покупателя
    public function bs_block_physical_buyer()
    {

        echo <<<END





END;
    }
    public function bs_block_individual_buyer()
    {

        echo <<<END
        <div class="row" id="block_buyer_info">
<div class="col-lg-12">
    <div class = "content-block">
        <p class = "content-header">Введите данныe покупателя:</p>
        <div class = "content-radio">

            <div class = "content-input">
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_ind_surname"  placeholder="Фамилия:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_ind_name"  placeholder="Имя:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_ ind_patronymic"  placeholder="Отчество:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_ number_of_certificate"  placeholder="Серия паспорта:">
                </div>
                <div class = "content-input-group">
                    <input id="buyer_birthday" class="form-control datatimepicker" type="text"  name="date_of_certificate"  placeholder="Дата рождения:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_passport_serial"  placeholder="Серия паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_passport_number"  placeholder="Номер паспорта:">
                </div>
                <div class = "content-input-group">
                    <input id="buyer_passport_date" class = "form-control datetimepicker" type="text" name="buyer_passport_date"  placeholder="Дата выдачи паспорта:">
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
</div>
<div class="row" id="block_ts_info">
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
                    <input id="date_of_product" class="form-control datetimepicker" type="text" name="date_of_product"  placeholder="Год изготовления:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="engime_model"  placeholder="Модель, номер двигателя:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="shassi"  placeholder="Номер рамы,шасси:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="carcass"  placeholder="Кузов(кабина,прицеп):">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="color_carcass"  placeholder="Цвет кузова,кабины,прицепа:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="other_parametrs"  placeholder="Иные индивидуальные признаки:">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="block_serial_car">
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
                <input id="date_of_serial_car" class="form-control datetimepicker" type="text" name="date_of_serial_car"  placeholder="Дата выдачи:">
            </div>
            <div class = "content-input-group">
                <input class = "form-control" type="text" name="bywho_serial_car"  placeholder="Кем выдан">
            </div>
        </div>
    </div>
</div>
</div>

<div class="row" id="block_car_price">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Стоимость транспортного средства по договору:</p>

            <div style="width:100%"class = "content-input-group">
                   <input style="width:80%;float:left;"class="form-control" type="text"  name="price_car"  placeholder="Стоимость:">
                <select style="width:15%" class="form-control" name="currency">
                    <option value="RUB">RUB</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>


        </div>
    </div>
</div>

<div class="row" id="block_additional_devices" >
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Серийное и дополнительное оборудование, установленное на ТС(Указать?):</p>
            <div class = "content-radio-inline">
                <div class = "content-input-inlane">

                    <input class="ajax-button" data-name="bs_additional_devices_yes" id = "mods_yes" type="radio" name="additional_devices" value="true">
                    <span class = "content-input-align">Да</span>

                    <input class="ajax-button" data-name="bs_additional_devices_no" id = "mods_no"  type="radio" name="additional_devices" value="false">
                    <span class = "content-input-align">Нет</span>

                </div>

            </div>
        </div>
    </div>
</div>

END;
    }
    public function bs_block_law_buyer()
    {

        echo <<<END
        <div class="row" id="block_buyer_info">
<div class="col-lg-12">
    <div class = "content-block">
        <p class = "content-header">Введите данныe покупателя:</p>
        <div class = "content-radio">

            <div class = "content-input">
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_actor_surname"  placeholder="Фамилия:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_law_actor_name "  placeholder="Имя:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_actor_patronymic"  placeholder="Отчество:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_company_name"  placeholder="Наименование: ">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_law_actor_position"  placeholder="В лице: ">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_document_osn"  placeholder="Действующего на основании:">
                </div>
                <div class = "content-input-group">
                    <input id="buyer_birthday" class="form-control datatimepicker" type="text"  name="buyer_law_proxy_date"  placeholder="Дата выдачи доверенности:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_proxy_number"  placeholder="Номер доверенности: ">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_inn"  placeholder="Номер паспорта:">
                </div>
                <div class = "content-input-group">
                    <input id="buyer_passport_date" class = "form-control" type="text" name="props_ogrn"  placeholder="Дата выдачи паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_inn"  placeholder="ИНН:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_ogrn "  placeholder="ОГРН:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_law_adress"  placeholder="Юридический адрес: ">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_phone"  placeholder="Телефон:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_bank_acc"  placeholder="Расчетный счет">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_bank_name"  placeholder="Наименование банка:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_korr_acc "  placeholder="Корр.счет:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_bik"  placeholder="БИК:">
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
<div class="row" id="block_ts_info">
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
                    <input id="date_of_product" class="form-control datetimepicker" type="text" name="date_of_product"  placeholder="Год изготовления:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="engime_model"  placeholder="Модель, номер двигателя:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="shassi"  placeholder="Номер рамы,шасси:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="carcass"  placeholder="Кузов(кабина,прицеп):">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="color_carcass"  placeholder="Цвет кузова,кабины,прицепа:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="other_parametrs"  placeholder="Иные индивидуальные признаки:">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="block_serial_car">
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
                <input id="date_of_serial_car" class="form-control datetimepicker" type="text" name="date_of_serial_car"  placeholder="Дата выдачи:">
            </div>
            <div class = "content-input-group">
                <input class = "form-control" type="text" name="bywho_serial_car"  placeholder="Кем выдан">
            </div>
        </div>
    </div>
</div>
</div>

<div class="row" id="block_car_price">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Стоимость транспортного средства по договору:</p>

            <div style="width:100%"class = "content-input-group">
                   <input style="width:80%;float:left;"class="form-control" type="text"  name="price_car"  placeholder="Стоимость:">
                <select style="width:15%" class="form-control" name="currency">
                    <option value="RUB">RUB</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>


        </div>
    </div>
</div>

<div class="row" id="block_additional_devices" >
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Серийное и дополнительное оборудование, установленное на ТС(Указать?):</p>
            <div class = "content-radio-inline">
                <div class = "content-input-inlane">

                    <input class="ajax-button" data-name="bs_additional_devices_yes" id = "mods_yes" type="radio" name="additional_devices" value="true">
                    <span class = "content-input-align">Да</span>

                    <input class="ajax-button" data-name="bs_additional_devices_no" id = "mods_no"  type="radio" name="additional_devices" value="false">
                    <span class = "content-input-align">Нет</span>

                </div>

            </div>
        </div>
    </div>
</div>

END;
    }




    //Дополнительные устройства

    public function bs_additional_devices_no()
    {
        echo <<<END
<div class="row" id="block_car_state" data-id="12">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Общее состояние транспортного средства:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="greate">
                    <span class = "content-input-align">Отличное</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="good">
                    <span class = "content-input-align">Хорошее</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="passable">
                    <span class = "content-input-align">Удовлетворительное</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="need_to_fix">
                    <span class = "content-input-align">Не на ходу</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="after_dtp">
                    <span class = "content-input-align">После ДТП</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="trash">
                    <span class = "content-input-align">Восстановлению не подлежит</span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row" id="block_maintenance" data-id="13">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Последнее техническое обслуживание транспортного средства проведено:</p>

            <div class = "content-input-group">
                <input id="maintenance_date" class="form-control datetimepicker" type="text"  name="maintenance_date"  placeholder="Дата:">
            </div>
            <div class = "content-input-group">
                <input class = "form-control" type="text" name="maintenance_bywho"  placeholder="Кем проведено:">
            </div>
        </div>
    </div>
</div>

<div class="row" id="block_defects" data-id="14">
    <div class="col-lg-12">
        <div class = "content-block" id="defects_block">
            <p class = "content-header">Неустраненные повреждения и эксплуатационные дефекты:</p>
            <div class = "content-radio-header">
                <div class = "content-input-inlane">
                    <input id="defects_yes" type="radio" name="defects" value="true">
                    <span class = "content-input-align">Есть</span>

                    <input type="radio" name="defects" value="false">
                    <span class = "content-input-align">Нет</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="block_features" data-id="15">
    <div class="col-lg-12">
        <div class = "content-block" id="features_block">
            <p class = "content-header">Особенности, которые не влияют на безопасность ТС:</p>
            <div class = "content-radio-header">
                <div class = "content-input-inlane">
                    <input id="features_yes" type="radio" name="features" value="true">
                    <span class = "content-input-align">Есть</span>

                    <input type="radio" name="features" value="false">
                    <span class = "content-input-align">Нет</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="block_payment_date" data-id="16">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Сроки оплаты:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">
                    <input type="radio" name="payment_date" value="before">
                    <span class = "content-input-align">До подписания настоящего договора</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="payment_date" value="after">
                    <span class = "content-input-align">При подписании настоящего договора</span>
                </div>

                <div class = "content-radio">
                    <input id="credit" type="radio" name="payment_date" value="credit">
                    <span class = "content-input-align">В рассрочку по следующему графику:</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="documents" data-id="17">
    <div class="col-lg-12">
        <div class = "content-block content-seller-doc">
            <p class = "content-header">Продавец передает Покупателю следующие документы(Выберите из списка):</p>
            <div class = "content-radio-group">
                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="Свидетельство о регистрации транспортного средства">
                    <span class = "content-input-align">Свидетельство о регистрации транспортного средства:</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="Диагностическую карту (талон технического осмотра)">
                    <span class = "content-input-align">Диагностическую карту (талон технического осмотра)</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="Гарантийную (сервисную) книжку">
                    <span class = "content-input-align">Гарантийную (сервисную) книжку</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="Инструкцию (руководство) по эксплуатации транспортного средства">
                    <span class = "content-input-align">Инструкцию (руководство) по эксплуатации транспортного средства</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="documents[]" value="Гарантийные талоны и инструкции по эксплуатации на дополнительно установленное оборудование">
                    <span class = "content-input-align">Гарантийные талоны и инструкции по эксплуатации на дополнительно установленное оборудование</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="block_accessories" data-id="18">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Продавец передает Покупателю следующие инструменты и принадлежности:</p>
            <div class = "content-radio-group">

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="Оригинальные ключи в количестве">
                    <span class = "content-input-align">Оригинальные ключи в количестве :</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="Ключи от иммобилайзера в количестве">
                    <span class = "content-input-align">Ключи от иммобилайзера в количестве </span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="Запасное колесо">
                    <span class = "content-input-align">Запасное колесо</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="Домкрат">
                    <span class = "content-input-align">Домкрат</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="Балонный ключ">
                    <span class = "content-input-align">Балонный ключ</span>
                </div>

                <div class = "content-input">
                    <input type="checkbox" name="accessories[]" value="Нет">
                    <span class = "content-input-align">Иное:</span>
                </div>
            </div>
        </div>
    </div>
</div

<div class="row" id="block_car_in_marriage" data-id="19">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Автомобиль приобретен в период брака?</p>
            <div class = "content-radio-header">
                <div class = "content-input-inlane">
                    <input data-id="block_car_in_marriage" class="ajax-button" data-name="bs_wife_true" id = "wife_yes" type="radio" name="car_in_marriage" value="true">
                    <span class = "content-input-align">Да</span>

                    <input data-id="block_car_in_marriage" class="ajax-button" data-name="bs_wife_false" id = "wife_no" type="radio" name="car_in_marriage" value="false">
                    <span class = "content-input-align">Нет</span>
                </div>

            </div>
        </div>
    </div>
</div>


END;
    }

    //Блоки жены
    public function bs_wife_true()
    {
        echo <<<END





<div class="row" id="block_ready">
    <div class="col-lg-12">
        <div class = "content-button">
            <button type="button" id="modal_pay" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                Оплатить и скачать
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            </div>
        </div>
    </div>
</div>

END;
    }
    public function bs_wife_false()
    {
        echo <<<END
        <div class="row" id="block_car_in_marriage" data-id="19">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Автомобиль приобретен в период брака?</p>
            <div class = "content-radio-header">

                <div class = "content-input-inlane">
                    <input class="ajax-button" data-name="bs_wife_true" id = "wife_yes" type="radio" name="car_in_marriage" value="true" >
                    <span class = "content-input-align">Да</span>

                    <input  class="ajax-button" data-name="bs_wife_false" id = "wife_no" type="radio" name="car_in_marriage" value="false" checked>
                    <span class = "content-input-align">Нет</span>
                </div>

            </div>
        </div>
    </div>
</div>

        <div class="row" id="block_penalty" data-id="21">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Размер неустойки по договору</p>
            <div class = "content-radio-header">
                <div class = "content-input-inlane">
                    <input type="radio" name="penalty" value="0,02%">
                    <span class = "content-input-align">0,02%</span>

                    <input type="radio" name="penalty" value="0,05%">
                    <span class = "content-input-align">0,05%</span>

                    <input type="radio" name="penalty" value="0,1%">
                    <span class = "content-input-align">0,1%</span>
                </div>
            </div>
        </div>
    </div>
</div>



END;
    }


    //Дарение ТС
    public function gift_seller_block()
    {

        echo <<<END
<div class="row" id="block_deal" data-id="1">
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

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_physical_seller" type="radio" name="type_of_giver" value="physical">
                    <span class = "content-input-align">Физическое лицо</span>
                </div>
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_law_seller" type="radio" name="type_of_giver" value="law">
                    <span class = "content-input-align">Юридическое лицо</span>

                </div>
                <div class = "content-radio">

                    <input class="ajax-button" data-name="bs_block_individual_seller" type="radio" name="type_of_giver" value="individual">
                    <span class = "content-input-align">Индивидуальный предприниматель</span>

                </div>
            </div>
        </div>
    </div>
</div>
END;
    }
    public function gift_block_physical_seller()
    {

        echo <<<END
        <div class="row" id="block_seller_info">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Статус продавца:</p>
            <div class="content-radio-group">

                <div class = "content-radio">
                    <input data-id="block_seller_info" class="ajax-button" data-block-name="block_seller_info" data-name="bs_owned_car" type="radio" name="vendor_is_owner_car" value="own_car">
                    <span class = "content-input-align">Продавец является собственником ТС</span>
                </div>

                <div class = "content-radio">
                    <input data-id="block_seller_info" class="ajax-button" data-block-name="block_seller_info" data-name="bs_not_owned_car" type="radio" name="vendor_is_owner_car" value="not_own_car">
                    <span class = "content-input-align">Продавец не является собственником ТС и действует по доверенности</span>
                </div>
            </div>

        </div>
    </div>
</div>
END;
    }
    public function gift_block_individual_seller()
    {

        echo <<<END
         <div class="row" id="block_seller_info">
<div class="col-lg-12">
    <div class = "content-block">
        <p class = "content-header">Введите данныe продавца:</p>
        <div class = "content-radio">

            <div class = "content-input">
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_individual_actor_surname"  placeholder="Фамилия:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="seller_individual_actor_name "  placeholder="Имя:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_individual_actor_patronymic"  placeholder="Отчество:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_individual_company_name"  placeholder="Наименование: ">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="seller_individual_actor_position"  placeholder="В лице: ">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_individual_document_osn"  placeholder="Действующего на основании:">
                </div>
                <div class = "content-input-group">
                    <input id="seller_birthday" class="form-control datatimepicker" type="text"  name="seller_individual_proxy_date"  placeholder="Дата выдачи доверенности:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_individual_proxy_number"  placeholder="Номер доверенности: ">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_inn"  placeholder="Номер паспорта:">
                </div>
                <div class = "content-input-group">
                    <input id="seller_passport_date" class = "form-control" type="text" name="props_ogrn"  placeholder="Дата выдачи паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_inn"  placeholder="ИНН:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_ogrn "  placeholder="ОГРН:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_individual_adress"  placeholder="Юридический адрес: ">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_phone"  placeholder="Телефон:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_bank_acc"  placeholder="Расчетный счет">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_bank_name"  placeholder="Наименование банка:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_korr_acc "  placeholder="Корр.счет:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_bik"  placeholder="БИК:">
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
<div class="row" id="block_seller">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Покупатель транспортного средства:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_physical_buyer" type="radio" name="type_of_giver" value="physical">
                    <span class = "content-input-align">Физическое лицо</span>
                </div>
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_law_buyer" type="radio" name="type_of_giver" value="law">
                    <span class = "content-input-align">Юридическое лицо</span>

                </div>
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_individual_buyer" type="radio" name="type_of_giver" value="individual">
                    <span class = "content-input-align">Индивидуальный предприниматель</span>

                </div>
            </div>
        </div>
    </div>
</div>
END;
    }
    public function gift_block_law_seller()
    {

        echo <<<END
         <div class="row" id="block_seller_info">
<div class="col-lg-12">
    <div class = "content-block">
        <p class = "content-header">Введите данныe продавца:</p>
        <div class = "content-radio">

            <div class = "content-input">
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_law_actor_surname"  placeholder="Фамилия:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="seller_law_actor_name "  placeholder="Имя:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_law_actor_patronymic"  placeholder="Отчество:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_law_company_name"  placeholder="Наименование: ">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="seller_law_actor_position"  placeholder="В лице: ">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_law_document_osn"  placeholder="Действующего на основании:">
                </div>
                <div class = "content-input-group">
                    <input id="seller_birthday" class="form-control datatimepicker" type="text"  name="seller_law_proxy_date"  placeholder="Дата выдачи доверенности:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="seller_law_proxy_number"  placeholder="Номер доверенности: ">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_inn"  placeholder="Номер паспорта:">
                </div>
                <div class = "content-input-group">
                    <input id="seller_passport_date" class = "form-control" type="text" name="props_ogrn"  placeholder="Дата выдачи паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_inn"  placeholder="ИНН:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_ogrn "  placeholder="ОГРН:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_law_adress"  placeholder="Юридический адрес: ">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_phone"  placeholder="Телефон:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_bank_acc"  placeholder="Расчетный счет">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_bank_name"  placeholder="Наименование банка:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="props_korr_acc "  placeholder="Корр.счет:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="props_bik"  placeholder="БИК:">
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
<div class="row" id="block_seller">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Покупатель транспортного средства:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_physical_buyer" type="radio" name="type_of_giver" value="physical">
                    <span class = "content-input-align">Физическое лицо</span>
                </div>
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_law_buyer" type="radio" name="type_of_giver" value="law">
                    <span class = "content-input-align">Юридическое лицо</span>

                </div>
                <div class = "content-radio">

                    <input data-id="block_seller" class="ajax-button" data-name="bs_block_individual_buyer" type="radio" name="type_of_giver" value="individual">
                    <span class = "content-input-align">Индивидуальный предприниматель</span>

                </div>
            </div>
        </div>
    </div>
</div>
END;
    }

}



