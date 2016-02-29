<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //блок адреса и даты заключения
    public function bs_block_deal($d)
    {
        $this->db->select("buy_sale.place_of_contract, buy_sale.date_of_contract");
        $this->db->join("documents","documents.doc_id=buy_sale.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale",1,0)->row();

        echo <<<END
<div class="row">
    <div class="col-lg-12 ">
        <div class = "content-block">
            <div class = "content-input-group">
                <input class = "form-control" type="text" name="place_of_contract" value="{$query->place_of_contract}"  placeholder="Место заключения договора:">
            </div>
            <div class = "content-input-group">
                <input id="date_of_contract" class="form-control datetimepicker"  value="{$query->date_of_contract}" name="date_of_contract"  placeholder="Дата заключения договора:">
            </div>
        </div>
    </div>
</div>
END;
    }
    //блок типа продавца
    public function bs_vendor($d)
    {
        $this->db->select("bs.type_of_giver");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        $type = $query->type_of_giver;
        $v[] = ($type=='physical')?'checked':'';
        $v[] = ($type=='law')?'checked':'';
        $v[] = ($type=='individual')?'checked':'';
        echo <<<END
<div class="row" id="block_buyer">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Продавец транспортного средства:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">
                    <input data-id="block_seller" class="edit-ajax-button" data-name="bs_block_vendor_state" type="radio" name="type_of_giver" value="physical" {$v[0]}>
                    <span class = "content-input-align">Физическое лицо</span>
                </div>
                <div class = "content-radio">
                    <input data-id="block_seller" class="edit-ajax-button" data-name="bs_block_vendor_state" type="radio" name="type_of_giver" value="law" {$v[1]}>
                    <span class = "content-input-align">Юридическое лицо</span>
                </div>
                <div class = "content-radio">
                    <input data-id="block_seller" class="edit-ajax-button" data-name="bs_block_vendor_state"" type="radio" name="type_of_giver" value="individual" {$v[2]}>
                    <span class = "content-input-align">Индивидуальный предприниматель</span>
                </div>
            </div>
        </div>
    </div>
</div>
END;
        $this->bs_block_vendor_state($d);
        switch ($type) {
            case 'physical': $this->bs_block_vendor_info($d); break;
            case 'law': $this->bs_block_vendor_law_state($d); break;
            case 'individual': $this->bs_block_vendor_individual_state($d); break;
        }
    }
    //блок (собственник или представитель)
    public function bs_block_vendor_state($d)
    {
        $this->db->select("bs.vendor_is_owner_car");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        $type = $query->vendor_is_owner_car;
        $v[] = ($type=='own_car')?'checked':'';
        $v[] = ($type=='not_own_car')?'checked':'';
        echo <<<END
<div class="row" id="block_seller_info">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Статус продавца:</p>
            <div class="content-radio-group">
                <div class = "content-radio">
                    <input data-id="block_seller_info" class="edit-ajax-button" data-block-name="block_vendor_selected_owner" data-name="bs_block_vendor_selected_owner" type="radio" name="vendor_is_owner_car" value="own_car" {$v[0]}>
                    <span class = "content-input-align">Продавец является собственником ТС</span>
                </div>
                <div class = "content-radio">
                    <input data-id="block_seller_info" class="edit-ajax-button" data-block-name="block_vendor_selected_not_owner" data-name="bs_block_vendor_selected_not_owner" type="radio" name="vendor_is_owner_car" value="not_own_car" {$v[1]}>
                    <span class = "content-input-align">Продавец не является собственником ТС и действует по доверенности</span>
                </div>
            </div>
        </div>
    </div>
</div>
END;
    if($type=='not_own_car'){
        $this->bs_block_vendor_agent($d);
    }

    }
    //блок представителя продавца
    public function bs_block_vendor_agent($d)
    {
        $this->db->select("bs.for_agent_vendor_surname,
                            bs.for_agent_vendor_name,
                            bs.for_agent_vendor_patronymic,
                            bs.for_agent_vendor_proxy_date,
                            bs.for_agent_vendor_proxy_number,
                            bs.for_agent_vendor_proxy_notary");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        echo <<<END
<div class="row" id="for_agent_vendor_info">
    <div class="col-lg-12">
        <div class = "content-block">
             <p class = "content-header">Введите данныe предствителя:</p>
             <div class = "content-input">
                 <div class = "content-input-group">
                    <input class = "form-control" type="text" name="for_agent_vendor_surname"  placeholder="Фамилия:" value="{$query->for_agent_vendor_surname}">
                 </div>
                 <div class = "content-input-group">
                    <input class="form-control" type="text" name="for_agent_vendor_name"  placeholder="Имя:" value="{$query->for_agent_vendor_name}">
                 </div>
                 <div class = "content-input-group">
                    <input class = "form-control" type="text" name="for_agent_vendor_patronymic"  placeholder="Отчество:" value="{$query->for_agent_vendor_patronymic}">
                 </div>
                 <div class = "content-input-group">
                    <input id="vendor_birthday" class="form-control datetimepicker" type="text"  name="for_agent_vendor_proxy_date"  placeholder="Дата выдачи:" value="{$query->for_agent_vendor_proxy_date}">
                 </div>
                 <div class = "content-input-group">
                    <input class = "form-control" type="text" name="for_agent_vendor_proxy_number"  placeholder="Серия паспорта:" value="{$query->for_agent_vendor_proxy_number}">
                 </div>
                 <div class = "content-input-group">
                    <input class="form-control" type="text" name="for_agent_vendor_proxy_notary"  placeholder="Номер паспорта:" value="{$query->for_agent_vendor_proxy_notary}">
                 </div>
             </div>
        </div>
    </div>
</div>
END;
    }
    //блок информции о физ.продавце
    public function bs_block_vendor_info($d)
    {
        $this->db->select("bs.vendor_surname,
                           bs.vendor_name,
                           bs.vendor_patronymic,
                           bs.vendor_birthday,
                           bs.vendor_passport_serial,
                           bs.vendor_passport_number,
                           bs.vendor_passport_date,
                           bs.vendor_passport_bywho,
                           bs.vendor_city,
                           bs.vendor_street,
                           bs.vendor_house,
                           bs.vendor_flat,
                           bs.vendor_phone
                           ");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        echo <<<END
         <div class="row" id="vendor_info">
            <div class="col-lg-12">
            <div class = "content-block">
             <p class = "content-header">Введите данныe продавца:</p>
                <div class = "content-input">
                <div class = "content-input-group">
                <input class = "form-control" type="text" name="vendor_surname"  placeholder="Фамилия:" value="{$query->vendor_surname}">
                </div>
                <div class = "content-input-group">
                <input class="form-control" type="text" name="vendor_name"  placeholder="Имя:" value="{$query->vendor_name}">
                </div>
                <div class = "content-input-group">
                <input class = "form-control" type="text" name="vendor_patronymic"  placeholder="Отчество:" value="{$query->vendor_patronymic}">
                </div>
                <div class = "content-input-group">
                <input id="vendor_birthday" class="form-control datetimepicker" type="text"  name="vendor_birthday"  placeholder="Дата рождения:" value="{$query->vendor_birthday}">
                </div>
                <div class = "content-input-group">
                <input class = "form-control" type="text" name="vendor_passport_serial"  placeholder="Серия паспорта:" value="{$query->vendor_passport_serial}">
                </div>
                <div class = "content-input-group">
                <input class="form-control" type="text" name="vendor_passport_number"  placeholder="Номер паспорта:" value="{$query->vendor_passport_number}">
                </div>
                <div class = "content-input-group">
                <input id="vendor_passport_date" class = "form-control datetimepicker" type="text" name="vendor_passport_date"  placeholder="Дата выдачи паспорта:"  value="{$query->vendor_passport_date}">
                </div>
                <div class = "content-input-group">
                <input class="form-control" type="text" name="vendor_passport_bywho"  placeholder="Кем выдан паспорт:" value="{$query->vendor_passport_bywho}">
                </div>
                <div class = "content-input-group">
                <input class = "form-control" type="text" name="vendor_city"  placeholder="Город (адрес регистрации):" value="{$query->vendor_city}">
                </div>
                <div class = "content-input-group">
                <input class = "form-control" type="text" name="vendor_street"  placeholder="Улица:" value="{$query->vendor_street}">
                </div>
                <div class = "content-input-group">
                <input class = "form-control" type="text" name="vendor_house"  placeholder="№ Дома:" value="{$query->vendor_house}">
                </div>
                <div class = "content-input-group">
                <input class = "form-control" type="text" name="vendor_flat"  placeholder="Квартира:" value="{$query->vendor_flat}">
                </div>
                <div class = "content-input-group">
                <input class="form-control" type="text" name="vendor_phone"  placeholder="Телефон:" value="{$query->vendor_phone}">
                </div>
                </div>
                </div>
            </div>
        </div>
END;
    }
    //блок инфо о ид. лице
    public function bs_block_vendor_individual_state($d)
    {
        $this->db->select("bs.vendor_individual_actor_surname
                           bs.vendor_individual_actor_name
                           bs.vendor_individual_actor_patronymic
                           bs.vendor_individual_company_name
                           bs.vendor_individual_actor_position
                           bs.vendor_individual_document_osn
                           bs.vendor_individual_proxy_date
                           bs.vendor_individual_proxy_number
                           bs.vendor_props_inn
                           bs.vendor_props_ogrn
                           bs.vendor_props_inn
                           bs.vendor_props_ogrn
                           bs.vendor_props_individual_adress
                           bs.vendor_props_phone
                           bs.vendor_props_bank_acc
                           bs.vendor_props_bank_name
                           bs.vendor_props_korr_acc
                           bs.vendor_props_bik
                           ");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();

        echo <<<END
<div class="row" id="block_seller_info">
<div class="col-lg-12">
    <div class = "content-block">
        <p class = "content-header">Введите данныe продавца:</p>
        <div class = "content-radio">

            <div class = "content-input">
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_individual_actor_surname"  placeholder="Фамилия:" value="{$query->vendor_phone}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_individual_actor_name"  placeholder="Имя:" value="{$query->vendor_individual_actor_name}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_individual_actor_patronymic"  placeholder="Отчество:" value="{$query->vendor_individual_actor_patronymic}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_individual_company_name"  placeholder="Наименование: " value="{$query->vendor_individual_company_name}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_individual_actor_position"  placeholder="В лице: " value="{$query->vendor_individual_actor_position}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_individual_document_osn"  placeholder="Действующего на основании:" value="{$query->vendor_individual_document_osn}">
                </div>
                <div class = "content-input-group">
                    <input id="vendor_birthday" class="form-control datatimepicker" type="text"  name="vendor_individual_proxy_date"  placeholder="Дата выдачи доверенности:" value="{$query->vendor_individual_proxy_date}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_individual_proxy_number"  placeholder="Номер доверенности: " value="{$query->vendor_individual_proxy_number}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_props_inn"  placeholder="Номер паспорта:" value="{$query->vendor_props_inn}">
                </div>
                <div class = "content-input-group">
                    <input id="vendor_passport_date" class = "form-control" type="text" name="vendor_props_ogrn"  placeholder="Дата выдачи паспорта:" value="{$query->vendor_props_ogrn}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_props_inn"  placeholder="ИНН:" value="{$query->vendor_props_inn}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_props_ogrn "  placeholder="ОГРН:" value="{$query->vendor_props_ogrn}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_props_individual_adress"  placeholder="Юридический адрес: " value="{$query->vendor_props_individual_adress}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_props_phone"  placeholder="Телефон:" value="{$query->vendor_props_phone}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_props_bank_acc"  placeholder="Расчетный счет" value="{$query->vendor_props_bank_acc}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_props_bank_name"  placeholder="Наименование банка:" value="{$query->vendor_props_bank_name}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_props_korr_acc"  placeholder="Корр.счет:" value="{$query->vendor_props_korr_acc}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_props_bik"  placeholder="БИК:" value="{$query->vendor_props_bik}">
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
END;
    }
    public function bs_block_vendor_law_state()
    {
        echo <<<END
<div class="row" id="block_seller_info">
<div class="col-lg-12">
    <div class = "content-block">
        <p class = "content-header">Введите данныe продавца:</p>
        <div class = "content-radio">

            <div class = "content-input">
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_actor_surname"  placeholder="Фамилия:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_law_actor_name "  placeholder="Имя:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_actor_patronymic"  placeholder="Отчество:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_company_name"  placeholder="Наименование: ">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_law_actor_position"  placeholder="В лице: ">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_document_osn"  placeholder="Действующего на основании:">
                </div>
                <div class = "content-input-group">
                    <input id="vendor_birthday" class="form-control datatimepicker" type="text"  name="vendor_law_proxy_date"  placeholder="Дата выдачи доверенности:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_proxy_number"  placeholder="Номер доверенности: ">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_props_inn"  placeholder="Номер паспорта:">
                </div>
                <div class = "content-input-group">
                    <input id="vendor_passport_date" class = "form-control" type="text" name="vendor_props_ogrn"  placeholder="Дата выдачи паспорта:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_props_inn"  placeholder="ИНН:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_props_ogrn "  placeholder="ОГРН:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_props_law_adress"  placeholder="Юридический адрес: ">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_props_phone"  placeholder="Телефон:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_props_bank_acc"  placeholder="Расчетный счет">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_props_bank_name"  placeholder="Наименование банка:">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_props_korr_acc "  placeholder="Корр.счет:">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_props_bik"  placeholder="БИК:">
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
END;

    }
}