<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Ajax_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //блок адреса и даты заключения
    public function bs_block_deal($d, $data)
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
    public function bs_vendor($d, $data)
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
<div class="row" id="block_seller">
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
    public function bs_block_vendor_state($d,$data)
    {
        if(!$data){
            $this->db->select("bs.vendor_is_owner_car");
            $this->db->join("documents","documents.doc_id=bs.id");
            $this->db->where("documents.id",$d);
            $query = $this->db->get("buy_sale as bs",1,0)->row();
            $type = $query->vendor_is_owner_car;
            $v[] = ($type=='own_car')?'checked':'';
            $v[] = ($type=='not_own_car')?'checked':'';
        }
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
    if($type=='not_own_car'&&$data=='true'){
        $this->bs_block_vendor_agent($d);
    }

    }
    //блок представителя продавца
    public function bs_block_vendor_agent($d, $data)
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
    public function bs_block_vendor_info($d, $data)
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
        if($data=='true'&&$_GET['type']=='true'){
            $this->bs_block_vendor_agent($d, $data);
        }
    }
    //блок юрид.лица
    public function bs_block_vendor_law_state($d, $data)
    {
        $this->db->select("bs.vendor_law_actor_surname,
        bs.vendor_law_actor_name,
        bs.vendor_law_actor_patronymic,
        bs.vendor_law_company_name,
        bs.vendor_law_actor_position,
        bs.vendor_law_document_osn,
        bs.vendor_law_proxy_date,
        bs.vendor_law_proxy_number,
        bs.vendor_law_inn,
        bs.vendor_law_ogrn,
        bs.vendor_law_adress,
        bs.vendor_law_phone,
        bs.vendor_law_acc,
        bs.vendor_law_bank_name,
        bs.vendor_law_korr_acc,
        bs.vendor_law_bik");
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
                    <input class = "form-control" type="text" name="vendor_law_actor_surname"  placeholder="Фамилия:" value="{$query->vendor_law_actor_surname}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_law_actor_name"  placeholder="Имя:" value="{$query->vendor_law_actor_name}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_actor_patronymic"  placeholder="Отчество:" value="{$query->vendor_law_actor_patronymic}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_company_name"  placeholder="Наименование:" value="{$query->vendor_law_company_name}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_law_actor_position"  placeholder="В лице: " value="{$query->vendor_law_actor_position}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_document_osn"  placeholder="Действующего на основании:" value="{$query->vendor_law_document_osn}">
                </div>
                <div class = "content-input-group">
                    <input id="vendor_birthday" class="form-control datatimepicker" type="text"  name="vendor_law_proxy_date"  placeholder="Дата выдачи доверенности:" value="{$query->vendor_law_proxy_date}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_proxy_number"  placeholder="Номер доверенности: " value="{$query->vendor_law_proxy_number}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_law_inn"  placeholder="ИНН:" value="{$query->vendor_law_inn}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_law_ogrn"  placeholder="ОГРН:" value="{$query->vendor_law_ogrn}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_law_adress"  placeholder="Юридический адрес: " value="{$query->vendor_law_adress}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_phone"  placeholder="Телефон:" value="{$query->vendor_law_phone}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_acc"  placeholder="Расчетный счет" value="{$query->vendor_law_acc}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_bank_name"  placeholder="Наименование банка:" value="{$query->vendor_law_bank_name}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_law_korr_acc"  placeholder="Корр.счет:" value="{$query->vendor_law_korr_acc}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_law_bik"  placeholder="БИК:" value="{$query->vendor_law_bik}">
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
END;
        if($data=='true'&&$_GET['type']=='true'){
            $this->bs_block_vendor_agent($d, $data);
        }
    }
    //блок инфо о ид. лице
    public function bs_block_vendor_individual_state($d, $data)
    {
        $this->db->select("bs.vendor_ind_surname,
                            bs.vendor_ind_name,
                            bs.vendor_ind_patronymic,
                            bs.vendor_ind_number_of_certificate,
                            bs.vendor_ind_date_of_certificate,
                            bs.vendor_ind_passport_serial,
                            bs.vendor_ind_birthday,
                            bs.vendor_ind_passport_number,
                            bs.vendor_ind_passport_date,
                            bs.vendor_ind_passport_bywho,
                            bs.vendor_ind_city,
                            bs.vendor_ind_street,
                            bs.vendor_ind_house,
                            bs.vendor_ind_flat,
                            bs.vendor_ind_phone,
                            bs.vendor_ind_bank_acc,
                            bs.vendor_ind_bank_name,
                            bs.vendor_ind_korr_acc");
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
                    <input class = "form-control" type="text" name="vendor_ind_surname"  placeholder="Фамилия:" value="{$query->vendor_ind_surname}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_ind_name"  placeholder="Имя:" value="{$query->vendor_ind_name}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_ind_patronymic"  placeholder="Отчество:" value="{$query->vendor_ind_patronymic}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_ind_number_of_certificate"  placeholder="Номер свидетельства: " value="{$query->vendor_ind_number_of_certificate}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control datatimepicker" type="text" name="vendor_ind_date_of_certificate"  placeholder="Дата выдачи: " value="{$query->vendor_ind_date_of_certificate}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_ind_passport_serial"  placeholder="Паспорт серия:" value="{$query->vendor_ind_passport_serial}">
                </div>
                <div class = "content-input-group">
                    <input id="vendor_birthday" class="form-control datatimepicker" type="text"  name="vendor_ind_birthday"  placeholder="Дата рождения:" value="{$query->vendor_ind_birthday}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_ind_passport_number"  placeholder="Паспорт номер: " value="{$query->vendor_ind_passport_number}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control datatimepicker" type="text" name="vendor_ind_passport_date"  placeholder="Когда выдан паспорт:" value="{$query->vendor_ind_passport_date}">
                </div>
                <div class = "content-input-group">
                    <input id="vendor_passport_date" class = "form-control" type="text" name="vendor_ind_passport_bywho"  placeholder="Кем выдан:" value="{$query->vendor_ind_passport_bywho}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_ind_city"  placeholder="Адрес регистрации:" value="{$query->vendor_ind_city}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_ind_street"  placeholder="Улица:" value="{$query->vendor_ind_street}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_ind_house"  placeholder="№ дома: " value="{$query->vendor_ind_house}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_ind_flat"  placeholder="Номер квартиры:" value="{$query->vendor_ind_flat}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_ind_phone"  placeholder="Телефон" value="{$query->vendor_ind_phone}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_ind_bank_acc"  placeholder="Расчетный счет:" value="{$query->vendor_ind_bank_acc}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="vendor_ind_bank_name"  placeholder="В банке:" value="{$query->vendor_ind_bank_name}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vendor_ind_korr_acc"  placeholder="Корр.счет:" value="{$query->vendor_ind_korr_acc}">
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
END;
        if($data=='true'&&$_GET['type']=='true'){
            $this->bs_block_vendor_agent($d, $data);
        }
    }
    //блок типа покупателя
    public function bs_block_buyer($d, $data)
    {
        $this->db->select("bs.type_of_taker");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        $type = $query->type_of_taker;
        $v[] = ($type=='physical')?'checked':'';
        $v[] = ($type=='law')?'checked':'';
        $v[] = ($type=='individual')?'checked':'';

        echo <<<END
<div class="row" id="block_buyer">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Покупатель транспортного средства:</p>
            <div class = "content-radio-group">
                <div class = "content-radio">
                    <input data-id="block_buyer" class="edit-ajax-button" data-name="bs_block_buyer_state" type="radio" name="type_of_taker" value="physical" {$v[0]}>
                    <span class = "content-input-align">Физическое лицо</span>
                </div>
                <div class = "content-radio">
                    <input data-id="block_buyer" class="edit-ajax-button" data-name="bs_block_buyer_state" type="radio" name="type_of_taker" value="law" {$v[1]}>
                    <span class = "content-input-align">Юридическое лицо</span>
                </div>
                <div class = "content-radio">
                    <input data-id="block_buyer" class="edit-ajax-button" data-name="bs_block_buyer_state"" type="radio" name="type_of_taker" value="individual" {$v[2]}>
                    <span class = "content-input-align">Индивидуальный предприниматель</span>
                </div>
            </div>
        </div>
    </div>
</div>
END;

        $this->bs_block_buyer_state($d);
        switch ($type) {
            case 'physical': $this->bs_block_buyer_info($d); break;
            case 'law': $this->bs_block_buyer_law_state($d); break;
            case 'individual': $this->bs_block_buyer_individual_state($d); break;
        }
    }
    public function bs_block_buyer_state($d, $data)
    {
        if(!$data){
            $this->db->select("bs.buyer_is_owner_car");
            $this->db->join("documents","documents.doc_id=bs.id");
            $this->db->where("documents.id",$d);
            $query = $this->db->get("buy_sale as bs",1,0)->row();
            $type = $query->buyer_is_owner_car;
            $v[] = ($type=='own_car')?'checked':'';
            $v[] = ($type=='not_own_car')?'checked':'';
        }
        echo <<<END
<div class="row" id="block_buyer_info">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Статус покупателя:</p>
            <div class="content-radio-group">

                <div class = "content-radio">
                    <input data-id="block_buyer_info" class="edit-ajax-button" data-block-name="block_buyer_info" data-name="bs_block_buyer_selected_owner" type="radio" name="buyer_is_owner_car" value="own_car" {$v[0]}>
                    <span class = "content-input-align">Покупатель является новым собственником ТС</span>
                </div>


                <div class = "content-radio">
                    <input data-id="block_buyer_info" class="edit-ajax-button" data-block-name="block_buyer_info" data-name="bs_block_buyer_selected_not_owner" type="radio" name="buyer_is_owner_car" value="not_own_car" {$v[1]}>
                    <span class = "content-input-align">Покупатель не является новым собственником ТС и действует по доверенности</span>
                </div>
            </div>

        </div>
    </div>
</div>
END;
        if($type=='not_own_car'&&$data==false){
            $this->bs_block_buyer_agent($d);
        }
    }
    //данные представителя покупателя
    public function bs_block_buyer_agent($d, $data)
    {
        $this->db->select("bs.for_agent_buyer_surname,
                            bs.for_agent_buyer_name,
                            bs.for_agent_buyer_patronymic,
                            bs.for_agent_buyer_proxy_date,
                            bs.for_agent_buyer_proxy_number,
                            bs.for_agent_buyer_proxy_notary");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        echo <<<END
         <div class="row" id="for_agent_buyer_info">
            <div class="col-lg-12">
            <div class = "content-block">
             <p class = "content-header">Введите данныe предствителя:</p>
                <div class = "content-input">
                    <div class = "content-input-group">
                    <input class = "form-control" type="text" name="for_agent_buyer_surname"  placeholder="Фамилия:" value="{$query->for_agent_buyer_surname}">
                    </div>
                    <div class = "content-input-group">
                    <input class="form-control" type="text" name="for_agent_buyer_name"  placeholder="Имя:" value="{$query->for_agent_buyer_name}">
                    </div>
                    <div class = "content-input-group">
                    <input class = "form-control" type="text" name="for_agent_buyer_patronymic"  placeholder="Отчество:" value="{$query->for_agent_buyer_patronymic}">
                    </div>
                    <div class = "content-input-group">
                    <input id="vendor_birthday" class="form-control datetimepicker" type="text"  name="for_agent_buyer_proxy_date"  placeholder="Дата выдачи:" value="{$query->for_agent_buyer_proxy_date}">
                    </div>
                    <div class = "content-input-group">
                    <input class = "form-control" type="text" name="for_agent_buyer_proxy_number"  placeholder="Серия паспорта:" value="{$query->for_agent_buyer_proxy_number}">
                    </div>
                    <div class = "content-input-group">
                    <input class="form-control" type="text" name="for_agent_buyer_proxy_notary"  placeholder="Номер паспорта:" value="{$query->for_agent_buyer_proxy_notary}">
                    </div>
                </div>
         </div>
    </div>
</div>
END;
    }
    //данные физ. покупателя
    public function bs_block_buyer_info($d, $data)
    {
        $this->db->select("bs.buyer_surname,
                           bs.buyer_name,
                           bs.buyer_patronymic,
                           bs.buyer_birthday,
                           bs.buyer_passport_serial,
                           bs.buyer_passport_number,
                           bs.buyer_passport_date,
                           bs.buyer_passport_bywho,
                           bs.buyer_city,
                           bs.buyer_street,
                           bs.buyer_house,
                           bs.buyer_flat,
                           bs.buyer_phone
                           ");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        echo <<<END
        <div class="row" id="block_buyer_info">
<div class="col-lg-12">
    <div class = "content-block">
        <p class = "content-header">Введите данныe покупателя:</p>
        <div class = "content-radio">

            <div class = "content-input">
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_surname"  placeholder="Фамилия:" value="{$query->buyer_surname}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_name"  placeholder="Имя:" value="{$query->buyer_name}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_patronymic"  placeholder="Отчество:" value="{$query->buyer_patronymic}">
                </div>
                <div class = "content-input-group">
                    <input id="buyer_birthday" class="form-control datatimepicker" type="text"  name="buyer_birthday"  placeholder="Дата рождения:" value="{$query->buyer_birthday}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_passport_serial"  placeholder="Серия паспорта:" value="{$query->buyer_passport_serial}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_passport_number"  placeholder="Номер паспорта:" value="{$query->buyer_passport_number}">
                </div>
                <div class = "content-input-group">
                    <input id="buyer_passport_date" class = "form-control datetimepicker" type="text" name="buyer_passport_date"  placeholder="Дата выдачи паспорта:" value="{$query->buyer_passport_date}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_passport_bywho"  placeholder="Кем выдан паспорт:" value="{$query->buyer_passport_bywho}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_city"  placeholder="Город (адрес регистрации):" value="{$query->buyer_city}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_street"  placeholder="Улица:" value="{$query->buyer_street}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_house"  placeholder="№ Дома:" value="{$query->buyer_house}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_flat"  placeholder="Квартира:" value="{$query->buyer_flat}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_phone"  placeholder="Телефон" value="{$query->buyer_phone}">
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
END;
        if($data=='true'&&$_GET['type']=='true'){
            $this->bs_block_buyer_agent($d, $data);
        }
    }
    //данные юр.покупателя
    public function bs_block_buyer_law_state($d, $data)
    {
        $this->db->select("bs.buyer_law_actor_surname,
        bs.buyer_law_actor_name,
        bs.buyer_law_actor_patronymic,
        bs.buyer_law_company_name,
        bs.buyer_law_actor_position,
        bs.buyer_law_document_osn,
        bs.buyer_law_proxy_date,
        bs.buyer_law_proxy_number,
        bs.buyer_law_inn,
        bs.buyer_law_ogrn,
        bs.buyer_law_adress,
        bs.buyer_law_phone,
        bs.buyer_law_acc,
        bs.buyer_law_bank_name,
        bs.buyer_law_korr_acc,
        bs.buyer_law_bik");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();

        echo <<<END
<div class="row" id="block_seller_info">
<div class="col-lg-12">
    <div class = "content-block">
        <p class = "content-header">Введите данныe покупателя:</p>
        <div class = "content-radio">

            <div class = "content-input">
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_actor_surname"  placeholder="Фамилия:" value="{$query->buyer_law_actor_surname}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_law_actor_name"  placeholder="Имя:" value="{$query->buyer_law_actor_name}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_actor_patronymic"  placeholder="Отчество:" value="{$query->buyer_law_actor_patronymic}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_company_name"  placeholder="Наименование: " value="{$query->buyer_law_company_name}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_law_actor_position"  placeholder="В лице: " value="{$query->buyer_law_actor_position}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_document_osn"  placeholder="Действующего на основании:" value="{$query->buyer_law_document_osn}">
                </div>
                <div class = "content-input-group">
                    <input id="buyer_birthday" class="form-control datatimepicker" type="text"  name="buyer_law_proxy_date"  placeholder="Дата выдачи доверенности:" value="{$query->buyer_law_proxy_date}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_proxy_number"  placeholder="Номер доверенности: " value="{$query->buyer_law_proxy_number}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_law_inn"  placeholder="ИНН:" value="{$query->buyer_law_inn}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_law_ogrn"  placeholder="ОГРН:" value="{$query->buyer_law_ogrn}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_law_adress"  placeholder="Юридический адрес: " value="{$query->buyer_law_adress}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_phone"  placeholder="Телефон:" value="{$query->buyer_law_phone}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_acc"  placeholder="Расчетный счет" value="{$query->buyer_law_acc}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_bank_name"  placeholder="Наименование банка:" value="{$query->buyer_law_bank_name}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_law_korr_acc"  placeholder="Корр.счет:" value="{$query->buyer_law_korr_acc}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_law_bik"  placeholder="БИК:" value="{$query->buyer_law_bik}">
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
END;
        if($data=='true'&&$_GET['type']=='true'){
            $this->bs_block_buyer_agent($d, $data);
        }
    }
    public function bs_block_buyer_individual_state($d, $data)
    {
        $this->db->select("bs.buyer_ind_surname,
                            bs.buyer_ind_name,
                            bs.buyer_ind_patronymic,
                            bs.buyer_ind_number_of_certificate,
                            bs.buyer_ind_date_of_certificate,
                            bs.buyer_ind_passport_serial,
                            bs.buyer_ind_birthday,
                            bs.buyer_ind_passport_number,
                            bs.buyer_ind_passport_date,
                            bs.buyer_ind_passport_bywho,
                            bs.buyer_ind_city,
                            bs.buyer_ind_street,
                            bs.buyer_ind_house,
                            bs.buyer_ind_flat,
                            bs.buyer_ind_phone,
                            bs.buyer_ind_bank_acc,
                            bs.buyer_ind_bank_name,
                            bs.buyer_ind_korr_acc,
                            bs.buyer_ind_bik");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        echo <<<END
<div class="row" id="block_buyer_info">
<div class="col-lg-12">
    <div class = "content-block">
        <p class = "content-header">Введите данныe покупателя:</p>
        <div class = "content-radio">

            <div class = "content-input">
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_ind_surname"  placeholder="Фамилия:" value="{$query->buyer_ind_surname}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_ind_name"  placeholder="Имя:" value="{$query->buyer_ind_name}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_ind_patronymic"  placeholder="Отчество:" value="{$query->buyer_ind_patronymic}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_ind_number_of_certificate"  placeholder="Номер свидетельства: " value="{$query->buyer_ind_number_of_certificate}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control datatimepicker" type="text" name="buyer_ind_date_of_certificate"  placeholder="Дата выдачи: " value="{$query->buyer_ind_date_of_certificate}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_ind_passport_serial"  placeholder="Паспорт серия:" value="{$query->buyer_ind_passport_serial}">
                </div>
                <div class = "content-input-group">
                    <input id="buyer_birthday" class="form-control datatimepicker" type="text"  name="buyer_ind_birthday"  placeholder="Дата рождения:" value="{$query->buyer_ind_birthday}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_ind_passport_number"  placeholder="Паспорт номер: " value="{$query->buyer_ind_passport_number}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control datatimepicker" type="text" name="buyer_ind_passport_date"  placeholder="Когда выдан паспорт:" value="{$query->buyer_ind_passport_date}">
                </div>
                <div class = "content-input-group">
                    <input id="buyer_passport_date" class = "form-control" type="text" name="buyer_ind_passport_bywho"  placeholder="Кем выдан:" value="{$query->buyer_ind_passport_bywho}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_ind_city"  placeholder="Адрес регистрации:" value="{$query->buyer_ind_city}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_ind_street"  placeholder="Улица:" value="{$query->buyer_ind_street}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_ind_house"  placeholder="№ дома: " value="{$query->buyer_ind_house}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_ind_flat"  placeholder="Номер квартиры:" value="{$query->buyer_ind_flat}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_ind_phone"  placeholder="Телефон" value="{$query->buyer_ind_phone}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_ind_bank_acc"  placeholder="Расчетный счет:" value="{$query->buyer_ind_bank_acc}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="buyer_ind_bank_name"  placeholder="В банке:" value="{$query->buyer_ind_bank_name}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_ind_korr_acc"  placeholder="Корр.счет:" value="{$query->buyer_ind_korr_acc}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="buyer_ind_bik"  placeholder="БИК:" value="{$query->buyer_ind_bik}">
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
END;
        if($data=='true'&&$_GET['type']=='true'){
            $this->bs_block_buyer_agent($d, $data);
        }
    }
    //Информация об авто
    public function bs_block_ts_info($d, $data)
    {
        $this->db->select("bs.mark,
                        bs.vin,
                        bs.reg_gov_number,
                        bs.car_type,
                        bs.category,
                        bs.date_of_product,
                        bs.engine_model,
                        bs.shassi,
                        bs.carcass,
                        bs.color_carcass,
                        bs.other_parameters");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();

        echo <<<END
<div class="row" id="block_ts_info" data-id="7">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Сведения о траспортном средстве:</p>
            <div class = "content-radio">

                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="mark"  placeholder="Модель,марка:" value="{$query->mark}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="vin"  placeholder="Идентификационный номер (VIN):" value="{$query->vin}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="reg_gov_number"  placeholder="Государственный регистрационный знак:" value="{$query->reg_gov_number}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text"  name="car_type"  placeholder="Наименование(тип):" value="{$query->car_type}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="category"  placeholder="Категория:" value="{$query->category}">
                </div>
                <div class = "content-input-group">
                    <input id="date_of_product" class="form-control datetimepicker" type="text" name="date_of_product"  placeholder="Год изготовления:" value="{$query->date_of_product}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="engine_model"  placeholder="Модель, номер двигателя:" value="{$query->engine_model}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="shassi"  placeholder="Номер рамы,шасси:" value="{$query->shassi}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="carcass"  placeholder="Кузов(кабина,прицеп):" value="{$query->carcass}">
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="color_carcass"  placeholder="Цвет кузова,кабины,прицепа:" value="{$query->color_carcass}">
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="other_parameters"  placeholder="Иные индивидуальные признаки:" value="{$query->other_parameters}">
                </div>
            </div>
        </div>
    </div>
</div>
END;
        $this->bs_block_serial_car($d, $data);
    }
    public function bs_block_serial_car($d, $data)
    {
        $this->db->select("bs.serial_car,
                        bs.number_of_serial_car,
                        bs.date_of_serial_car,
                        bs.bywho_serial_car");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();

        echo <<<END
<div class="row" id="block_serial_car" data-id="8">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Сведения о паспорте транспортного средства(ПТС):</p>

            <div class = "content-input-group">
                <input class="form-control" type="text"  name="serial_car"  placeholder="Серия:" value="{$query->serial_car}">
            </div>
            <div class = "content-input-group">
                <input class = "form-control" type="text" name="number_of_serial_car"  placeholder="Номер:" value="{$query->number_of_serial_car}">
            </div>
            <div class = "content-input-group">
                <input id="date_of_serial_car" class="form-control datetimepicker" type="text" name="date_of_serial_car"  placeholder="Дата выдачи:" value="{$query->date_of_serial_car}">
            </div>
            <div class = "content-input-group">
                <input class = "form-control" type="text" name="bywho_serial_car"  placeholder="Кем выдан" value="{$query->bywho_serial_car}">
            </div>
        </div>
    </div>
</div>
END;
        $this->bs_block_additional_devices($d, $data);
        //$this->bs_block_car_price($d,$data);
    }

    public function bs_block_additional_devices($d, $data)
    {
        $this->db->select("bs.additional_devices");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        $v[] = ($query->additional_devices=="true")?' checked':'';
        $v[] = ($query->additional_devices=="false")?' checked':'';
        echo <<<END
<div class="row" id="block_additional_devices">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Серийное и дополнительное оборудование, установленное на ТС(Указать?):</p>
            <div class = "content-radio-header">
                <div class = "content-input-inline">
                    <input data-id="block_additional_devices" class="edit-ajax-button" data-name="bs_block_additional_devices_yes" id = "mods_yes" type="radio" name="additional_devices" value="true"{$v[0]}>
                    <span class = "content-input-align">Да</span>

                    <input data-id="block_additional_devices" class="edit-ajax-button" data-name="bs_block_additional_devices_no" id = "mods_no"  type="radio" name="additional_devices" value="false"{$v[1]}>
                    <span class = "content-input-align">Нет</span>
                </div>
            </div>
        </div>
    </div>
</div>

END;
        if($query->additional_devices=="true")
            $this->bs_block_additional_devices_list($d, $data);
        $this->bs_block_car_state($d, $data);
    }
    public function bs_block_additional_devices_list($d, $data)
    {
        $this->db->select("bs.additional_devices_array, bs.oil_in_car");
        $this->db->join("documents", "documents.doc_id=bs.id");
        $this->db->where("documents.id", $d);
        $query = $this->db->get("buy_sale as bs", 1, 0)->row();
        $data = json_decode($query->additional_devices_array);
        $input = <<<END
<div class="row" id="block_additional_devices_list">
    <div class="col-lg-12">
        <div class = "content-block">
            <div class = "content-input-group">
                <input class="form-control" type="text"  name="oil_in_car" value="{$query->oil_in_car}"  placeholder="Залитое в двигатель масло">
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class = "content-radio-group">

                        <div class = "content-input">
                            <input type="checkbox" data-name="rule" data-name="system" name="additional_devices_array[]" value="Левый руль">
                            <span class = "content-input-align">Левый руль</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="rule" name="additional_devices_array[]" value="Правый руль">
                            <span class = "content-input-align">Правый руль</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="dvs" name="additional_devices_array[]" value="Бензиновый ДВС">
                            <span class = "content-input-align">Бензиновый ДВС</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="dvs" name="additional_devices_array[]" value="Дизельный ДВС">
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
                            <input type="checkbox" data-name="typed" name="additional_devices_array[]" value="Карбюратор">
                            <span class = "content-input-align">Карбюратор</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="typed" name="additional_devices_array[]" value="Инжектор">
                            <span class = "content-input-align">Инжектор</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="kpp" name="additional_devices_array[]" value="Механическая КПП">
                            <span class = "content-input-align">Механическая КПП</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" data-name="kpp" name="additional_devices_array[]" value="Автоматическая КПП">
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
                            <input type="checkbox" data-name="system" name="additional_devices_array[]" value="Противоугонная система штатная">
                            <span class = "content-input-align">Противоугонная система штатная</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="system" name="additional_devices_array[]" value="Противоугонная система механическая">
                            <span class = "content-input-align">Противоугонная система механическая</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" data-name="system" name="additional_devices_array[]" value="Противоугонная система электронная">
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
                            <input type="checkbox" data-name="lining" name="additional_devices_array[]" value="Накладки окрашенные">
                            <span class = "content-input-align">Накладки окрашенные</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="lining" name="additional_devices_array[]" value="Накладки хромированные">
                            <span class = "content-input-align">Накладки хромированные</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="privod" name="additional_devices_array[]" value="Привод передний">
                            <span class = "content-input-align">Привод передний</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="privod" name="additional_devices_array[]" value="Привод задний">
                            <span class = "content-input-align">Привод задний</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="privod" name="additional_devices_array[]" value="Полный привод">
                            <span class = "content-input-align">Полный привод</span>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class = "content-radio">

                        <div class = "content-input">
                            <input type="checkbox" data-name="block-system" name="additional_devices_array[]" value="Антиблокировочная тормозная система">
                            <span class = "content-input-align">Антиблокировочная тормозная система</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="rudder" name="additional_devices_array[]" value="Гидроусилитель руля">
                            <span class = "content-input-align">Гидроусилитель руля</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="rudder" name="additional_devices_array[]" value="Электроусилитель руля">
                            <span class = "content-input-align">Электроусилитель руля</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox"  data-name="reg_rudder" name="additional_devices_array[]" value="Регулируемая рулевая колонка">
                            <span class = "content-input-align">Регулируемая рулевая колонка</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="ton_glass" name="additional_devices_array[]" value="Тонированное ветровое стекло">
                            <span class = "content-input-align">Тонированное ветровое стекло</span>
                        </div>
                        <div class = "content-input">
                            <input type="checkbox" data-name="ton_glass" name="additional_devices_array[]" value="Тонированные стекла прочие">
                            <span class = "content-input-align">Тонированные стекла прочие</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="disk" name="additional_devices_array[]" value="Диски легкосплавные">
                            <span class = "content-input-align">Диски легкосплавные</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="disk" name="additional_devices_array[]" value="Диски штампованные">
                            <span class = "content-input-align">Диски штампованные</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="korrekt" name="additional_devices_array[]" value="Корректор фар">
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
                            <input type="checkbox" data-name="luk_fun" name="additional_devices_array[]" value="Люк механический">
                                <span class = "content-input-align">Люк механический</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="luk_fun" name="additional_devices_array[]" value="Люк с электроприводом">
                            <span class = "content-input-align">Люк с электроприводом</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="luk_material" name="additional_devices_array[]" value="Люк стеклянный">
                            <span class = "content-input-align">Люк стеклянный</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="luk_material" name="additional_devices_array[]" value="Люк металлический">
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
                            <input type="checkbox" data-name="salon" name="additional_devices_array[]" value="Салон кожаный">
                            <span class = "content-input-align">Салон кожаный</span>
                        </div>

                        <div class = "content-input">
                            <input type="checkbox" data-name="salon" name="additional_devices_array[]" value="Салон велюровый">
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

        foreach ($data as $item) {
            $input = str_replace("value=\"{$item}\"", "value=\"{$item}\" checked", $input);
        }

        echo $input;

    }
    //общее состояния ТС
    public function bs_block_car_state($d, $data)
    {
        $this->db->select("bs.car_allstatus");
        $this->db->join("documents", "documents.doc_id=bs.id");
        $this->db->where("documents.id", $d);
        $query = $this->db->get("buy_sale as bs", 1, 0)->row();
        $input = <<<END
<div class="row" id="block_car_state" data-id="12">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Общее состояние транспортного средства:</p>

            <div class = "content-radio-group">
                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="Отличное">
                    <span class = "content-input-align">Отличное</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="Хорошее">
                    <span class = "content-input-align">Хорошее</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="Удовлетворительное">
                    <span class = "content-input-align">Удовлетворительное</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="Не на ходу">
                    <span class = "content-input-align">Не на ходу</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="После ДТП">
                    <span class = "content-input-align">После ДТП</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="car_allstatus" value="Восстановлению не подлежит">
                    <span class = "content-input-align">Восстановлению не подлежит</span>
                </div>
            </div>

        </div>
    </div>
</div>
END;
        $input = str_replace("value=\"{$query->car_allstatus}\"", "value=\"{$query->car_allstatus}\" checked", $input);

        echo $input;
        $this->bs_block_maintenance($d, $data);
    }
    //последнее тех обслуживание
    public function bs_block_maintenance($d, $data)
    {
        $this->db->select("bs.maintenance_date, bs.maintenance_bywho");
        $this->db->join("documents", "documents.doc_id=bs.id");
        $this->db->where("documents.id", $d);
        $query = $this->db->get("buy_sale as bs", 1, 0)->row();
        echo <<<END
<div class="row" id="block_maintenance" data-id="13">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Последнее техническое обслуживание транспортного средства проведено:</p>

            <div class = "content-input-group">
                <input id="maintenance_date" class="form-control datetimepicker" value="{$query->maintenance_date}" type="text"  name="maintenance_date"  placeholder="Дата:">
            </div>
            <div class = "content-input-group">
                <input class = "form-control" type="text" name="maintenance_bywho" value="{$query->maintenance_bywho}" placeholder="Кем проведено:">
            </div>

        </div>
    </div>
</div>
END;
        $this->bs_block_defects($d, $data);
    }
    public function bs_block_defects($d, $data)
    {
        $this->db->select("bs.defects");
        $this->db->join("documents", "documents.doc_id=bs.id");
        $this->db->where("documents.id", $d);
        $query = $this->db->get("buy_sale as bs", 1, 0)->row();
        $v[0] = !empty($query->defects)?'checked':'';
        $v[1] = empty($v[0])?'checked':'';
        $text = '';
        if($v[0]=='checked')
            $text = '<div id="defects_additional_block" class="content-input-group"><input class="form-control" type="text" name="defects" value="'.$query->defects.'" placeholder="Дефекты"></div>';
        echo <<<END
        <div class="row" id="block_defects" >
    <div class="col-lg-12">
        <div class = "content-block" id="defects_block">
            <p class = "content-header">Неустраненные повреждения и эксплуатационные дефекты:</p>

            <div class = "content-radio-header">
                <div class = "content-input-inlane">
                    <input  id="defects_yes" type="radio" name="defects" value="true" {$v[0]}>
                    <span class = "content-input-align">Есть</span>

                    <input class="" data-function="defects_additional_block" id="defects_no" type="radio" name="defects" value="false" {$v[1]}>
                    <span class = "content-input-align">Нет</span>
                </div>
            </div>
               {$text}
        </div>
    </div>
</div>
END;
        $this->bs_block_features($d, $data);
    }
    public function bs_block_features($d, $data)
    {
        $this->db->select("bs.features");
        $this->db->join("documents", "documents.doc_id=bs.id");
        $this->db->where("documents.id", $d);
        $query = $this->db->get("buy_sale as bs", 1, 0)->row();
        $v[0] = !empty($query->features)?'checked':'';
        $v[1] = empty($v[0])?'checked':'';
        $text = '';
        if($v[0]=='checked')
            $text = '<div id="features_additional_block" class="content-input-group"><input class="form-control" type="text" name="features" value="'.$query->features.'" placeholder="Особенности"></div>';
        echo <<<END
<div class="row" id="block_features" data-id="15">
    <div class="col-lg-12">
        <div class = "content-block" id="features_block">
            <p class = "content-header">Особенности, которые не влияют на безопасность ТС:</p>

            <div class = "content-radio-header">
                <div class = "content-input-inlane">
                    <input id="features_yes" type="radio" name="features" value="true" {$v[0]}>
                    <span class = "content-input-align">Есть</span>

                    <input id="features_no" type="radio" name="features" value="false" {$v[1]}>
                    <span class = "content-input-align">Нет</span>
                </div>
            </div>
            {$text}
        </div>
    </div>
</div>

END;
        $this->bs_block_documents($d,$data);
    }
    //передача документов
    public function bs_block_documents($d,$data)
    {
        $this->db->select("bs.documents");
        $this->db->join("documents", "documents.doc_id=bs.id");
        $this->db->where("documents.id", $d);
        $query = $this->db->get("buy_sale as bs", 1, 0)->row();
        $input = <<<END
<div class="row" id="block_documents" data-id="17">
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
        foreach (json_decode($query->documents) as $document) {
            $input = str_replace("value=\"{$document}\"", "value=\"{$document}\" checked", $input);
        }

        echo $input;
        $this->bs_block_accessories($d,$data);
    }
    public function bs_block_accessories($d,$data)
    {
        $this->db->select("bs.accessories");
        $this->db->join("documents", "documents.doc_id=bs.id");
        $this->db->where("documents.id", $d);
        $query = $this->db->get("buy_sale as bs", 1, 0)->row();
        $input = <<<END
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
                %{text}%
            </div>
        </div>
    </div>
</div>

END;
        $documents = json_decode($query->accessories);

        foreach ($documents as $key => $document) {
            if (strripos($input, $document)) {
                $input = str_replace("value=\"{$document}\"", "value=\"{$document}\" checked", $input);
                unset($documents[$key]);
            }
        }
        $text = '';
        if (!empty($documents)) {
            foreach ($documents as $document) {
                $text = <<<END
                <div class="content-input-group">
                    <input class="form-control" type="text" name="accessories[]" placeholder="Дополнительные принадлежности:" value="{$document}">
                </div>
END;
            }
            $input = str_replace("id=\"accessories_other\"", "id=\"accessories_other\" checked", $input);
        }
        $input = str_replace("%{text}%", $text, $input);
        echo $input;
    }
    public function bs_block_car_price($d, $data)
    {
        $this->db->select("bs.price_car,
                        bs.currency");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        $v[] = ($query->currency=="RUB")?' checked':'';
        $v[] = ($query->currency=="USD")?' checked':'';
        $v[] = ($query->currency=="EUR")?' checked':'';
        echo <<<END
<div class="row" id="block_car_price" data-id="9">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Стоимость транспортного средства по договору:</p>
            <div style="width:100%"class = "content-input-group">
                   <input style="width:80%;float:left;"class="form-control" type="text"  name="price_car"  placeholder="Стоимость:" value="{$query->price_car}">
                <select style="width:15%" class="form-control" name="currency">
                    <option value="RUB"{$v[0]}>RUB</option>
                    <option value="USD"{$v[1]}>USD</option>
                    <option value="EUR"{$v[2]}>EUR</option>
                </select>
            </div>
        </div>
    </div>
</div>

END;
        $this->bs_block_payment_date();
    }
    public function bs_block_payment_date()
    {
        echo <<<END
<div class="row" id="block_payment_date" data-id="16">
    <div class="col-lg-12">
        <div class = "content-block" id="payment_date">
            <p class = "content-header">Сроки оплаты:</p>
            <div class = "content-radio-group">

                <div class = "content-radio">
                    <input type="radio" name="payment_date" value="До подписания настоящего договора">
                    <span class = "content-input-align">До подписания настоящего договора</span>
                </div>

                <div class = "content-radio">
                    <input type="radio" name="payment_date" value="При подписании настоящего договора">
                    <span class = "content-input-align">При подписании настоящего договора</span>
                </div>

                <div class = "content-radio">
                    <input id="credit" type="radio" name="payment_date" value="В рассрочку по следующему графику">
                    <span class = "content-input-align">В рассрочку по следующему графику:</span>
                </div>

            </div>
        </div>
    </div>
</div>
END;
        $this->bs_block_penalty();
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
    public function bs_block_car_in_marriage($d,$data)
    {
        $this->db->select("bs.car_in_marriage");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        $v[] = ($query->car_in_marriage=="true")?' checked':'';
        $v[] = ($query->car_in_marriage=="false")?' checked':'';
        echo <<<END
<div class="row" id="block_car_in_marriage">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Автомобиль приобретен в период брака?</p>
            <div class = "content-radio-header">

                <div class = "content-input-inlane">
                    <input data-id="block_car_in_marriage" class="edit-ajax-button" data-name="bs_block_spounse" type="radio" name="car_in_marriage" value="true" {$v[0]}>
                    <span class = "content-input-align">Да</span>

                    <input data-id="block_car_in_marriage" class="edit-ajax-button" type="radio" name="car_in_marriage" value="false" {$v[1]}>
                    <span class = "content-input-align">Нет</span>
                </div>

            </div>
        </div>
    </div>
</div>
END;
        if($query->car_in_marriage=='true')
            $this->bs_block_spounse($d,$data);
    }
    public function bs_block_spounse($d,$data)
    {
        $this->db->select("bs.spouse_surname,
                           bs.spouse_name,
                           bs.spouse_patronymic,
                           bs.spouse_birthday,
                           bs.spouse_pass_serial,
                           bs.spouse_pass_number,
                           bs.spouse_pass_date,
                           bs.spouse_pass_bywho,
                           bs.spouse_city,
                           bs.spouse_street,
                           bs.spouse_house,
                           bs.spouse_flat,
                           bs.marriage_svid_serial,
                           bs.marriage_svid_number,
                           bs.marriage_svid_date,
                           bs.marriage_svid_bywho");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();

        echo <<<END
<div class="row" id="block_spouse" data-id="20">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Введите данныe супруги:</p>
            <div class = "content-radio">

                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_surname"  placeholder="Фамилия:" {$query->spouse_surname}>
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="spouse_name"  placeholder="Имя:" {$query->spouse_name}>
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_patronymic"  placeholder="Отчество:" {$query->spouse_patronymic}>
                </div>
                <div class = "content-input-group">
                    <input id="spouse_birthday" class="form-control datetimepicker" type="text"  name="spouse_birthday"  placeholder="Дата рождения:" {$query->spouse_birthday}>
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_pass_serial"  placeholder="Серия паспорта:" {$query->spouse_pass_serial}>
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="spouse_pass_number"  placeholder="Номер паспорта:" {$query->spouse_pass_number}>
                </div>
                <div class = "content-input-group">
                    <input id="spouse_pass_date" class = "form-control datetimepicker" type="text" name="spouse_pass_date"  placeholder="Дата выдачи паспорта:" {$query->spouse_pass_date}>
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="spouse_pass_bywho"  placeholder="Кем выдан паспорт:" {$query->spouse_pass_bywho}>
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_city"  placeholder="Адрес регистрации(город):" {$query->spouse_city}>
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_street"  placeholder="Адрес регистрации(улица):" {$query->spouse_street}>
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_house"  placeholder="Адрес регистрации(дом):" {$query->spouse_house}>
                </div>
                <div class = "content-input-group">
                    <input class = "form-control" type="text" name="spouse_flat"  placeholder="Адрес регистрации(квартира):" {$query->spouse_flat}>
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="marriage_svid_serial"  placeholder="Серия свидетельства о браке:" {$query->marriage_svid_serial}>
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="marriage_svid_number"  placeholder="Номер свидетельства о браке:" {$query->marriage_svid_number}>
                </div>
                <div class = "content-input-group">
                    <input id="marriage_svid_date" class="form-control datetimepicker" type="text" name="marriage_svid_date"  placeholder="Дата выдачи свидетельства о браке:" {$query->marriage_svid_date}>
                </div>
                <div class = "content-input-group">
                    <input class="form-control" type="text" name="marriage_svid_bywho"  placeholder="Kем выдано свидетельство о браке:" {$query->marriage_svid_bywho}>
                </div>

            </div>
        </div>
    </div>
</div>

END;
    }
    public function bs_block_police($d,$data)
    {
        $this->db->select("bs.gibdd_reg_name,
                            bs.gibdd_power_engine,
                            bs.gibdd_eco_class,
                            bs.gibdd_max_mass,
                            bs.gibdd_min_mass,
                            bs.statement_form");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        $v[] = ($query->statement_form=="true")?' checked':'';
        $v[] = ($query->statement_form=="false")?' checked':'';
        echo <<<END
<div class="row" id="block_police">
    <div class="col-lg-12">
        <div class = "content-block">
            <p class = "content-header">Заявление в ГИББД</p>
            <div class = "content-radio-header">

              <div class = "content-input-group">
                    <input class = "form-control" type="text" name="gibdd_reg_name"  placeholder="Наименование регистрационного подразделения ГИБДД:" {$query->gibdd_reg_name}>
              </div>
            </div>
            <p class = "content-header">Сведения из ПТС транспортного средства:</p>
            <div class = "content-radio-header">

             <div class = "content-input-group">
                    <input class = "form-control" type="text" name="gibdd_power_engine"  placeholder="Мощность двигателя в ВТ:" {$query->gibdd_power_engine}>
              </div>
              <div class = "content-input-group">
                    <input class = "form-control" type="text" name="gibdd_eco_class"  placeholder="Экологический класс:" {$query->gibdd_eco_class}>
              </div>
              <div class = "content-input-group">
                    <input class = "form-control" type="text" name="gibdd_max_mass"  placeholder="Разрешенная максимальная масса:" {$query->gibdd_max_mass}>
              </div>
               <div class = "content-input-group">
                    <input class = "form-control" type="text" name="gibdd_min_mass"  placeholder="Разрешенная минимальная  масса:" {$query->gibdd_min_mass}>
              </div>

            </div>


        <h4 class="content-header">Кто несет заявление в ГИБДД?</h4>
            <div class = "content-radio-header">
                <div class = "content-input-inlane">
                    <input data-id="block_police" class="edit-ajax-button" data-type="statement" data-name="bs_block_statement_gibdd" type="radio" name="statement_form" value="true" {$v[0]}>
                    <span class = "content-input-align">Покупатель лично</span>

                    <input data-id="block_police" class="edit-ajax-button" data-type="statement" type="radio" name="statement_form" value="false" {$v[1]}>
                    <span class = "content-input-align">Представитель</span>
                </div>
            </div>
        </div>
    </div>
</div>
END;
        if($query->statement_form=="true")
            $this->bs_block_statement_gibdd($d, $data);
    }
    public function bs_block_statement_gibdd($d, $data)
    {
        $this->db->select("bs.for_agent_proxy_pass_serial,
                           bs.for_agent_proxy_pass_number,
                           bs.for_agent_proxy_pass_date,
                           bs.for_agent_proxy_pass_bywho,
                           bs.for_agent_proxy_city,
                           bs.for_agent_proxy_street,
                           bs.for_agent_proxy_house,
                           bs.for_agent_proxy_flat,
                           bs.for_agent_proxy_phone");
        $this->db->join("documents","documents.doc_id=bs.id");
        $this->db->where("documents.id",$d);
        $query = $this->db->get("buy_sale as bs",1,0)->row();
        echo <<<END
<div class="row">
    <div class="col-lg-12">
    <div class = "content-block">
        <div class = "content-input">
             <div class = "content-input-group">
                <input class="form-control" type="text" name="for_agent_proxy_pass_serial"  placeholder="Серия паспорта" {$query->for_agent_proxy_pass_serial}>
             </div>
             <div class = "content-input-group">
                <input class="form-control" type="text" name="for_agent_proxy_pass_number"  placeholder="Номер паспорта" {$query->for_agent_proxy_pass_number}>
             </div>
             <div class = "content-input-group">
                <input class="form-control" type="text" name="for_agent_proxy_pass_date"  placeholder="Когда выдан" {$query->for_agent_proxy_pass_date}>
             </div>
             <div class = "content-input-group">
                <input class="form-control" type="text" name="for_agent_proxy_pass_bywho"  placeholder="Кем выдан" {$query->for_agent_proxy_pass_bywho}>
             </div>
             <div class = "content-input-group">
                <input class="form-control" type="text" name="for_agent_proxy_city"  placeholder="Адрес (Город)" {$query->for_agent_proxy_city}>
             </div>
             <div class = "content-input-group">
                <input class="form-control" type="text" name="for_agent_proxy_street"  placeholder="Адрес (Улица)" {$query->for_agent_proxy_street}>
             </div>
             <div class = "content-input-group">
                <input class="form-control" type="text" name="for_agent_proxy_house"  placeholder="Адрес (Квартира)" {$query->for_agent_proxy_house}>
             </div>
             <div class = "content-input-group">
                <input class="form-control" type="text" name="for_agent_proxy_flat"  placeholder="Адрес (Квартира)" {$query->for_agent_proxy_flat}>
             </div>
             <div class = "content-input-group">
                <input class="form-control" type="text" name="for_agent_proxy_phone"  placeholder="Телефон" {$query->for_agent_proxy_phone}>
             </div>
        </div>
        </div>
    </div>
</div>
END;

    }
}