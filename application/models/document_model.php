<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Document_model extends CI_Model
{
    //------------------------------------------------------------------------------------------------------------------
    // Тестовые переменные
   /* public $city_contract = "Одесса";
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
    public $vendor_is_owner_car;*/

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
        $result = $query->row();

        //Тестовый вывод содержимого результата
        echo '<pre>';
        print_r($result);
        //echo $result->place_of_contract;
        echo '</pre>';
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
    public function json_to_string($target)
    {
        $quantity = count($target);
        $last_element = $quantity-1;//Ибо счет с нуля
        if ($quantity == 1)
        {
            $string = $target[0];
        }
        elseif ($quantity > 1)
        {
            $string = $target[0];
            for ($i = 1; $i<$quantity; $i++)
            {
                $string .= ", " . $target[$i];
            }
            $string .= ", " . $target[$last_element] . ".";
        }
        else $string = "Error, Quantity <0";

        return $string;
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

       //Форматирование адреса
       $this->vendor_adress = $this->format_adress($this->vendor_city, $this->vendor_street, $this->vendor_house, $this->vendor_flat);
       $this->buyer_adress = $this->format_adress($this->buyer_city, $this->buyer_street, $this->buyer_house, $this->buyer_flat);
       $this->spouse_adress = $this->format_adress($this->spouse_city, $this->spouse_street, $this->spouse_house, $this->spouse_flat);
       //Форматирование ФИО
        $this->vendor_fio = $this->format_fio($this->vendor_surname, $this->vendor_name, $this->vendor_patronymic);
        $this->buyer_fio = $this->format_fio($this->buyer_surname, $this->buyer_name, $this->buyer_patronymic);
        $this->spouse_fio = $this->format_fio($this->spouse_surname, $this->spouse_name, $this->spouse_patronymic);
       return true;
       */
   }
    //------------------------------------------------------------------------------------------------------------------
    //Функция вывода заголовка документа
    /*Анализирует лица, между которыми заключается договор и возвращает переменную, в которой содержиться правильный вариант текста*/
    public function set_header_doc($type_of_vendor, $type_of_buyer, $data_for_header) //law //physical //individual
    {
        if ($type_of_vendor == 'physical' && $type_of_buyer == 'physical')
        {
            $header = 'Граж$данин ' . $data_for_header['vendor_fio'] . ', далее именуемый "Продавец", с одной стороны, и гражданин ' . $data_for_header['buyer_fio'] . ', далее именуемый "Покупатель", с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'law' && $type_of_buyer == 'law')
        {
            $header = $data_for_header['vendor_law_company_name'].', далее именуемое "Продавец", в лице'. $data_for_header['vendor_law_actor_position'].', '. $data_for_header['vendor_law_fio'].', действующего на основании '. $data_for_header['vendor_law_document_osn']. ' №'.$data_for_header['vendor_law_proxy_number']. 'от'.$data_for_header['vendor_law_proxy_date'].' , с одной стороны, и '.$data_for_header['buyer_law_company_name'].', далее именуемое "Покупатель", в лице' . $data_for_header['buyer_law_actor_position'].', '. $data_for_header['buyer_law_fio'].', действующего на основании '. $data_for_header['buyer_law_document_osn']. ' №'.$data_for_header['buyer_law_proxy_number']. ' от'.$data_for_header['buyer_law_proxy_date'].', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'physical' && $type_of_buyer == 'law')
        {
            $header = 'Гражданин' . $data_for_header['vendor_fio']. ', далее именуемый "Продавец", с одной стороны и '.$data_for_header['buyer_law_company_name'].', далее именуемое "Покупатель", в лице' . $data_for_header['buyer_law_actor_position '].', '. $data_for_header['buyer_law_fio'].', действующего на основании '. $data_for_header['buyer_law_document_osn']. ' №'.$data_for_header['buyer_law_proxy_number']. ' от'.$data_for_header['buyer_law_proxy_date'].', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'law' && $type_of_buyer == 'physical')
        {
            $header = $data_for_header['vendor_law_company_name'].', далее именуемое "Продавец", в лице'. $data_for_header['vendor_law_actor_position'].', '. $data_for_header['vendor_law_fio'].', действующего на основании '. $data_for_header['vendor_law_document_osn']. ' №'.$data_for_header['vendor_law_proxy_number']. 'от'.$data_for_header['vendor_law_proxy_date'].' , с одной стороны и гражданин '. $data_for_header['buyer_fio']. ', далее именуемый "Покупатель", с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'physical' && $type_of_buyer == 'individual')
        {
            $header =  'Гражданин' . $data_for_header['vendor_fio ']. ', далее именуемый "Продавец", с одной стороны и '.$data_for_header['buyer_ind_fio'].', далее именуемый "Покупатель",  действующий на основании свидетельства индивидуального предпринимателя №'.$data_for_header['buyer_number_of_certificate'].' от '.$data_for_header['buyer_date_of_certificate'].', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'individual' && $type_of_buyer == 'physical')
        {
            $header = $data_for_header['vendor_ind_fio'].', далее именуемый "Продавец", действующий на основании свидетельства индивидуального предпринимателя №'.$data_for_header['vendor_number_of_certificate'].' от '.$data_for_header['vendor_date_of_certificate'].', с одной стороны и гражданин '.$data_for_header['buyer_fio'].', далее именуемый "Покупатель", с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'law' && $type_of_buyer == 'individual')
        {
            $header = $data_for_header['vendor_law_company_name '].', далее именуемое "Продавец", в лице'. $data_for_header['vendor_law_actor_position '].', '. $data_for_header['vendor_law_fio '].', действующего на основании '. $data_for_header['vendor_law_document_osn ']. ' №'.$data_for_header['vendor_law_proxy_number']. 'от'.$data_for_header['vendor_law_proxy_date'].'с одной стороны и '.$data_for_header['buyer_ind_fio'].', далее именуемый "Покупатель",  действующий на основании свидетельства индивидуального предпринимателя №'.$data_for_header['buyer_number_of_certificate'].' от '.$data_for_header['buyer_date_of_certificate'].', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'individual' && $type_of_buyer == 'law')
        {
            $header = $data_for_header['vendor_ind_fio'].', далее именуемый "Продавец", действующий на основании свидетельства индивидуального предпринимателя №'.$data_for_header['vendor_number_of_certificate'].' от '.$data_for_header['vendor_date_of_certificate'].', с одной стороны и '.$data_for_header['buyer_law_company_name'].', далее именуемое "Покупатель", в лице' . $data_for_header['buyer_law_actor_position '].', '. $data_for_header['buyer_law_fio '].', действующего на основании '. $data_for_header['buyer_law_document_osn ']. ' №'.$data_for_header['buyer_law_proxy_number']. ' от'.$data_for_header['buyer_law_proxy_date']. ', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';        }
        else $header = 'Incorrect type of vendor/buyer.Type of vendor = '.$type_of_vendor.', Type of buyer = '.$type_of_buyer;
        return $header;
    }
    //------------------------------------------------------------------------------------------------------------------
    public function get_marriage_info($car_in_marriage, $spouse_fio)
    {
        $marriage = array();
        if ($car_in_marriage == true)
        {
            // Если продавец в браке то
            $marriage['info'] ="<w:br/>4.4. Продавец довел до Покупателя сведения о том, что транспортное средство приобретено им в период брака на совместные денежные средства с супругой(ом)".$spouse_fio."и является совместным имуществом супругов. По заявлению Продавца договор заключается по обоюдному согласию супругов, Покупатель ознакомлен с содержанием указанного заявления. ";
            $marriage['number'] = 5; //номер следующего пункта
        }
        elseif ($car_in_marriage == false)
        {
            //Если не в браке
            $marriage['info'] = "";//пропускаем этот пункт
            $marriage['number'] = 4; //номер следующего пункта
        }

        return $marriage;
    }
    //------------------------------------------------------------------------------------------------------------------
    //договор купли-продажи транспортного средства
    public function get_doc_buy_sale($id)
    {
        //Работа с базой
        $this->db->select();
        $id_user = $this->data['user_id'];
        $where = "id_user = '$id_user' AND id = '$id '";
        $this->db->where($where);
        $query = $this->db->get('buy_sale');
        $result = $query->row();

        // Подготовка данных для работы с документов
        $vendor_fio = $this->format_fio($result->vendor_surname, $result->vendor_name, $result->vendor_patronymic);
        $vendor_adress = $this->format_adress($result->vendor_city,$result->vendor_street,$result->vendor_house,$result->vendor_flat);
        $buyer_fio = $this->format_fio($result->buyer_surname,$result->buyer_name,$result->buyer_patronymic);
        $buyer_adress = $this->format_adress($result->buyer_city,$result->buyer_street,$result->buyer_house,$result->buyer_flat);
        //$vendor_law_fio = $this->format_fio($result->vendor_law_surname,$result->vendor_law_name,$result->vendor_law_patronymic);
        //$buyer_law_fio = $this->format_fio($result->buyer_law_surname,$result->buyer_law_name,$result->buyer_law_patronymic);
        //$vendor_ind_fio = $this->format_fio($result->vendor_ind_surname,$result->vendor_ind_name,$result->vendor_ind_patronymic);
        //$buyer_ind_fio = $this->format_fio($result->buyer_ind_surname,$result->buyer_ind_name,$result->buyer_ind_patronymic);
        $spouse_fio = $this->format_fio($result->spouse_surname,$result->spouse_name,$result->spouse_patronymic);
        $marriage = $this->get_marriage_info($result->car_in_marriage, $spouse_fio);
        $other_documents_car = $this->json_to_string($result->documents);
        $accessories = $this->json_to_string($result->accessories);
        $data_for_header = array(
            'vendor_fio' => $vendor_fio,
            'buyer_fio' => $buyer_fio,
            'vendor_law_company_name' => $result->vendor_law_company_name,
            'vendor_law_actor_position' => $result->vendor_law_actor_position,
            //'vendor_law_fio' => $vendor_law_fio,
            'vendor_law_document_osn' => $result->vendor_law_document_osn,
            'vendor_law_proxy_number' => $result->vendor_law_proxy_number,
            'vendor_law_proxy_date' => $result->vendor_law_proxy_date,
            'buyer_law_company_name' => $result->buyer_law_company_name,
            'buyer_law_actor_position' => $result->buyer_law_actor_position,
            //'buyer_law_fio' => $buyer_law_fio,
            'buyer_law_document_osn' => $result->buyer_law_document_osn,
            'buyer_law_proxy_number' => $result->buyer_law_proxy_number,
            'buyer_law_proxy_date' => $result->buyer_law_proxy_date,
            //'vendor_ind_fio' => $result->vendor_ind_fio,
            'vendor_number_of_certificate' => $result->vendor_number_of_certificate,
            'vendor_date_of_certificate' => $result->vendor_date_of_certificate,
            //'buyer_ind_fio' => $result->buyer_ind_fio,
            'buyer_number_of_certificate' => $result->buyer_number_of_certificate,
            'buyer_date_of_certificate' => $result->buyer_date_of_certificate,
        );
        $header_doc = $this->set_header_doc($result->type_of_giver, $result->type_of_buyer, $data_for_header);
        $document = $this->word->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/patterns/buy_sale_deal.docx');

        // Задание значений
        $document->setValue('city_contract', $result->place_of_contract);
        $document->setValue('date_of_contract',  $result->date_of_contract);//Форматирование даты. Дописать после Ромыного апдейта
        $document->setValue('header_doc', $header_doc);
        $document->setValue('vendor_fio', $vendor_fio);
        $document->setValue('vendor_date', $result->vendor_birthday);//Форматирование даты. Дописать после Ромыного апдейта
        $document->setValue('vendor_serial_ch', $result->vendor_passport_serial);
        $document->setValue('vendor_number_ser', $result->vendor_passport_number);
        $document->setValue('vendor_ser_bywho', $result->vendor_passport_bywho);
        $document->setValue('vendor_bywho_date', $result->vendor_passport_date);//Форматирование даты. Дописать
        $document->setValue('vendor_adress', $vendor_adress);
        $document->setValue('vendor_phone', $result->vendor_phone);
        $document->setValue('buyer_fio', $buyer_fio);
        $document->setValue('buyer_date', $result->buyer_birthday);//Форматирование даты. Дописать после Ромыного апдейта
        $document->setValue('buyer_serial_ch', $result->buyer_passport_serial);
        $document->setValue('buyer_number_ser', $result->vendor_passport_number);
        $document->setValue('buyer_ser_bywho', $result->vendor_passport_bywho);
        $document->setValue('buyer_bywho_date', $result->buyer_passport_date);
        $document->setValue('buyer_adress', $buyer_adress);
        $document->setValue('buyer_phone', $result->buyer_phone);
        $document->setValue('mark', $result->mark);
        $document->setValue('vin', $result->vin);
        $document->setValue('reg_number', $result->reg_gov_number);
        $document->setValue('car_type', $result->car_type);
        $document->setValue('category', $result->category);
        $document->setValue('date_of_product', $result->date_of_product);
        $document->setValue('engine_model', $result->engine_model);
        $document->setValue('shassi', $result->shassi);
        //$document->setValue('carcass', $result->carcass); Пропущен блок в верстке
        $document->setValue('color_carcass', $result->color_carcass);
        $document->setValue('other_parameters', $result->other_parameters);
        $document->setValue('additional_equip', $result->additional_devices);
        $document->setValue('serial_car', $result->serial_car);
        $document->setValue('number_of_serial_car', $result->number_of_serial_car);
        $document->setValue('bywho_serial_car', $result->bywho_serial_car);
        $document->setValue('date_of_serial_car', $result->date_of_serial_car);
        $document->setValue('status_of_car', $result->car_allstatus);
        $document->setValue('ts_date', $result->maintenance_date);
        $document->setValue('ts_bywho', $result->maintenance_bywho);
        $document->setValue('defects_all', $result->defects);
        //$document->setValue('defects_rightnow', $result->defects_rightnow);
        $document->setValue('features', $result->features);
        $document->setValue('price', $result->price_car);
        //$document->setValue('price_str', $result->price_str);//Написать функцию превращения числа в строку
        $document->setValue('date_of_pay', $result->payment_date);//Форматирование даты. Дописать после Ромыного апдейта
        $document->setValue('other_documents_car', $other_documents_car);
        $document->setValue('accessories', $accessories);
        $document->setValue('marriage_info', $marriage['info']);
        $document->setValue('marriage_number', $marriage['number']);
        $document->setValue('penalty', $result->penalty);

        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'. time() .'buy_sale_deal.docx';//Имя файла и путь к нему
        $document->save($name_of_file); // Сохранение документа

        return $name_of_file;
    }
    //------------------------------------------------------------------------------------------------------------------
    //договор дарения
    public function get_doc_gift()
    {

    }
    //------------------------------------------------------------------------------------------------------------------
    //акт приема-передачи автомобиля
    public function get_doc_act_of_reception($id)
    {
        //Работа с базой
        $this->db->select();
        $id_user = $this->data['user_id'];
        $where = "id_user = '$id_user' AND id = '$id '";
        $this->db->where($where);
        $query = $this->db->get('buy_sale');
        $result = $query->row();

        //Подготовка данных
        $document = $this->word->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/patterns/act_of_reception.docx');
        $vendor_fio = $this->format_fio($result->vendor_surname, $result->vendor_name, $result->vendor_patronymic);
        $buyer_fio = $this->format_fio($result->buyer_surname, $result->buyer_name, $result->buyer_patronymic);

        //Задание значений переменных
        $document->setValue('city_contract', $result->place_contract);
        $document->setValue('date_of_contract', $result->date_of_contract);//
        $document->setValue('vendor_fio', $vendor_fio);
        $document->setValue('buyer_fio', $buyer_fio);
        $document->setValue('mark', $result->mark);
        $document->setValue('vin', $result->vin);
        $document->setValue('reg_number', $result->reg_gov_number);
        $document->setValue('car_type', $result->car_type);
        $document->setValue('date_of_product', $result->date_of_product);///
        $document->setValue('engine_model', $result->engine_model);
        $document->setValue('shassi', $result->shassi);
        //$document->setValue('carcass', $result->carcass);
        $document->setValue('color_carcass', $result->color_carcass);
        $document->setValue('other_parameters', $result->other_parameters);
        $document->setValue('additional_equip', $result->additional_devices);
        $document->setValue('serial_car', $result->serial_car);
        $document->setValue('number_of_serial_car', $result->number_of_serial_car);
        $document->setValue('bywho_serial_car', $result->bywho_serial_car);
        $document->setValue('date_of_serial_car', $result->date_of_serial_car);//
        $document->setValue('oil_in_car', $result->oil_in_car);
        $document->setValue('defects_all', $result->defects);
        $document->setValue('features', $result->features);
        //Вопросы по пост-пунткам пунтка 7
        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'. time() .'act_of_reception.docx';//Имя файла и путь к нему
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
    public function insert_into_database($id_user)
    {
        $data = array
        (
            'id_user' => $id_user,
            'date' => date("Y-m-d H:I:s"),
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
            'other_parameters' => $_POST['other_parameters'],
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
            'documents' => json_encode($_POST['documents']),
            'accessories' => json_encode($_POST['accessories']),
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
    public function testjson()
    {
        $test_array = array
        (
            'first_string'=> 1,
            'second_string'=>2,
            'some_string'=> 'example of string'

        );
        $instruments = json_encode($test_array);  //
        /// прочитать защиту sql
        $instruments = json_decode($instruments);

        echo $instruments->first_string;
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