<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Document_model extends CI_Model
{
    //------------------------------------------------------------------------------------------------------------------
    // Тестовые переменные
    public $city_contract = "Одесса";
    public $day = "28";
    public $month = "ноября";
    public $year = "2028";
    public $date_of_contract = "";
    public $vendor_name = 'Иван';
    public $vendor_surname = 'Иванов';
    public $vendor_patronymic = 'Иванович';
    public $vendor_fio = "";
    public $vendor_b_day = "28";
    public $vendor_b_month = "апреля";
    public $vendor_b_year = "1997";
    public $vendor_date = "";
    public $vendor_serial_ch = "АВ";
    public $vendor_number_ser = "228911";
    public $vendor_ser_bywho = "Ивановский отдел";
    public $vendor_bywho_d = "11";
    public $vendor_bywho_m = "сентября";
    public $vendor_bywho_y = "2001";
    public $vendor_bywho_date = '';
    public $vendor_city = "Вашингтон";
    public $vendor_street = "Рузвельт стрит";
    public $vendor_house = "42";
    public $vendor_flat = "28";
    public $vendor_adress = '';
    public $vendor_phone = "+38(066)666-66-66";
    public $buyer_surname = "Петров";
    public $buyer_name = "Петр";
    public $buyer_patronymic = "Петрович";
    public $buyer_fio = "Петров Петр Петрович";
    public $buyer_b_day = "19";
    public $buyer_b_month = "декабря";
    public $buyer_b_year = "1994";
    public $buyer_date = "";
    public $buyer_serial_ch = "ПГРЬ";
    public $buyer_number_ser = "11111111";
    public $buyer_ser_bywho = "Петровский отдел";
    public $buyer_bywho_d = "02";
    public $buyer_bywho_m = "октября";
    public $buyer_bywho_y = "2007";
    public $buyer_bywho_date = '';
    public $buyer_city = "Прага";
    public $buyer_street = "Красная улица";
    public $buyer_house = "9";
    public $buyer_flat = "11";
    public $buyer_adress = '';
    public $buyer_phone = "+7(000)333-22-11";
    public $mark = "Ламбаргини";
    public $vin = "8888";
    public $reg_number = "ВЕ 666 ВТ";
    public $car_type = "седан";
    public $category = '';
    public $date_of_product = "22.11.2000";
    public $engine_model = "А4ЕЕ975Т";
    public $shassi = "ШШШ";
    public $carcass = "ККК";
    public $color_carcass = "Белый";
    public $other_parameters = "Освежитель воздуха";
    public $additional_equip = "Ёлочка";
    public $serial_car = "КК";//
    public $number_of_serial_car = "9АЕ22ИС";//
    public $bywho_serial_car = "Римский завод Ламбаргини";
    public $date_of_serial_car = "11.11.2011";
    public $status_of_car = "Впоряде";
    public $ts_day = "42";
    public $ts_month = "сорок второй";
    public $ts_year = "2042";
    public $ts_date = "";
    public $ts_bywho = "Фиксики";
    public $defects_all = "Поломка правого зеркала, царапины на капоте";
    public $defects_rightnow = "царапины на капоте";
    public $features = "Слишком греет печка";
    public $price = "28 000 000";
    public $price_str = "двадцать восемь миллионов";
    public $currency = "рублей";
    public $day_of_pay = "01";
    public $month_of_pay = "01";
    public $year_of_pay = "2016";
    public $date_of_pay = "";
    /*public $serial_car_chars = "ОО";
    public $serial_car_numbers = "23АМ21";*/
    public $day_car = "12";
    public $month_car = "12";
    public $year_car = "2012";
    public $equipment_for_car = "Носовой платок";
    public $other_documents_car = "Другие документы";//Смотря под что приходит
    public $marriage_info = "Имеется в браке";
    public $marriage_number = "777";
    public $penalty = "";
    public $oil_in_car = "95 prime";
    public $vendor_birthday = '';
    public $spouse_surname = 'Леонидов';
    public $spouse_name = "Леонид";
    public $spouse_patronymic = 'Леонидов Леонид Леонидович';
    public $spouse_fio = 'Леонидов Леонид Леонидович';
    public $spouse_pass_serial = 'ЛЛ';
    public $spouse_pass_number = '42284228';
    public $spouse_pass_bywho = 'Леонидовский отдел';
    public $spouse_pass_date = '23.03.2023';
    public $spouse_city = 'Леонидовский город';
    public $spouse_street = 'леонидовская улица';
    public $spouse_house = 'улица 28';
    public $spouse_flat = 'кв. 42';
    public $spouse_adress = '';
    public $spouse_birthday = '';
    public $marriage_svid_serial = 'СОБ';
    public $marriage_svid_number = '777ДЛ666';
    public $marriage_svid_bywho = 'Петровский загс';
    public $marriage_svid_date = '55.05.2005';
    public $gibdd_reg_name = 'Гибддшній отдел';
    public $reg_gov_number = '1223344440';
    public $giver_date = '20.11.1999';
    public $giver_pass = 'Паспорт';
    public $gibdd_inn = 'ИНН228854';
    public $giver_agent = 'Агентовский Агент Агентинович';
    public $giver_agent_pass = 'Паспорт норм у агента';
    public $giver_agent_adress = 'г. Агент, ул. Агентова, дом 11А, кв. 4а';
    public $giver_agent_phone = '+380661715740';
    public $gibdd_power_ingine = '220';
    public $gibdd_eco_class = 'ЕС';
    public $gibdd_max_mass = '444';
    public $gibdd_min_mass = '333';
    public $car_in_marriage = '';
    //
    public $type_of_vendor = 'physical';
    public $type_of_buyer = 'physical';
    public $vendor_law_company_name  = 'OOO "Стрела"';
    public $vendor_law_actor_position = '';
    public $vendor_law_fio = '';
    public $vendor_law_document_osn = '';
    public $vendor_law_proxy_number = '';
    public $vendor_law_proxy_date = '';
    public $buyer_law_company_name = '';
    public $buyer_law_actor_position = '';
    public $buyer_law_fio = '';
    public $buyer_law_document_osn = '';
    public $buyer_law_proxy_number = '';
    public $buyer_law_proxy_date = '';
    public $vendor_ind_fio = '';
    public $vendor_number_of_certificate = '';
    public $vendor_date_of_certificate = '';
    public $buyer_ind_fio = '';
    public $buyer_number_of_certificate = '';
    public $buyer_date_of_certificate = '';
    public $header_doc = ''; //
    public $accessories = "";
    public $id_user = "";
    public $id_document = "";
    public $type_of_contract = "";
    public $vendor_is_owner_car;

    //------------------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $this->load->database();//Работа с бд
        $this->load->library('word');
    }
    //------------------------------------------------------------------------------------------------------------------
    // Запрос и присвание переменных с базы
    public function select_from_database()//Возможно нужно будет разбить для каждого документа свой запрос. Но тогда будет дублироваться запрос одинаковых полей.
    {
        $this->db->select();
        //$id_user = $_SESSION['id_user'] = 1;
        //$id_document = $_SESSION['id_document'] = 1;
        //$where = "id_user = '$id_user' AND id_document = '$id_document'";
        //$this->db->where($where);
        $query = $this->db->get('buy_sale');
        $result_arr = $query->result_array();


        //Тестовый вывод содержимого результата
        /*echo '<pre>';
        print_r($result_arr);
        echo '</pre>';*/
        foreach ($result_arr as $record)
        {
            $this->id_user = $record['id_user'];
            $this->id_document = $record['id'];
            $this->type_of_contract = $record['type_of_contract'];
            $this->city_contract = $record['place_of_contract'];
            $this->date_of_contract = $record['date_of_contract'];
            $this->type_of_vendor = $record['type_of_giver'];
            $this->vendor_is_owner_car = $record['vendor_is_owner_car'];
            $this->vendor_name = $record['vendor_name'];
            $this->vendor_surname = $record['vendor_surname'];
            $this->vendor_patronymic = $record['vendor_patronymic'];
            $this->vendor_date = $record['vendor_birthday'];
            $this->vendor_serial_ch = $record['vendor_passport_serial'];
            $this->vendor_number_ser = $record['vendor_passport_number'];
            $this->vendor_ser_bywho = $record['vendor_passport_bywho'];
            $this->vendor_bywho_date = $record['vendor_passport_date'];
            $this->vendor_city = $record['vendor_city'];
            $this->vendor_street = $record['vendor_street'];
            $this->vendor_house = $record['vendor_house'];
            $this->vendor_flat = $record['vendor_flat'];
            $this->vendor_phone = $record['vendor_phone'];
            $this->type_of_buyer = $record['type_of_buyer'];
            $this->buyer_name = $record['buyer_name'];
            $this->buyer_surname = $record['buyer_surname'];
            $this->buyer_patronymic = $record['buyer_patronymic'];
            $this->buyer_date = $record['buyer_birthday'];
            $this->buyer_serial_ch = $record['buyer_passport_serial'];
            $this->buyer_number_ser = $record['buyer_passport_number'];
            $this->buyer_ser_bywho = $record['buyer_passport_bywho'];
            $this->buyer_bywho_date = $record['buyer_passport_date'];
            $this->buyer_city = $record['buyer_city'];
            $this->buyer_street = $record['buyer_street'];
            $this->buyer_house = $record['buyer_house'];
            $this->buyer_flat = $record['buyer_flat'];
            $this->buyer_phone = $record['buyer_phone'];
            $this->mark = $record['mark'];
            $this->vin = $record['vin'];
            $this->reg_number = $record['reg_gov_number'];
            $this->car_type = $record['car_type'];
            $this->category = $record['category'];
            $this->date_of_product = $record['date_of_product'];
            $this->engine_model = $record['engine_model'];
            $this->shassi = $record['shassi'];
            //$this->carcass = $record[''];Пропущен блок в верстке :с
            $this->color_carcass = $record['color_carcass'];
            $this->other_parameters = $record['other_parametrs'];
            $this->additional_equip = $record['additional_devices'];
            $this->serial_car = $record['serial_car'];
            $this->number_of_serial_car = $record['number_of_serial_car'];
            $this->bywho_serial_car = $record['bywho_serial_car'];
            $this->date_of_serial_car = $record['date_of_serial_car'];
            $this->status_of_car = $record['car_allstatus'];
            $this->ts_date = $record['maintenance_date'];
            $this->ts_bywho = $record['maintenance_bywho'];
            $this->defects_all = $record['defects'];
            //$this->defects_rightnow = $record[''];Где в алгоритме этот пункт вообще? Вопрос заказчику.
            $this->features = $record['features'];
            $this->price = $record['price_car'];
            $this->currency = $record['currency'];
            $this->date_of_pay = $record['payment_date'];
            //$this->date_of_car = $record[''];
            $this->other_documents_car = $record['documents'];
            $this->accessories = $record['accessories'];
            $this->car_in_marriage = $record['car_in_marriage'];
            $this->penalty = $record['penalty'];
            $this->oil_in_car = $record['oil_in_car'];
            $this->spouse_name = $record['spouse_name'];
            $this->spouse_surname = $record['spouse_surname'];
            $this->spouse_patronymic = $record['spouse_patronymic'];
            $this->spouse_birthday = $record['spouse_birthday'];
            $this->spouse_pass_serial = $record['spouse_pass_serial'];
            $this->spouse_pass_number = $record['spouse_pass_number'];
            $this->spouse_pass_bywho = $record['spouse_pass_bywho'];
            $this->spouse_pass_date = $record['spouse_pass_date'];
            $this->spouse_city = $record['spouse_city'];
            $this->spouse_street = $record['spouse_street'];
            $this->spouse_house = $record['spouse_house'];
            $this->spouse_flat = $record['spouse_flat'];
            $this->marriage_svid_serial = $record['marriage_svid_serial'];
            $this->marriage_svid_number = $record['marriage_svid_number'];
            $this->marriage_svid_bywho = $record['marriage_svid_bywho'];
            $this->marriage_svid_date = $record['marriage_svid_date'];
        }

        $this->format_all_data();// Форматированние полученных переменных в нужный формат.(дата, фио, адрес)*/
        $this->get_doc_buy_sale();
    }
    //------------------------------------------------------------------------------------------------------------------
    public function format_date($day, $month, $year)
    {
        $date = '"'. $day . '" ' . $month . ' ' . $year . 'г.';
        return $date;
    }
    //------------------------------------------------------------------------------------------------------------------
    public function format_adress($city, $street, $house, $flat)
    {
        $adress = $city .', '. $street .', '. $house .', '. $flat;
        return $adress;
    }
    //------------------------------------------------------------------------------------------------------------------
    public function format_fio($surname, $name, $patronymic)
    {
        $fio = $surname .' '. $name . ' '. $patronymic;
        return $fio;
    }
    //------------------------------------------------------------------------------------------------------------------
   public function format_all_data()
   {
       //Форматирование даты
       /*
       $this->vendor_bywho_date = $this->format_date($this->vendor_bywho_d, $this->vendor_bywho_m, $this->vendor_bywho_y);
       $this->buyer_bywho_date = $this->format_date($this->buyer_bywho_d, $this->buyer_bywho_m, $this->buyer_bywho_y);
       $this->vendor_birthday = $this->format_date($this->vendor_b_day, $this->vendor_b_month, $this->vendor_b_year);
       $this->date_of_contract = $this->format_date($this->day, $this->month, $this->year);
       $this->date_of_serial_car = $this->format_date($this->day, $this->month, $this->year);
       */
       //Форматирование адреса
       $this->vendor_adress = $this->format_adress($this->vendor_city, $this->vendor_street, $this->vendor_house, $this->vendor_flat);
       $this->buyer_adress = $this->format_adress($this->buyer_city, $this->buyer_street, $this->buyer_house, $this->buyer_flat);
       $this->spouse_adress = $this->format_adress($this->spouse_city, $this->spouse_street, $this->spouse_house, $this->spouse_flat);
       //Форматирование ФИО
        $this->vendor_fio = $this->format_fio($this->vendor_surname, $this->vendor_name, $this->vendor_patronymic);
        $this->buyer_fio = $this->format_fio($this->buyer_surname, $this->buyer_name, $this->buyer_patronymic);
        $this->spouse_fio = $this->format_fio($this->spouse_surname, $this->spouse_name, $this->spouse_patronymic);
       return true;
   }
    //------------------------------------------------------------------------------------------------------------------
    public function set_pack_of_documents($type_of_vendor, $type_of_buyer)
    {
        if ($type_of_vendor == 'physical' && $type_of_buyer == 'physical')
        {
            $this->get_doc_buy_sale();
            $this->get_doc_act_of_reception();
            $this->get_doc_receipt_of_money();
            $this->get_doc_statement_gibdd();
            $this->get_doc_statement_vendor_marriage();
        }
        elseif ($type_of_vendor == 'law' && $type_of_buyer == 'law')
        {
            $this->get_doc_buy_sale();
            $this->get_doc_act_of_reception();
            $this->get_doc_statement_gibdd();
        }
    }
    //------------------------------------------------------------------------------------------------------------------

    //Функция вывода заголовка документа
    /*Анализирует лица, между которыми заключается договор и возвращает переменную, в которой содержиться правильный вариант текста*/
    public function set_header_doc($type_of_vendor, $type_of_buyer) //law //physical //individual
    {
        if ($type_of_vendor == 'physical' && $type_of_buyer == 'physical')
        {
            $header = 'Гражданин ' . $this->vendor_fio . ', далее именуемый "Продавец", с одной стороны, и гражданин ' . $this->buyer_fio . ', далее именуемый "Покупатель", с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'law' && $type_of_buyer == 'law')
        {
            $header = $this->vendor_law_company_name .', далее именуемое "Продавец", в лице'. $this->vendor_law_actor_position .', '. $this->vendor_law_fio .', действующего на основании '. $this->vendor_law_document_osn . ' №'.$this->vendor_law_proxy_number. 'от'.$this->vendor_law_proxy_date.' , с одной стороны, и '.$this->buyer_law_company_name.', далее именуемое "Покупатель", в лице' . $this->buyer_law_actor_position .', '. $this->buyer_law_fio .', действующего на основании '. $this->buyer_law_document_osn . ' №'.$this->buyer_law_proxy_number. ' от'.$this->buyer_law_proxy_date.', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'physical' && $type_of_buyer == 'law')
        {
            $header = 'Гражданин' . $this->vendor_fio . ', далее именуемый "Продавец", с одной стороны и '.$this->buyer_law_company_name.', далее именуемое "Покупатель", в лице' . $this->buyer_law_actor_position .', '. $this->buyer_law_fio .', действующего на основании '. $this->buyer_law_document_osn . ' №'.$this->buyer_law_proxy_number. ' от'.$this->buyer_law_proxy_date.', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'law' && $type_of_buyer == 'physical')
        {
            $header = $this->vendor_law_company_name .', далее именуемое "Продавец", в лице'. $this->vendor_law_actor_position .', '. $this->vendor_law_fio .', действующего на основании '. $this->vendor_law_document_osn . ' №'.$this->vendor_law_proxy_number. 'от'.$this->vendor_law_proxy_date.' , с одной стороны и гражданин '. $this->buyer_fio . ', далее именуемый "Покупатель", с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'physical' && $type_of_buyer == 'individual')
        {
            $header =  'Гражданин' . $this->vendor_fio . ', далее именуемый "Продавец", с одной стороны и '.$this->buyer_ind_fio.', далее именуемый "Покупатель",  действующий на основании свидетельства индивидуального предпринимателя №'.$this->buyer_number_of_certificate.' от '.$this->buyer_date_of_certificate.', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'individual' && $type_of_buyer == 'physical')
        {
            $header = $this->vendor_ind_fio.', далее именуемый "Продавец", действующий на основании свидетельства индивидуального предпринимателя №'.$this->vendor_number_of_certificate.' от '.$this->vendor_date_of_certificate.', с одной стороны и гражданин '.$this->buyer_fio.', далее именуемый "Покупатель", с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'law' && $type_of_buyer == 'individual')
        {
            $header = $this->vendor_law_company_name .', далее именуемое "Продавец", в лице'. $this->vendor_law_actor_position .', '. $this->vendor_law_fio .', действующего на основании '. $this->vendor_law_document_osn . ' №'.$this->vendor_law_proxy_number. 'от'.$this->vendor_law_proxy_date.'с одной стороны и '.$this->buyer_ind_fio.', далее именуемый "Покупатель",  действующий на основании свидетельства индивидуального предпринимателя №'.$this->buyer_number_of_certificate.' от '.$this->buyer_date_of_certificate.', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'individual' && $type_of_buyer == 'law')
        {
            $header = $this->vendor_ind_fio.', далее именуемый "Продавец", действующий на основании свидетельства индивидуального предпринимателя №'.$this->vendor_number_of_certificate.' от '.$this->vendor_date_of_certificate.', с одной стороны и '.$this->buyer_law_company_name.', далее именуемое "Покупатель", в лице' . $this->buyer_law_actor_position .', '. $this->buyer_law_fio .', действующего на основании '. $this->buyer_law_document_osn . ' №'.$this->buyer_law_proxy_number. ' от'.$this->buyer_law_proxy_date.', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';        }
        else $header = 'Incorrect type of vendor/buyer.Type of vendor = '.$type_of_vendor.', Type of buyer = '.$type_of_buyer;
        return $header;
    }
    //------------------------------------------------------------------------------------------------------------------
    public function get_marriage_info($car_in_marriage)
    {
        if ($car_in_marriage == true)
        {
            // Если продавец в браке то
            $this->marriage_info ="<w:br/>4.4. Продавец довел до Покупателя сведения о том, что транспортное средство приобретено им в период брака на совместные денежные средства с супругой(ом)".$this->spouse_fio."и является совместным имуществом супругов. По заявлению Продавца договор заключается по обоюдному согласию супругов, Покупатель ознакомлен с содержанием указанного заявления. ";
            $this->marriage_number = 5; //номер следующего пункта
        }
        elseif ($car_in_marriage == false)
        {
            //Если не в браке
            $this->marriage_info = "";//пропускаем этот пункт
            $this->marriage_number = 4; //номер следующего пункта
        }
    }
    //------------------------------------------------------------------------------------------------------------------
    //договор купли-продажи транспортного средства
    public function get_doc_buy_sale()
    {
        // Подготовка
        $document = $this->word->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/patterns/buy_sale_deal.docx');

        // Задание значений
        $document->setValue('city_contract', $this->city_contract);
        $document->setValue('date_of_contract',  $this->date_of_contract);
        $this->header_doc = $this->set_header_doc($this->type_of_vendor, $this->type_of_buyer);
        $document->setValue('header_doc', $this->header_doc);

        $document->setValue('vendor_fio', $this->vendor_fio);
        $document->setValue('vendor_date', $this->vendor_date);
        $document->setValue('vendor_serial_ch', $this->vendor_serial_ch);
        $document->setValue('vendor_number_ser', $this->vendor_number_ser);
        $document->setValue('vendor_ser_bywho', $this->vendor_ser_bywho);
        $document->setValue('vendor_bywho_d', $this->vendor_bywho_d);
        $document->setValue('vendor_bywho_m', $this->vendor_bywho_m);
        $document->setValue('vendor_bywho_y', $this->vendor_bywho_y);
        $document->setValue('vendor_adress', $this->vendor_adress);
        $document->setValue('vendor_phone', $this->vendor_phone);

        $document->setValue('buyer_fio', $this->buyer_fio);
        $document->setValue('buyer_date', $this->buyer_date);
        $document->setValue('buyer_serial_ch', $this->buyer_serial_ch);
        $document->setValue('buyer_number_ser', $this->buyer_number_ser);
        $document->setValue('buyer_ser_bywho', $this->buyer_ser_bywho);
        $document->setValue('buyer_bywho_d', $this->buyer_bywho_d);
        $document->setValue('buyer_bywho_m', $this->buyer_bywho_m);
        $document->setValue('buyer_bywho_y', $this->vendor_bywho_y);
        $document->setValue('buyer_adress', $this->buyer_adress);
        $document->setValue('buyer_phone', $this->buyer_phone);

        $document->setValue('mark', $this->mark);
        $document->setValue('vin', $this->vin);
        $document->setValue('reg_number', $this->reg_number);
        $document->setValue('car_type', $this->car_type);
        $document->setValue('category', $this->category);
        $document->setValue('date_of_product', $this->date_of_product);
        $document->setValue('engine_model', $this->engine_model);
        $document->setValue('shassi', $this->shassi);
        $document->setValue('carcass', $this->carcass);
        $document->setValue('color_carcass', $this->color_carcass);
        $document->setValue('other_parameters', $this->other_parameters);
        $document->setValue('additional_equip', $this->additional_equip);
        $document->setValue('serial_car', $this->serial_car);
        $document->setValue('number_of_serial_car', $this->number_of_serial_car);
        $document->setValue('bywho_serial_car', $this->bywho_serial_car);
        $document->setValue('date_of_serial_car', $this->date_of_serial_car);
        $document->setValue('status_of_car', $this->status_of_car);
        $document->setValue('ts_date', $this->ts_date);
        $document->setValue('ts_bywho', $this->ts_bywho);
        $document->setValue('defects_all', $this->defects_all);
        //$document->setValue('defects_rightnow', $this->defects_rightnow);
        $document->setValue('features', $this->features);
        $document->setValue('price', $this->price);
        $document->setValue('price_str', $this->price_str);
        $document->setValue('date_of_pay', $this->date_of_pay);
        $document->setValue('other_documents_car', $this->other_documents_car);
        $document->setValue('accessories', $this->accessories);

        $this->get_marriage_info($this->car_in_marriage);
        $document->setValue('marriage_info', $this->marriage_info);
        $document->setValue('marriage_number', $this->marriage_number);

        $document->setValue('penalty', $this->penalty);


        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'. time() .'buy_sale_deal.docx';//Имя файла и путь к нему
        //setcookie('name_of_doc',$name_of_file);
        $document->save($name_of_file); // Сохранение документа
        echo 'File created.';
    }
    //------------------------------------------------------------------------------------------------------------------
    //договор дарения
    public function get_doc_gift()
    {

    }
    //------------------------------------------------------------------------------------------------------------------
    //акт приема-передачи автомобиля
    public function get_doc_act_of_reception()
    {
        $document = $this->word->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/patterns/act_of_reception.docx');

        //Задание значений переменных
        $document->setValue('city_contract', $this->city_contract);
        $document->setValue('day', $this->day);
        $document->setValue('month', $this->month);
        $document->setValue('year', $this->year);

        $document->setValue('vendor_fio', $this->vendor_fio);
        $document->setValue('buyer_fio', $this->buyer_fio);
        $document->setValue('mark', $this->mark);
        $document->setValue('vin', $this->vin);
        $document->setValue('reg_number', $this->reg_number);
        $document->setValue('car_type', $this->car_type);
        $document->setValue('date_of_product', $this->date_of_product);
        $document->setValue('engine_model', $this->engine_model);
        $document->setValue('shassi', $this->shassi);
        $document->setValue('carcass', $this->carcass);
        $document->setValue('color_carcass', $this->color_carcass);
        $document->setValue('other_parameters', $this->other_parameters);
        $document->setValue('serial_car', $this->serial_car);
        $document->setValue('number_of_serial_car', $this->number_of_serial_car);
        $document->setValue('bywho_serial_car', $this->bywho_serial_car);
        $document->setValue('date_of_serial_car', $this->date_of_serial_car);
        $document->setValue('additional_equip', $this->additional_equip);
        $document->setValue('oil_in_car', $this->oil_in_car);
        $document->setValue('defects_all', $this->defects_all);
        $document->setValue('features', $this->features);

        //Вопросы по пост-пунткам пунтка 7

        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'. time() .'act_of_reception.docx';//Имя файла и путь к нему
        //setcookie('name_of_doc',$name_of_file);
        $document->save($name_of_file); // Сохранение документа
        echo 'File created.';
    }
    //------------------------------------------------------------------------------------------------------------------
    //расписка в получении денежных средств
    public function get_doc_receipt_of_money()
    {
        $document = $this->word->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/patterns/receipt_of_money.docx');

        //Задание значений переменных
        $document->setValue('city_contract', $this->city_contract);
        $document->setValue('day', $this->day);
        $document->setValue('month', $this->month);
        $document->setValue('year', $this->year);

        $document->setValue('vendor_fio', $this->vendor_fio);
        $document->setValue('vendor_serial_ch', $this->vendor_serial_ch);
        $document->setValue('vendor_number_ser', $this->vendor_number_ser);
        $document->setValue('vendor_ser_bywho', $this->vendor_ser_bywho);
        $document->setValue('vendor_bywho_date', $this->vendor_bywho_date);
        $document->setValue('vendor_adress', $this->vendor_adress);

        $document->setValue('buyer_fio', $this->buyer_fio);
        $document->setValue('buyer_serial_ch', $this->buyer_serial_ch);
        $document->setValue('buyer_number_ser', $this->buyer_number_ser);
        $document->setValue('buyer_ser_bywho', $this->buyer_ser_bywho);
        $document->setValue('buyer_bywho_date', $this->buyer_bywho_date);
        $document->setValue('buyer_adress', $this->buyer_adress);

        $document->setValue('price', $this->price);
        $document->setValue('price_str', $this->price_str);
        $document->setValue('currency', $this->currency);


        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'. time() .'receipt_of_money.docx';//Имя файла и путь к нему
        //setcookie('name_of_doc',$name_of_file);
        $document->save($name_of_file); // Сохранение документа
        echo 'File created.';
    }
    //------------------------------------------------------------------------------------------------------------------
    //заявление в ГИБДД для смены собственника
    public function get_doc_statement_gibdd()
    {
        $document = $this->word->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/patterns/gibdd.docx');

        $document->setValue('gibdd_reg_name', $this->gibdd_reg_name);
        $document->setValue('buyer_fio', $this->buyer_fio);
        $document->setValue('mark', $this->mark);
        $document->setValue('date_of_product', $this->date_of_product);
        $document->setValue('vin', $this->vin);
        $document->setValue('reg_gov_number', $this->reg_gov_number);
        $document->setValue('giver_date', $this->giver_date);
        $document->setValue('giver_pass', $this->giver_pass);
        $document->setValue('gibdd_inn', $this->gibdd_inn);
        $document->setValue('giver_adress', $this->vendor_adress);//Вендор = гивер?
        $document->setValue('giver_phone', $this->vendor_phone);
        $document->setValue('giver_agent', $this->giver_agent);
        $document->setValue('giver_agent_pass', $this->giver_agent_pass);
        $document->setValue('giver_agent_adress', $this->giver_agent_adress);
        $document->setValue('giver_agent_phone', $this->giver_agent_phone);
        $document->setValue('mark', $this->mark);
        $document->setValue('date_of_product', $this->date_of_product);
        $document->setValue('car_type', $this->car_type);
        $document->setValue('color_carcass', $this->color_carcass);
        $document->setValue('reg_number', $this->reg_number);
        $document->setValue('vin', $this->vin);
        $document->setValue('carcass', $this->carcass);
        $document->setValue('shassi', $this->shassi);
        $document->setValue('gibdd_power_ingine', $this->gibdd_power_ingine);
        $document->setValue('gibdd_eco_class', $this->gibdd_eco_class);
        $document->setValue('gibdd_max_mass', $this->gibdd_max_mass);
        $document->setValue('gibdd_min_mass', $this->gibdd_min_mass);

        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'. time() .'gibdd.docx';//Имя файла и путь к нему
        //setcookie('name_of_doc',$name_of_file);
        $document->save($name_of_file); // Сохранение документа
        echo 'File created.';
    }
    //------------------------------------------------------------------------------------------------------------------
    //заявление продавца о согласии супруга
    public function get_doc_statement_vendor_marriage()
    {
        $document = $this->word->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/patterns/statement_vendor_marriage.docx');

        $document->setValue('date_of_contract', $this->date_of_contract);
        $document->setValue('buyer_fio', $this->buyer_fio);
        $document->setValue('vendor_fio', $this->vendor_fio);
        $document->setValue('vendor_birthday', $this->vendor_birthday);
        $document->setValue('vendor_serial', $this->vendor_serial_ch);
        $document->setValue('vendor_numbers', $this->vendor_number_ser);
        $document->setValue('vendor_passport_bywho', $this->vendor_ser_bywho);
        $document->setValue('vendor_passport_date', $this->vendor_bywho_date);
        $document->setValue('vendor_adress', $this->vendor_adress);
        $document->setValue('place_of_contract', $this->city_contract);
        $document->setValue('reg_number', $this->reg_number);
        $document->setValue('vin', $this->vin);
        $document->setValue('date_of_product', $this->date_of_product);
        $document->setValue('engine_model', $this->engine_model);
        $document->setValue('carcass', $this->carcass);
        $document->setValue('serial_car', $this->serial_car);
        $document->setValue('number_of_serial_car', $this->number_of_serial_car);
        $document->setValue('bywho_serial_car', $this->bywho_serial_car);
        $document->setValue('date_of_serial_car', $this->date_of_serial_car);
        $document->setValue('spouse_fio', $this->spouse_fio);
        $document->setValue('spouse_pass_serial', $this->spouse_pass_serial);
        $document->setValue('spouse_pass_number', $this->spouse_pass_number);
        $document->setValue('spouse_pass_bywho', $this->spouse_pass_bywho);
        $document->setValue('spouse_pass_date', $this->spouse_pass_date);
        $document->setValue('spouse_adress', $this->spouse_adress);
        $document->setValue('marriage_svid_serial', $this->marriage_svid_serial);
        $document->setValue('marriage_svid_number', $this->marriage_svid_number);
        $document->setValue('marriage_svid_bywho', $this->marriage_svid_bywho);
        $document->setValue('marriage_svid_date', $this->marriage_svid_date);
        $document->setValue('price', $this->price);
        $document->setValue('price_str', $this->price_str);



        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'. time() .'statement_vendor_marriage.docx';//Имя файла и путь к нему
        //setcookie('name_of_doc',$name_of_file);
        $document->save($name_of_file); // Сохранение документа
        echo 'File created.';
    }
    //------------------------------------------------------------------------------------------------------------------
    //договор аренды
   /* public function get_doc_rent()
    {

    }*/
    //------------------------------------------------------------------------------------------------------------------
    public function insert_into_database()
    {
        $data = array
        (
            'id_user' => $_SESSION['id_user'],
            'type_of_contract' => $_POST['type_of_contract'],
            'place_of_contract' => $_POST['place_of_contract'],
            'date_of_contract' => $_POST['date_of_contract'],
            'type_of_giver' => $_POST['type_of_giver'],
            'vendor_is_owner_car' => $_POST['vendor_is_owner_car'],
            'vendor_surname' => $_POST['vendor_surname'],
            'vendor_name' => $_POST['vendor_name'],
            'vendor_patronymic' => $_POST['vendor_patronymic'],
            'vendor_birthday' => $_POST['vendor_birthday'],
            'vendor_passport_serial' => $_POST['vendor_passport_serial'],
            'vendor_passport_number' => $_POST['vendor_passport_number'],
            'vendor_passport_date' => $_POST['vendor_passport_date'],
            'vendor_passport_bywho' => $_POST['vendor_passport_bywho'],
            'vendor_city' => $_POST['vendor_city'],
            'vendor_street' => $_POST['vendor_street'],
            'vendor_house' => $_POST['vendor_house'],
            'vendor_flat' => $_POST['vendor_flat'],
            'vendor_phone' => $_POST['vendor_phone'],
            'type_of_buyer' => $_POST['type_of_taker'],
            'buyer_surname' => $_POST['buyer_surname'],
            'buyer_name' => $_POST['buyer_name'],
            'buyer_patronymic' => $_POST['buyer_patronymic'],
            'buyer_birthday' => $_POST['buyer_birthday'],
            'buyer_passport_serial' => $_POST['buyer_passport_serial'],
            'buyer_passport_number' => $_POST['buyer_passport_number'],
            'buyer_passport_date' => $_POST['buyer_passport_date'],
            'buyer_passport_bywho' => $_POST['buyer_passport_bywho'],
            'buyer_city' => $_POST['buyer_city'],
            'buyer_street' => $_POST['buyer_street'],
            'buyer_house' => $_POST['buyer_house'],
            'buyer_flat' => $_POST['buyer_flat'],
            'buyer_phone' => $_POST['buyer_phone'],
            'mark' => $_POST['mark'],
            'vin' => $_POST['vin'],
            'reg_gov_number' => $_POST['reg_gov_number'],
            'car_type' => $_POST['car_type'],
            'category' => $_POST['category'],
            'date_of_product' => $_POST['date_of_product'],
            'engine_model' => $_POST['engime_model'],
            'shassi' => $_POST['shassi'],
            'color_carcass' => $_POST['color_carcass'],
            'other_parametrs' => $_POST['other_parametrs'],
            'serial_car' => $_POST['serial_car'],
            'number_of_serial_car' => $_POST['number_of_serial_car'],
            'date_of_serial_car' => $_POST['date_of_serial_car'],
            'bywho_serial_car' => $_POST['bywho_serial_car'],
            'price_car' => $_POST['price_car'],
            'currency' => $_POST['currency'],
            'additional_devices' => $_POST['additional_devices'],
            'oil_in_car' => $_POST['oil_in_car'],
            'car_allstatus' => $_POST['car_allstatus'],
            'maintenance_date' => $_POST['maintenance_date'],
            'maintenance_bywho' => $_POST['maintenance_bywho'],
            'defects' => $_POST['defects'],
            'features' => $_POST['features'],
            'payment_date' => $_POST['payment_date'],
            'documents' => $_POST['documents'],
            'accessories' => $_POST['accessories'],
            'car_in_marriage' => $_POST['car_in_marriage'],
            'spouse_surname' => $_POST['spouse_surname'],
            'spouse_name' => $_POST['spouse_name'],
            'spouse_patronymic' => $_POST['spouse_patronymic'],
            'spouse_birthday' => $_POST['spouse_birthday'],
            'spouse_pass_serial' => $_POST['spouse_pass_serial'],
            'spouse_pass_number' => $_POST['spouse_pass_number'],
            'spouse_pass_date' => $_POST['spouse_pass_date'],
            'spouse_pass_bywho' => $_POST['spouse_pass_bywho'],
            'spouse_city' => $_POST['spouse_city'],
            'spouse_street' => $_POST['spouse_street'],
            'spouse_house' => $_POST['spouse_house'],
            'spouse_flat' => $_POST['spouse_flat'],
            'marriage_svid_serial' => $_POST['marriage_svid_serial'],
            'marriage_svid_number' => $_POST['marriage_svid_number'],
            'marriage_svid_date' => $_POST['marriage_svid_date'],
            'marriage_svid_bywho' => $_POST['marriage_svid_bywho'],
            'penalty' => $_POST['penalty']

        );
        //Бизопаснасть
        foreach ($data as $key)
        {
            mysql_real_escape_string($key);
        }
        //Отправка данных
        $this->db->insert('buy_sale', $data);
        echo 'query-insert was complete.';

    }

    //------------------------------------------------------------------------------------------------------------------
    public function save_info($post = array())
    {

        $instruments = json_encode($post['instruments']);  //  {key:value,..}
        /// прочитать защиту sql
        $instruments = json_decode($instruments);
        $data = array(
            'name' => $post['name']
        );
    }
}