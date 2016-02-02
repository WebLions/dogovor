<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting (0);

class Document_model extends CI_Model
{
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
       /* echo '<pre>';
        print_r($result);
        //echo $result->place_o*f_contract;
        echo '</pre>';*/
    }
    //------------------------------------------------------------------------------------------------------------------
    private  function num2str($num)
    {
        $nul='ноль';
        $ten=array(
            array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
            array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
        );
        $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
        $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
        $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
        $unit=array( // Units
            array('десятая' ,'десятых' ,'десятых',	 1),
            array('целая'   ,'целых'   ,'целых'    ,0),
            array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
            array('миллион' ,'миллиона','миллионов' ,0),
            array('миллиард','милиарда','миллиардов',0),
        );
        //
        list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub)>0) {
            foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit)-$uk-1; // unit key
                $gender = $unit[$uk][3];
                list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk>1) $out[]= $this->morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            } //foreach
        }
        else $out[] = $nul;
        $out[] = $this->morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
        //$out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
    }
    private function morph($n, $f1, $f2, $f5)
    {
        $n = abs(intval($n)) % 100;
        if ($n>10 && $n<20) return $f5;
        $n = $n % 10;
        if ($n>1 && $n<5) return $f2;
        if ($n==1) return $f1;
        return $f5;
    }
    //------------------------------------------------------------------------------------------------------------------
    private function get_month_from_number($number)
    {
        switch ($number)
        {
            case '01':
                $result = 'января';
                break;

            case '02':
                $result = 'февраля';
                break;

            case '03':
                $result = 'марта';
                break;

            case '04':
                $result = 'апреля';
                break;

            case '05':
                $result = 'мая';
                break;

            case '06':
                $result = 'июня';
                break;

            case '07':
                $result = 'июля';
                break;

            case '08':
                $result = 'августа';
                break;

            case '09':
                $result = 'сентября';
                break;

            case '10':
                $result = 'октября';
                break;

            case '11':
                $result = 'ноября';
                break;

            case '12':
                $result = 'декабря';
                break;

            default:
                $result = 'Ошибка. Введенно неверное число месяца';
                break;
        }
        return $result;
    }
    //------------------------------------------------------------------------------------------------------------------
    private function format_date($date)
    {
        if(empty($date)){
            return false;
        }
        $date = DateTime::createFromFormat('Y-m-d', $date);
        $day = $date->format('d');
        $month = $date->format('m');
        $month = $this->get_month_from_number($month);
        $year = $date->format('Y');
        $date = '"'. $day . '" ' . $month . ' ' . $year . 'г.';
        return $date;
    }
    //------------------------------------------------------------------------------------------------------------------
    private function format_adress($city, $street, $house, $flat)
    {
        $adress = $city .', '. $street .', '. $house .', '. $flat;
        return $adress;
    }
    //------------------------------------------------------------------------------------------------------------------
    private function format_fio($surname, $name, $patronymic)
    {
        $fio = $surname .' '. $name . ' '. $patronymic;
        return $fio;
    }
    //------------------------------------------------------------------------------------------------------------------
    private function json_to_string($target)
    {
        json_decode($target);
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
    private function set_pack_of_documents($giver, $taker, $type_of_document)
    {
        if ($type_of_document == 'buy_sell')
        {
            if ($giver == 'physical' && $taker == 'physical')
            {
                $id_type = 1;
            }
            elseif ($giver == 'individual' && $taker == 'individual')
            {
                $id_type = 1;
            }
            elseif ($giver == 'law' && $taker == 'law')
            {
                $id_type = 2;
            }
            elseif ($giver == 'physical' && $taker == 'law' || $taker == 'individual')
            {
                $id_type = 3;
            }
            elseif ($giver == 'law' || $giver == 'individual' && $taker == 'physical')
            {
                $id_type = 4;
            }
            else $id_type = false;
        }
        if ($type_of_document == 'gift')
        {
            if ($giver == 'physical' && $taker == 'physical')
            {
                $id_type = 5;
            }
            elseif ($giver == 'individual' && $taker == 'individual')
            {
                $id_type = 5;
            }
            elseif ($giver == 'physical' || $giver == 'individual' && $taker == 'law')
            {
                $id_type = 6;
            }
            else $id_type = false;
        }
        return $id_type;
    }
    //------------------------------------------------------------------------------------------------------------------
    //Функция вывода заголовка документа
    /*Анализирует лица, между которыми заключается договор и возвращает переменную, в которой содержиться правильный вариант текста*/
    private function set_header_doc($type_of_contract, $type_of_vendor, $type_of_buyer, $data_for_header) //law //physical //individual
    {
        switch ($type_of_contract)
        {
            case 'buy_sell':
                $first_person = 'Продавец';
                $second_person = 'Покупатель';
                break;
            case 'gift':
                $first_person = 'Даритель';
                $second_person = 'Одаряемый';

        }
        if ($type_of_vendor == 'physical' && $type_of_buyer == 'physical')
        {
            $header = ' Гражданин ' . $data_for_header['vendor_fio'] . ', далее именуемый "'.$first_person.'", с одной стороны, и гражданин ' . $data_for_header['buyer_fio'] . ', далее именуемый "'.$second_person.'", с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'law' && $type_of_buyer == 'law')
        {
            $header = $data_for_header['vendor_law_company_name'].', далее именуемое "'.$first_person.'", в лице'. $data_for_header['vendor_law_actor_position'].', '. $data_for_header['vendor_law_fio'].', действующего на основании '. $data_for_header['vendor_law_document_osn']. ' №'.$data_for_header['vendor_law_proxy_number']. 'от'.$data_for_header['vendor_law_proxy_date'].' , с одной стороны, и '.$data_for_header['buyer_law_company_name'].', далее именуемое "'.$second_person.'", в лице' . $data_for_header['buyer_law_actor_position'].', '. $data_for_header['buyer_law_fio'].', действующего на основании '. $data_for_header['buyer_law_document_osn']. ' №'.$data_for_header['buyer_law_proxy_number']. ' от'.$data_for_header['buyer_law_proxy_date'].', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'physical' && $type_of_buyer == 'law')
        {
            $header = 'Гражданин' . $data_for_header['vendor_fio']. ', далее именуемый "'.$first_person.'", с одной стороны и '.$data_for_header['buyer_law_company_name'].', далее именуемое "'.$second_person.'", в лице' . $data_for_header['buyer_law_actor_position '].', '. $data_for_header['buyer_law_fio'].', действующего на основании '. $data_for_header['buyer_law_document_osn']. ' №'.$data_for_header['buyer_law_proxy_number']. ' от'.$data_for_header['buyer_law_proxy_date'].', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'law' && $type_of_buyer == 'physical')
        {
            $header = $data_for_header['vendor_law_company_name'].', далее именуемое "'.$first_person.'", в лице'. $data_for_header['vendor_law_actor_position'].', '. $data_for_header['vendor_law_fio'].', действующего на основании '. $data_for_header['vendor_law_document_osn']. ' №'.$data_for_header['vendor_law_proxy_number']. 'от'.$data_for_header['vendor_law_proxy_date'].' , с одной стороны и гражданин '. $data_for_header['buyer_fio']. ', далее именуемый "'.$second_person.'", с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'physical' && $type_of_buyer == 'individual')
        {
            $header =  'Гражданин' . $data_for_header['vendor_fio ']. ', далее именуемый "'.$first_person.'", с одной стороны и '.$data_for_header['buyer_ind_fio'].', далее именуемый "'.$second_person.'",  действующий на основании свидетельства индивидуального предпринимателя №'.$data_for_header['buyer_number_of_certificate'].' от '.$data_for_header['buyer_date_of_certificate'].', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'individual' && $type_of_buyer == 'physical')
        {
            $header = $data_for_header['vendor_ind_fio'].', далее именуемый "'.$first_person.'", действующий на основании свидетельства индивидуального предпринимателя №'.$data_for_header['vendor_number_of_certificate'].' от '.$data_for_header['vendor_date_of_certificate'].', с одной стороны и гражданин '.$data_for_header['buyer_fio'].', далее именуемый "'.$second_person.'", с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'law' && $type_of_buyer == 'individual')
        {
            $header = $data_for_header['vendor_law_company_name '].', далее именуемое "'.$first_person.'", в лице'. $data_for_header['vendor_law_actor_position '].', '. $data_for_header['vendor_law_fio '].', действующего на основании '. $data_for_header['vendor_law_document_osn ']. ' №'.$data_for_header['vendor_law_proxy_number']. 'от'.$data_for_header['vendor_law_proxy_date'].'с одной стороны и '.$data_for_header['buyer_ind_fio'].', далее именуемый "'.$second_person.'",  действующий на основании свидетельства индивидуального предпринимателя №'.$data_for_header['buyer_number_of_certificate'].' от '.$data_for_header['buyer_date_of_certificate'].', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';
        }
        elseif ($type_of_vendor == 'individual' && $type_of_buyer == 'law')
        {
            $header = $data_for_header['vendor_ind_fio'].', далее именуемый "'.$first_person.'", действующий на основании свидетельства индивидуального предпринимателя №'.$data_for_header['vendor_number_of_certificate'].' от '.$data_for_header['vendor_date_of_certificate'].', с одной стороны и '.$data_for_header['buyer_law_company_name'].', далее именуемое "'.$second_person.'", в лице' . $data_for_header['buyer_law_actor_position '].', '. $data_for_header['buyer_law_fio '].', действующего на основании '. $data_for_header['buyer_law_document_osn ']. ' №'.$data_for_header['buyer_law_proxy_number']. ' от'.$data_for_header['buyer_law_proxy_date']. ', с другой стороны, совместно в дальнейшем именуемые "Стороны", заключили настоящий договор (далее - Договор) о нижеследующем:';        }
        else $header = 'Incorrect type of vendor/buyer.Type of vendor = '.$type_of_vendor.', Type of buyer = '.$type_of_buyer;
        return $header;
    }
    //------------------------------------------------------------------------------------------------------------------
    private function get_marriage_info($car_in_marriage, $spouse_fio)
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
        $where = "documents.user_id = '$id_user' AND buy_sale.id = '$id ' AND documents.table='buy_sale'";
        $this->db->where($where);
        $this->db->join("documents","documents.doc_id=buy_sale.id");
        $query = $this->db->get('buy_sale');
        $result = $query->row();
        // Подготовка данных для работы с документов
        //Фио
        $vendor_fio = $this->format_fio($result->vendor_surname, $result->vendor_name, $result->vendor_patronymic);
        $buyer_fio = $this->format_fio($result->buyer_surname,$result->buyer_name,$result->buyer_patronymic);
        $spouse_fio = $this->format_fio($result->spouse_surname,$result->spouse_name,$result->spouse_patronymic);
        //$vendor_law_fio = $this->format_fio($result->vendor_law_surname,$result->vendor_law_name,$result->vendor_law_patronymic);
        //$buyer_law_fio = $this->format_fio($result->buyer_law_surname,$result->buyer_law_name,$result->buyer_law_patronymic);
        //$vendor_ind_fio = $this->format_fio($result->vendor_ind_surname,$result->vendor_ind_name,$result->vendor_ind_patronymic);
        //$buyer_ind_fio = $this->format_fio($result->buyer_ind_surname,$result->buyer_ind_name,$result->buyer_ind_patronymic);
        //Адрес
        $vendor_adress = $this->format_adress($result->vendor_city,$result->vendor_street,$result->vendor_house,$result->vendor_flat);
        $buyer_adress = $this->format_adress($result->buyer_city,$result->buyer_street,$result->buyer_house,$result->buyer_flat);
        //Дата
        $date_of_contract = $this->format_date($result->date_of_contract);
        $date_of_product = $this->format_date($result->date_of_product);
        $date_of_serial_car = $this->format_date($result->date_of_serial_car);
        $vendor_birthday = $this->format_date($result->vendor_birthday);
        $vendor_passport_date = $this->format_date($result->vendor_passport_date);
        $buyer_passport_date = $this->format_date($result->buyer_passport_date);
        $buyer_birthday = $this->format_date($result->buyer_birthday);
        //$payment_date = $this->format_date($result->payment_date);
        //Джсон
        $other_documents_car = $this->json_to_string($result->documents);
        $accessories = $this->json_to_string($result->accessories);
        $other_parameters = $this->json_to_string($result->other_parameters);
        //Иные
        $marriage = $this->get_marriage_info($result->car_in_marriage, $spouse_fio);
        $price_str = $this->num2str($result->price_car);
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
        $header_doc = $this->set_header_doc($result->type_of_contract ,$result->type_of_giver, $result->type_of_buyer, $data_for_header);
        $document = $this->word->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/patterns/buy_sale_deal.docx');

        //Заполнение
        $document->setValue('city_contract', $result->place_of_contract);
        $document->setValue('date_of_contract',  $date_of_contract);
        $document->setValue('header_doc', $header_doc);
        $document->setValue('vendor_fio', $vendor_fio);
        $document->setValue('vendor_date', $vendor_birthday);
        $document->setValue('vendor_serial_ch', $result->vendor_passport_serial);
        $document->setValue('vendor_number_ser', $result->vendor_passport_number);
        $document->setValue('vendor_ser_bywho', $result->vendor_passport_bywho);
        $document->setValue('vendor_bywho_date', $vendor_passport_date);
        $document->setValue('vendor_adress', $vendor_adress);
        $document->setValue('vendor_phone', $result->vendor_phone);
        $document->setValue('buyer_fio', $buyer_fio);
        $document->setValue('buyer_date', $buyer_birthday);
        $document->setValue('buyer_serial_ch', $result->buyer_passport_serial);
        $document->setValue('buyer_number_ser', $result->vendor_passport_number);
        $document->setValue('buyer_ser_bywho', $result->vendor_passport_bywho);
        $document->setValue('buyer_bywho_date', $buyer_passport_date);
        $document->setValue('buyer_adress', $buyer_adress);
        $document->setValue('buyer_phone', $result->buyer_phone);
        $document->setValue('mark', $result->mark);
        $document->setValue('vin', $result->vin);
        $document->setValue('reg_number', $result->reg_gov_number);
        $document->setValue('car_type', $result->car_type);
        $document->setValue('category', $result->category);
        $document->setValue('date_of_product', $date_of_product);
        $document->setValue('engine_model', $result->engine_model);
        $document->setValue('shassi', $result->shassi);
        $document->setValue('carcass', $result->carcass);
        $document->setValue('color_carcass', $result->color_carcass);
        $document->setValue('other_parameters', $other_parameters);
        $document->setValue('additional_equip', $result->additional_devices);
        $document->setValue('serial_car', $result->serial_car);
        $document->setValue('number_of_serial_car', $result->number_of_serial_car);
        $document->setValue('bywho_serial_car', $result->bywho_serial_car);
        $document->setValue('date_of_serial_car', $date_of_serial_car);
        $document->setValue('status_of_car', $result->car_allstatus);
        $document->setValue('ts_date', $result->maintenance_date);
        $document->setValue('ts_bywho', $result->maintenance_bywho);
        $document->setValue('defects', $result->defects);
        $document->setValue('features', $result->features);
        $document->setValue('price', $result->price_car);
        $document->setValue('price_str', $price_str);
        $document->setValue('date_of_pay', $result->payment_date);
        $document->setValue('other_documents_car', $other_documents_car);
        $document->setValue('accessories', $accessories);
        $document->setValue('marriage_info', $marriage['info']);
        $document->setValue('marriage_number', $marriage['number']);
        $document->setValue('penalty', $result->penalty);

        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/id'.$id.'buy_sale_deal.docx';//Имя файла и путь к нему
        $document->save($name_of_file,true); // Сохранение документа


        $name_for_server = '/documents/buy_sale/id'.$id.'buy_sale_deal.docx';
        return $name_for_server;
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
        //Дата
        $date_of_contract = $this->format_date($result->date_of_contract);
        $date_of_product = $this->format_date($result->date_of_product);
        $date_of_serial_car = $this->format_date($result->date_of_serial_car);
        $vendor_passport_date = $this->format_date($result->vendor_passport_date);
        $buyer_passport_date = $this->format_date($result->buyer_passport_date);
        $buyer_birthday = $this->format_date($result->buyer_birthday);
        $vendor_birthday = $this->format_date($result->vendor_birthday);
        //Адрес
        $vendor_adress = $this->format_adress($result->vendor_city,$result->vendor_street,$result->vendor_house,$result->vendor_flat);
        $buyer_adress = $this->format_adress($result->buyer_city,$result->buyer_street,$result->buyer_house,$result->buyer_flat);
        //ФИО
        $vendor_fio = $this->format_fio($_POST['vendor_surname'], $_POST['vendor_name'], $_POST['vendor_patronymic']);
        $buyer_fio = $this->format_fio($_POST['buyer_surname'], $_POST['buyer_name'], $_POST['buyer_patronymic']);
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
        $header_doc = $this->set_header_doc($result->type_of_contract, $result->type_of_giver, $result->type_of_buyer, $data_for_header);

        //Заполнение
        $document->setValue('city_contract', $result->place_of_contract);
        $document->setValue('date_of_contract', $date_of_contract);
        $document->setValue('header_doc', $header_doc);
        $document->setValue('vendor_fio', $vendor_fio);
        $document->setValue('buyer_fio', $buyer_fio);
        $document->setValue('mark', $result->mark);
        $document->setValue('vin', $result->vin);
        $document->setValue('reg_number', $result->reg_gov_number);
        $document->setValue('car_type', $result->car_type);
        $document->setValue('date_of_product', $date_of_product);
        $document->setValue('engine_model', $result->engine_model);
        $document->setValue('shassi', $result->shassi);
        $document->setValue('carcass', $result->carcass);
        $document->setValue('color_carcass', $result->color_carcass);
        $document->setValue('other_parameters', $result->other_parameters);
        $document->setValue('additional_equip', $result->additional_devices);
        $document->setValue('serial_car', $result->serial_car);
        $document->setValue('number_of_serial_car', $result->number_of_serial_car);
        $document->setValue('bywho_serial_car', $result->bywho_serial_car);
        $document->setValue('date_of_serial_car', $date_of_serial_car);
        $document->setValue('oil_in_car', $result->oil_in_car);
        $document->setValue('defects', $result->defects);
        $document->setValue('features', $result->features);
        $document->setValue('vendor_birthday', $vendor_birthday);
        $document->setValue('vendor_passport_serial', $result->vendor_passport_serial);
        $document->setValue('vendor_passport_number', $result->vendor_passport_number);
        $document->setValue('vendor_passport_bywho', $result->vendor_passport_bywho);
        $document->setValue('vendor_passport_date', $vendor_passport_date);
        $document->setValue('vendor_adress', $vendor_adress);
        $document->setValue('vendor_phone', $result->vendor_phone);
        $document->setValue('buyer_birthday', $buyer_birthday);
        $document->setValue('buyer_passport_serial', $result->buyer_passport_serial);
        $document->setValue('buyer_passport_number', $result->buyer_passport_number);
        $document->setValue('buyer_passport_bywho', $result->buyer_passport_bywho);
        $document->setValue('buyer_passport_date', $buyer_passport_date);
        $document->setValue('buyer_adress', $buyer_adress);
        $document->setValue('buyer_phone', $result->buyer_phone);
        //Вопросы по пост-пунткам пунтка 7
        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'.$id.'act_of_reception.docx';//Имя файла и путь к нему
        $document->save($name_of_file); // Сохранение документа
        $name_for_server = '/documents/buy_sale/'.$id.'act_of_reception.docx';
        return $name_for_server;
    }
    //------------------------------------------------------------------------------------------------------------------
    //расписка в получении денежных средств
    public function get_doc_receipt_of_money($id)
    {
        //Работа с базой
        $this->db->select();
        $id_user = $this->data['user_id'];
        $where = "id_user = '$id_user' AND id = '$id '";
        $this->db->where($where);
        $query = $this->db->get('buy_sale');
        $result = $query->row();

        //Подготовка данных
        $document = $this->word->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/patterns/receipt_of_money.docx');
        $vendor_fio = $this->format_fio($result->vendor_surname, $result->vendor_name, $result->vendor_patronymic);
        $buyer_fio = $this->format_fio($result->buyer_surname, $result->buyer_name, $result->buyer_patronymic);
        $vendor_adress = $this->format_adress($result->vendor_city,$result->vendor_street,$result->vendor_house,$result->vendor_flat);
        $buyer_adress = $this->format_adress($result->buyer_city,$result->buyer_street,$result->buyer_house,$result->buyer_flat);
        $date_of_contract = $this->format_date($result->date_of_contract);
        $vendor_passport_date = $this->format_date($result->vendor_passport_date);
        $buyer_passport_date = $this->format_date($result->buyer_passport_date);
        $price_str = $this->num2str($result->price_car);
        //Заполнение
        $document->setValue('city_contract', $result->city_contract);
        $document->setValue('date_of_contract', $date_of_contract);
        $document->setValue('vendor_fio', $vendor_fio);
        $document->setValue('vendor_passport_serial', $result->vendor_passport_serial);
        $document->setValue('vendor_passport_number', $result->vendor_passport_number);
        $document->setValue('vendor_passport_bywho', $result->vendor_passport_bywho);
        $document->setValue('vendor_passport_date', $vendor_passport_date);
        $document->setValue('vendor_adress', $vendor_adress);
        $document->setValue('buyer_fio', $buyer_fio);
        $document->setValue('buyer_serial_ch', $result->buyer_passport_serial);
        $document->setValue('buyer_number_ser', $result->buyer_passport_number);
        $document->setValue('buyer_ser_bywho', $result->buyer_passport_bywho);
        $document->setValue('buyer_bywho_date', $buyer_passport_date);
        $document->setValue('buyer_adress', $buyer_adress);
        $document->setValue('price', $result->price_car);
        $document->setValue('price_str', $price_str);
        $document->setValue('currency', $result->currency);

        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'.$id.'receipt_of_money.docx';//Имя файла и путь к нему
        $document->save($name_of_file); // Сохранение документа
        $name_for_server = '/documents/buy_sale/'.$id.'receipt_of_money.docx';
        return $name_for_server;
    }
    //------------------------------------------------------------------------------------------------------------------
    //заявление в ГИБДД для смены собственника
    public function get_doc_statement_gibdd($id)
    {
        //Работа с базой
        $this->db->select();
        $id_user = $this->data['user_id'];
        $where = "id_user = '$id_user' AND id = '$id '";
        $this->db->where($where);
        $query = $this->db->get('buy_sale');
        $result = $query->row();

        //Подготовка
        $buyer_fio = $this->format_fio($result->buyer_surname, $result->buyer_name, $result->buyer_patronymic);
        $giver = $this->format_fio($result->vendor_surname, $result->vendor_name, $result->vendor_patronymic);
        $giver_adress = $this->format_adress($result->vendor_city,$result->vendor_street,$result->vendor_house,$result->vendor_flat);
        $giver_agent_adress = $this->format_adress($result->giver_agent_city,$result->giver_agent_street,$result->giver_agent_house,$result->giver_agent_flat);
        $date_of_contract = $this->format_date($result->date_of_contract);
        $giver_date = $this->format_date($result->vendor_birthday);
        $giver_pass = "Паспорт: серия $result->vendor_serial_ch № $result->vendor_number_ser выдан $result->vendor_ser_bywho $result->vendor_bywho_date";

    $document = $this->word->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/patterns/gibdd.docx');
        //Заполнение
        $document->setValue('gibdd_reg_name', $result->gibdd_reg_name);
        $document->setValue('buyer_fio', $buyer_fio);
        $document->setValue('mark', $result->mark);
        $document->setValue('date_of_product', $date_of_contract);
        $document->setValue('vin', $result->vin);
        $document->setValue('reg_gov_number', $result->reg_gov_number);
        $document->setValue('giver', $giver);
        $document->setValue('giver_date', $giver_date);
        $document->setValue('giver_pass', $giver_pass);
        $document->setValue('gibdd_inn', $result->gibdd_inn);
        $document->setValue('giver_adress', $giver_adress);
        $document->setValue('giver_phone', $result->vendor_phone);
        $document->setValue('giver_agent', $result->giver_agent);
        $document->setValue('giver_agent_pass', $result->giver_agent_pass);
        $document->setValue('giver_agent_adress', $giver_agent_adress);
        $document->setValue('giver_agent_phone', $result->giver_agent_phone);
        $document->setValue('mark', $result->mark);
        $document->setValue('car_type', $result->car_type);
        $document->setValue('carcass', $result->carcass);
        $document->setValue('color_carcass', $result->color_carcass);
        $document->setValue('reg_number', $result->reg_gov_number);
        $document->setValue('vin', $result->vin);
        $document->setValue('carcass', $result->carcass);
        $document->setValue('shassi', $result->shassi);
        $document->setValue('gibdd_power_ingine', $result->gibdd_power_ingine);
        $document->setValue('gibdd_eco_class', $result->gibdd_eco_class);
        $document->setValue('gibdd_max_mass', $result->gibdd_max_mass);
        $document->setValue('gibdd_min_mass', $result->gibdd_min_mass);

        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'.$id.'gibdd.docx';//Имя файла и путь к нему
        $document->save($name_of_file); // Сохранение документа
        $name_for_server = '/documents/buy_sale/'.$id.'gibdd.docx';
        return $name_for_server;
    }
    //------------------------------------------------------------------------------------------------------------------
    //заявление продавца о согласии супруга
    public function get_doc_statement_vendor_marriage($id)
    {
        //Работа с базой
        $this->db->select();
        $id_user = $this->data['user_id'];
        $where = "id_user = '$id_user' AND id = '$id '";
        $this->db->where($where);
        $query = $this->db->get('buy_sale');
        $result = $query->row();

        //Подготовка
        $vendor_fio = $this->format_fio($result->vendor_surname, $result->vendor_name, $result->vendor_patronymic);
        $vendor_adress = $this->format_adress($result->vendor_city,$result->vendor_street,$result->vendor_house,$result->vendor_flat);
        $buyer_fio = $this->format_fio($result->buyer_surname,$result->buyer_name,$result->buyer_patronymic);
        $spouse_fio = $this->format_fio($result->spouse_surname,$result->spouse_name,$result->spouse_patronymic);
        $spouse_adress = $this->format_adress($result->spouse_city,$result->spouse_street,$result->spouse_house,$result->spouse_flat);
        $price_str = $this->num2str($result->price);
        $date_of_contract = $this->format_date($result->date_of_contract);
        $vendor_passport_date = $this->format_date($result->vendor_passport_date);
        $date_of_product = $this->format_date($result->date_of_product);
        $spouse_pass_date = $this->format_date($result->spouse_pass_date);
        $marriage_svid_date = $this->format_date($result->marriage_svid_date);
        $date_of_serial_car = $this->format_date($result->date_of_serial_car);

        $document = $this->word->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/patterns/statement_vendor_marriage.docx');

        $document->setValue('date_of_contract', $date_of_contract);
        $document->setValue('buyer_fio', $buyer_fio);
        $document->setValue('vendor_fio', $vendor_fio);
        $document->setValue('vendor_birthday', $result->vendor_birthday);
        $document->setValue('vendor_serial', $result->vendor_passport_serial);
        $document->setValue('vendor_numbers', $result->vendor_passport_number);
        $document->setValue('vendor_passport_bywho', $result->vendor_passport_bywho);
        $document->setValue('vendor_passport_date', $vendor_passport_date);
        $document->setValue('vendor_adress', $vendor_adress);
        $document->setValue('place_of_contract', $result->place_of_contract);
        $document->setValue('reg_number', $result->reg_gov_number);
        $document->setValue('vin', $result->vin);
        $document->setValue('date_of_product', $date_of_product);
        $document->setValue('engine_model', $result->engine_model);
        $document->setValue('carcass', $result->carcass);
        $document->setValue('serial_car', $result->serial_car);
        $document->setValue('number_of_serial_car', $result->number_of_serial_car);
        $document->setValue('bywho_serial_car', $result->bywho_serial_car);
        $document->setValue('date_of_serial_car', $date_of_serial_car);
        $document->setValue('spouse_fio', $spouse_fio);
        $document->setValue('spouse_pass_serial', $result->spouse_pass_serial);
        $document->setValue('spouse_pass_number', $result->spouse_pass_number);
        $document->setValue('spouse_pass_bywho', $result->spouse_pass_bywho);
        $document->setValue('spouse_pass_date', $spouse_pass_date);
        $document->setValue('spouse_adress', $spouse_adress);
        $document->setValue('marriage_svid_serial', $result->marriage_svid_serial);
        $document->setValue('marriage_svid_number', $result->marriage_svid_number);
        $document->setValue('marriage_svid_bywho', $result->marriage_svid_bywho);
        $document->setValue('marriage_svid_date', $marriage_svid_date);
        $document->setValue('price', $result->price);
        $document->setValue('price_str', $price_str);

        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'.$id.'statement_vendor_marriage.docx';//Имя файла и путь к нему
        $document->save($name_of_file); // Сохранение документа
        $name_for_server = '/documents/buy_sale/'.$id.'statement_vendor_marriage.docx';
        return $name_for_server;
    }
    //------------------------------------------------------------------------------------------------------------------
    //договор аренды
   /* public function get_doc_rent()
    {

    }*/
    //------------------------------------------------------------------------------------------------------------------
    public function insert_into_database_buysale()
    {
        $type_id = $this->set_pack_of_documents($_POST['type_of_giver'], $_POST['type_of_taker'], $_POST['type_of_contract']);
        $data = array
        (
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
            'carcass' => $_POST['carcass'],
            'color_carcass' => $_POST['color_carcass'],
            'other_parameters' => json_encode($_POST['other_parameters']),
            'serial_car' => $_POST['serial_car'],
            'number_of_serial_car' => $_POST['number_of_serial_car'],
            'date_of_serial_car' => $_POST['date_of_serial_car'],
            'bywho_serial_car' => $_POST['bywho_serial_car'],
            'price_car' => $_POST['price_car'],
            'currency' => $_POST['currency'],
            'additional_devices' => json_encode($_POST['additional_devices']),
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
            'penalty' => $_POST['penalty'],
            'type_id' => $type_id
        );
        //Бизопаснасть
        /*foreach ($data as $key)
        {
            mysql_real_escape_string($key);
        }*/
        //Отправка данных
        $this->db->insert('buy_sale', $data);
        $doc_id = $this->db->insert_id();
        return $doc_id;//
    }
    //------------------------------------------------------------------------------------------------------------------
    public function insert_into_database_gift()
    {
        $type_id = $this->set_pack_of_documents($_POST['type_of_giver'], $_POST['type_of_taker'], $_POST['type_of_contract']);
        $data = array
        (
            'date' => date("Y-m-d H:I:s"),
            'type_of_contract' => $_POST['type_of_contract'],
            'place_of_contract' => $_POST['place_of_contract'],
            'date_of_contract' => $_POST['date_of_contract'],
            'type_of_giver' => $_POST['type_of_giver'],
            'giver_is_owner_car' => $_POST['giver_is_owner_car'],
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
            'vendor_law_company_name' => $_POST['vendor_law_company_name'],
            'vendor_law_actor_position' => $_POST['vendor_law_actor_position'],
            'vendor_law_actor_name' => $_POST['vendor_law_actor_name'],
            'vendor_law_actor_surname' => $_POST['vendor_law_actor_surname'],
            'vendor_law_actor_patronymic' => $_POST['vendor_law_actor_patronymic'],
            'vendor_law_document_osn' => $_POST['vendor_law_document_osn'],
            'vendor_law_proxy_number' => $_POST['vendor_law_proxy_number'],
            'vendor_law_proxy_date' => $_POST['vendor_law_proxy_date'],
            'vendor_law_inn' => $_POST['vendor_law_inn'],
            'vendor_law_ogrn' => $_POST['vendor_law_ogrn'],
            'vendor_law_city' => $_POST['vendor_law_city'],
            'vendor_law_street' => $_POST['vendor_law_street'],
            'vendor_law_house' => $_POST['vendor_law_house'],
            'vendor_law_flat' => $_POST['vendor_law_flat'],
            'vendor_law_phone' => $_POST['vendor_law_phone'],
            'vendor_law_acc' => $_POST['vendor_law_acc'],
            'vendor_law_bank_name' => $_POST['vendor_law_bank_name'],
            'vendor_law_korr_acc' => $_POST['vendor_law_korr_acc'],
            'vendor_law_bik' => $_POST['vendor_law_bik'],
            'vendor_ind_surname' => $_POST['vendor_ind_surname'],
            'vendor_ind_name' => $_POST['vendor_ind_name'],
            'vendor_ind_patronymic' => $_POST['vendor_ind_patronymic'],
            'vendor_ind_number_of_certificate' => $_POST['vendor_ind_number_of_certificate'],
            'vendor_ind_date_of_certificate' => $_POST['vendor_ind_date_of_certificate'],
            'vendor_ind_birthday' => $_POST['vendor_ind_birthday'],
            'vendor_ind_passport_serial' => $_POST['vendor_ind_passport_serial'],
            'vendor_ind_passport_number' => $_POST['vendor_ind_passport_number'],
            'vendor_ind_passport_date' => $_POST['vendor_ind_passport_date'],
            'vendor_ind_passport_bywho' => $_POST['vendor_ind_passport_bywho'],
            'vendor_ind_city' => $_POST['vendor_ind_city'],
            'vendor_ind_street' => $_POST['vendor_ind_street'],
            'vendor_ind_house' => $_POST['vendor_ind_house'],
            'vendor_ind_flat' => $_POST['vendor_ind_flat'],
            'vendor_ind_phone' => $_POST['vendor_ind_phone'],
            'vendor_ind_bank_acc' => $_POST['vendor_ind_bank_acc'],
            'vendor_ind_bank_name' => $_POST['vendor_ind_bank_name'],
            'vendor_ind_korr_acc' => $_POST['vendor_ind_korr_acc'],
            'vendor_ind_bik' => $_POST['vendor_ind_bik'],
            'for_agent_vendor_surname' => $_POST['for_agent_vendor_surname'],
            'for_agent_vendor_name' => $_POST['for_agent_vendor_name'],
            'for_agent_vendor_patronymic' => $_POST['for_agent_vendor_patronymic'],
            'for_agent_vendor_proxy_number' => $_POST['for_agent_vendor_proxy_number'],
            'for_agent_vendor_proxy_date' => $_POST['for_agent_vendor_proxy_date'],
            'for_agent_vendor_proxy_notary' => $_POST['for_agent_vendor_proxy_notary'],
            'type_of_taker' => $_POST['type_of_taker'],
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
            'buyer_law_company_name' => $_POST['buyer_law_company_name'],
            'buyer_law_actor_position' => $_POST['buyer_law_actor_position'],
            'buyer_law_actor_name' => $_POST['buyer_law_actor_name'],
            'buyer_law_actor_surname' => $_POST['buyer_law_actor_surname'],
            'buyer_law_actor_patronymic' => $_POST['buyer_law_actor_patronymic'],
            'buyer_law_document_osn' => $_POST['buyer_law_document_osn'],
            'buyer_law_proxy_number' => $_POST['buyer_law_proxy_number'],
            'buyer_law_proxy_date' => $_POST['buyer_law_proxy_date'],
            'buyer_law_inn' => $_POST['buyer_law_inn'],
            'buyer_law_ogrn' => $_POST['buyer_law_ogrn'],
            'buyer_law_city' => $_POST['buyer_law_city'],
            'buyer_law_street' => $_POST['buyer_law_street'],
            'buyer_law_house' => $_POST['buyer_law_house'],
            'buyer_law_flat' => $_POST['buyer_law_flat'],
            'buyer_law_phone' => $_POST['buyer_law_phone'],
            'buyer_law_acc' => $_POST['buyer_law_acc'],
            'buyer_law_bank_name' => $_POST['buyer_law_bank_name'],
            'buyer_law_korr_acc' => $_POST['buyer_law_korr_acc'],
            'buyer_law_bik' => $_POST['buyer_law_bik'],
            'buyer_ind_surname' => $_POST['buyer_ind_surname'],
            'buyer_ind_name' => $_POST['buyer_ind_name'],
            'buyer_ind_patronymic' => $_POST['buyer_ind_patronymic'],
            'buyer_ind_number_of_certificate' => $_POST['buyer_ind_number_of_certificate'],
            'buyer_ind_date_of_certificate' => $_POST['buyer_ind_date_of_certificate'],
            'buyer_ind_birthday' => $_POST['buyer_ind_birthday'],
            'buyer_ind_passport_serial' => $_POST['buyer_ind_passport_serial'],
            'buyer_ind_passport_number' => $_POST['buyer_ind_passport_number'],
            'buyer_ind_passport_date' => $_POST['buyer_ind_passport_date'],
            'buyer_ind_passport_bywho' => $_POST['buyer_ind_passport_bywho'],
            'buyer_ind_city' => $_POST['buyer_ind_city'],
            'buyer_ind_street' => $_POST['buyer_ind_street'],
            'buyer_ind_house' => $_POST['buyer_ind_house'],
            'buyer_ind_flat' => $_POST['buyer_ind_flat'],
            'buyer_ind_phone' => $_POST['buyer_ind_phone'],
            'buyer_ind_bank_acc' => $_POST['buyer_ind_bank_acc'],
            'buyer_ind_bank_name' => $_POST['buyer_ind_bank_name'],
            'buyer_ind_korr_acc' => $_POST['buyer_ind_korr_acc'],
            'buyer_ind_bik' => $_POST['buyer_ind_bik'],
            'for_agent_buyer_surname' => $_POST['for_agent_buyer_surname'],
            'for_agent_buyer_name' => $_POST['for_agent_buyer_name'],
            'for_agent_buyer_patronymic' => $_POST['for_agent_buyer_patronymic'],
            'for_agent_buyer_proxy_number' => $_POST['for_agent_buyer_proxy_number'],
            'for_agent_buyer_proxy_date' => $_POST['for_agent_buyer_proxy_date'],
            'for_agent_buyer_proxy_notary' => $_POST['for_agent_buyer_proxy_notary'],
            'mark' => $_POST['mark'],
            'vin' => $_POST['vin'],
            'reg_gov_number' => $_POST['reg_gov_number'],
            'car_type' => $_POST['car_type'],
            'category' => $_POST['category'],
            'date_of_product' => $_POST['date_of_product'],
            'engine_model' => $_POST['engine_model'],
            'shassi' => $_POST['shassi'],
            'carcass' => $_POST['carcass'],
            'color_carcass' => $_POST['color_carcass'],
            'other_parametrs' => $_POST['other_parametrs'],
            'serial_car' => $_POST['serial_car'],
            'number_of_serial_car' => $_POST['number_of_serial_car'],
            'date_of_serial_car' => $_POST['date_of_serial_car'],
            'bywho_serial_car' => $_POST['bywho_serial_car'],
            'gibdd_act' => $_POST['gibdd_act'],
            'gibdd_reg_name' => $_POST['gibdd_reg_name'],
            'gibdd_inn' => $_POST['gibdd_inn'],
            'gibdd_power_ingine' => $_POST['gibdd_power_ingine'],
            'gibdd_eco_class' => $_POST['gibdd_eco_class'],
            'ibdd_max_mass' => $_POST['ibdd_max_mass'],
            'gibdd_min_mass' => $_POST['gibdd_min_mass'],
            'type_id' => $type_id
        );
        //Бизопаснасть
        /*foreach ($data as $key)
        {
            mysql_real_escape_string($key);
        }*/
        //Отправка данных
        $this->db->insert('gift', $data);
        $doc_id = $this->db->insert_id();
        return $doc_id;//
    }
    //------------------------------------------------------------------------------------------------------------------
    public function get_data_for_canvas()
    {
        //Подготовка данных
        strip_tags($_POST);
        //ФИО
        $vendor_fio = $this->format_fio($_POST['vendor_surname'], $_POST['vendor_name'], $_POST['vendor_patronymic']);
        $buyer_fio = $this->format_fio($_POST['buyer_surname'],$_POST['buyer_name'],$_POST['buyer_patronymic']);
        $spouse_fio = $this->format_fio($_POST['spouse_surname'],$_POST['spouse_name'],$_POST['spouse_patronymic']);
        //$vendor_law_fio = $this->format_fio($result->vendor_law_surname,$result->vendor_law_name,$result->vendor_law_patronymic);
        //$buyer_law_fio = $this->format_fio($result->buyer_law_surname,$result->buyer_law_name,$result->buyer_law_patronymic);
        //$vendor_ind_fio = $this->format_fio($result->vendor_ind_surname,$result->vendor_ind_name,$result->vendor_ind_patronymic);
        //$buyer_ind_fio = $this->format_fio($result->buyer_ind_surname,$result->buyer_ind_name,$result->buyer_ind_patronymic);
        //Адрес
        $vendor_adress = $this->format_adress($_POST['vendor_city'],$_POST['vendor_street'],$_POST['vendor_house'],$_POST['vendor_flat']);
        $buyer_adress = $this->format_adress($_POST['buyer_city'],$_POST['buyer_street'],$_POST['buyer_house'],$_POST['buyer_flat']);
        //Дата
        $date_of_contract = $this->format_date($_POST['date_of_contract']);
        $date_of_product = $this->format_date($_POST['date_of_contract']);
        $vendor_birthday = $this->format_date($_POST['vendor_birthday']);
        $vendor_passport_date = $this->format_date($_POST['vendor_passport_date']);
        $buyer_passport_date = $this->format_date($_POST['buyer_passport_date']);
        $buyer_birthday = $this->format_date($_POST['buyer_birthday']);
        $payment_date = $this->format_date($_POST['payment_date']);
        $date_of_serial_car = $this->format_date($_POST['date_of_serial_car']);
        //Джсон
        $documents = $this->json_to_string($_POST['documents']);
        $other_parameters = $this->json_to_string($_POST['other_parameters']);
        $additional_equip = $this->json_to_string($_POST['additional_devices']);

        $marriage = $this->get_marriage_info($_POST['car_in_marriage'], $spouse_fio);
        $accessories = $this->json_to_string($_POST['accessories']);
        $price_str = $this->num2str($_POST['price_car']);
        $data_for_header = array(
            'vendor_fio' => $vendor_fio,
            'buyer_fio' => $buyer_fio,
            'vendor_law_company_name' => $_POST['vendor_law_company_name'],
            'vendor_law_actor_position' => $_POST['vendor_law_actor_position'],
            //'vendor_law_fio' => $vendor_law_fio,
            'vendor_law_document_osn' => $_POST['vendor_law_document_osn'],
            'vendor_law_proxy_number' => $_POST['vendor_law_proxy_number'],
            'vendor_law_proxy_date' => $_POST['vendor_law_proxy_date'],
            'buyer_law_company_name' => $_POST['buyer_law_company_name'],
            'buyer_law_actor_position' => $_POST['buyer_law_actor_position'],
            //'buyer_law_fio' => $buyer_law_fio,
            'buyer_law_document_osn' => $_POST['buyer_law_document_osn'],
            'buyer_law_proxy_number' => $_POST['buyer_law_proxy_number'],
            'buyer_law_proxy_date' => $_POST['buyer_law_proxy_date'],
            //'vendor_ind_fio' => $vendor_ind_fio,
            'vendor_number_of_certificate' => $_POST['vendor_number_of_certificate'],
            'vendor_date_of_certificate' => $_POST['vendor_date_of_certificate'],
            //'buyer_ind_fio' => $buyer_ind_fio,
            'buyer_number_of_certificate' => $_POST['buyer_number_of_certificate'],
            'buyer_date_of_certificate' => $_POST['buyer_date_of_certificate']
        );
        $header_doc = $this->set_header_doc($_POST['type_of_contract'], $_POST['type_of_giver'], $_POST['type_of_buyer'], $data_for_header);


        //Массив данных для канванса
        $data = array
        (
            0 => array
            (
                'text' => 'ДОГОВОР',
                'align' => 'center',
                'style' => 'bold'
            ),
            1 => array
            (
                'text' => 'КУПЛИ-ПРОДАЖИ ТРАНСПОРТНОГО СРЕДСТВА',
                'align' => 'center',
                'style' => 'normal'
            ),
            3 => array
            (
                'text' => "г. {$_POST['city_contract']}	$date_of_contract",
                'align' => 'center',
                'style' => 'normal'
            ),
            3 => array
            (
                'text' => $header_doc,
                'align' => 'left',
                'style' => 'normal'
            ),
            4 => array
            (
                'text' => '1. Предмет Договора',
                'align' => 'center',
                'style' => 'normal'
            ),
            5 => array
            (
                'text' => " 1.1. Продавец обязуется передать в собственность Покупателя, а Покупатель обязуется принять и оплатить следующее транспортное средство (далее - транспортное средство):
        - марка, модель: {$_POST['mark']};
        - идентификационный номер (VIN): {$_POST['vin']};
        - государственный регистрационный знак: {$_POST['reg_gov_number']};
        - наименование (тип): {$_POST['car_type']};
        - категория (А, В, С, D, М, прицеп): {$_POST['category']};
        - год изготовления: $date_of_product;
        - модель, N двигателя: {$_POST['engine_model']};
        - шасси (рама) N: {$_POST['shassi']};
        - кузов (кабина, прицеп) N: {$_POST['carcass']};
        - цвет кузова (кабины, прицепа): {$_POST['color_carcass']};
        -иные индивидуализирующие признаки (голограммы, рисунки и т.д.): $other_parameters",
                'align' => 'left',
                'style' => 'normal'
            ),
            6 => array
            (
                'text' => "1.2. Продавец обязуется передать Покупателю транспортное средство, оснащенное серийным оборудованием и комплектующими изделиями, установленными заводом-изготовителем, а также следующим дополнительным оборудованием: $additional_equip",
                'align' => 'left',
                'style' => 'normal'
            ),
            7 => array
            (
                'text' => "1.3. Транспортное средство, отчуждаемое по настоящему договору принадлежит Продавцу на праве собственности, что подтверждается паспортом транспортного средства (ПТС)  серии {$_POST['serial_car']} N {$_POST['number_of_serial_car']}, выданного {$_POST['bywho_serial_car']} {$_POST['date_of_serial_car']}. ",
                'align' => 'left',
                'style' => 'normal'
            ),
            8 => array
            (
                 'text' => "1.4. Продавец гарантирует, что передаваемое транспортное средство в споре или под арестом не состоит, не является предметом залога и не обременено другими правами третьих лиц, в розыске не находится.",
                 'align' => 'left',
                 'style' => 'normal'
            ),
            9 => array
            (
                'text' => "Продавец гарантирует, что не заключал с иными лицами договоров реализации транспортного средства.",
                'align' => 'left',
                'style' => 'normal'
            ),
            10 => array
            (
                'text' => "2. Качество транспортного средства",
                'align' => 'center',
                'style' => 'normal'
            ),
            11 => array
            (
                'text' => "2.1. Общее состояние транспортного средства: {$_POST['car_allstatus']}.",
                'align' => 'left',
                'style' => 'normal'
            ),
            12 => array
            (
                'text' => "2.2. Последнее техническое обслуживание транспортного средства проведено {$_POST['maintenance_date']}{$_POST['maintenance_bywho']} (организация, проводившая техническое обслуживание либо самостоятельно).",
                'align' => 'left',
                'style' => 'normal'
            ),
            13 => array
            (
                'text' => "2.3. Повреждения и эксплуатационные дефекты",
                'align' => 'left',
                'style' => 'normal'
            ),
            14 => array
            (
                'text' => "2.3.1. В период владения Продавцом транспортное средство получило следующие механические повреждения и эксплуатационные дефекты: {$_POST['defects']}",
                'align' => 'left',
                'style' => 'normal'
            ),
            15 => array
            (
                'text' => "2.3.2. Транспортное средство передается Покупателю со следующими неустраненными повреждениями и эксплуатационными дефектами: {$_POST['defects']}",
                'align' => 'left',
                'style' => 'normal'
            ),
            16 => array
            (
                'text' => "2.4. Транспортное средство имеет следующие особенности, которые не влияют на безопасность товара и не являются недостатками: {$_POST['features']} (например, вибрация при эксплуатации, визг тормозов, превышение нормы потребления моторного масла, толчки при переключении трансмиссии и т.д.).",
                'align' => 'left',
                'style' => 'normal'
            ),
            17 => array
            (
                'text' => "3. Цена, срок и порядок оплаты",
                'align' => 'center',
                'style' => 'normal'
            ),
            18 => array
            (
                'text' => "3.1. По соглашению Сторон цена транспортного средства составляет {$_POST['price_car']} ($price_str) руб.",
                'align' => 'left',
                'style' => 'normal'
            ),
            19 => array
            (
                'text' => "3.2. Стоимость указанных в Договоре инструментов и принадлежностей, а также дополнительно установленного оборудования включена в цену транспортного средства.",
                'align' => 'left',
                'style' => 'normal'
            ),
            20 => array
            (
                'text' => "3.3. Покупатель оплачивает стоимость транспортного средства путем передачи наличных денег Продавцу не позднее $payment_date. При получении денежных средств Продавец в соответствии с п. 2 ст. 408 ГК РФ выдает расписку.",
                'align' => 'left',
                'style' => 'normal'
            ),
            21 => array
            (
                'text' => "3.4. Цена транспортного средства не включает расходы, связанные с оформлением Договора. Такие расходы Покупатель несет дополнительно.",
                'align' => 'left',
                'style' => 'normal'
            ),
            22 => array
            (
                'text' => "4. Срок и условия передачи транспортного средства",
                'align' => 'center',
                'style' => 'normal'
            ),
            23 => array
            (
                'text' => "4.1. Продавец передает Покупателю соответствующее условиям Договора транспортное средство со всеми принадлежностями после исполнения Покупателем обязанности по оплате.",
                'align' => 'left',
                'style' => 'normal'
            ),
            24 => array
            (
                'text' => "4.2. Одновременно с передачей транспортного средства Продавец передает Покупателю следующие документы:
- паспорт транспортного средства серия {$_POST['serial_car']} N {$_POST['number_of_serial_car']}, дата выдачи $date_of_serial_car, с подписью Продавца в графе \"Подпись прежнего собственника\";$documents",
                'align' => 'left',
                'style' => 'normal'
            ),
            25 => array
            (
                'text' => "4.3. Одновременно с передачей транспортного средства Продавец передает Покупателю следующие инструменты и принадлежности: {$accessories} {$marriage['info']}",
                'align' => 'left',
                'style' => 'normal'
            ),
            26 => array
            (
                'text' => "4.{$marriage['number']}. Право собственности на транспортное средство, а также риск его случайной гибели и случайного повреждения переходит к Покупателю в момент передачи транспортного средства.",
                'align' => 'left',
                'style' => 'normal'
            ),
            27 => array
            (
                'text' => "5. Приемка транспортного средства",
                'align' => 'center',
                'style' => 'normal'
            ),
            28 => array
            (
                'text' => "5.1. Приемка транспортного средства осуществляется в месте его передачи Покупателю. Во время приемки производятся идентификация, осмотр и проверка транспортного средства по качеству и комплектности.",
                'align' => 'left',
                'style' => 'normal'
            ),
            29 => array
            (
                'text' => "5.2. Покупатель проверяет наличие документов на транспортное средство.",
                'align' => 'left',
                'style' => 'normal'
            ),
            30 => array
            (
                'text' => "5.3. Идентификация транспортного средства заключается в проверке соответствия фактических данных сведениям, содержащимся в ПТС.",
                'align' => 'left',
                'style' => 'normal'
            ),
            31 => array
            (
                'text' => "5.4. Осмотр транспортного средства должен проводиться в светлое время суток либо при искусственном освещении, позволяющем провести такой осмотр.",
                'align' => 'left',
                'style' => 'normal'
            ),
            32 => array
            (
                'text' => "5.5. Все обнаруженные при приемке недостатки, в том числе по комплектности, заносятся в акт приема-передачи транспортного средства.",
                'align' => 'left',
                'style' => 'normal'
            ),
            33 => array
            (
                'text' => "5.6. Покупатель обязан в течение 10 (десяти) суток после подписания акта приема-передачи транспортного средства изменить регистрационные данные о собственнике транспортного средства, обратившись с соответствующим заявлением в регистрационное подразделение ГИБДД.",
                'align' => 'left',
                'style' => 'normal'
            ),
            34 => array
            (
                'text' => "5.7. В случае подачи заявления в регистрирующий орган о сохранении регистрационных знаков, Продавец должен сообщить об этом Покупателю в день подачи заявления.",
                'align' => 'left',
                'style' => 'normal'
            ),
            35 => array
            (
                'text' => "6. Ответственность Сторон",
                'align' => 'center',
                'style' => 'normal'
            ),
            36 => array
            (
                'text' => "6.1. За нарушение сроков оплаты стоимости транспортного средства Продавец вправе требовать с Покупателя уплаты неустойки (пеней) в размере {$_POST['penalty']} процента от неуплаченной суммы за каждый день просрочки.",
                'align' => 'left',
                'style' => 'normal'
            ),
            37 => array
            (
                'text' => "6.2. За нарушение сроков передачи транспортного средства Покупатель вправе требовать с Продавца уплаты неустойки (пеней) в размере {$_POST['penalty']} процента от стоимости транспортного средства за каждый день просрочки.",
                'align' => 'left',
                'style' => 'normal'
            ),
            38 => array
            (
                'text' => "6.3. При нарушении предусмотренных Договором гарантий Продавца Покупатель вправе требовать с Продавца уплаты неустойки (штрафа) в размере {$_POST['penalty']} процентов от установленной Договором цены транспортного средства.",
                'align' => 'left',
                'style' => 'normal'
            ),
            39 => array
            (
                'text' => "6.4. При изъятии транспортного средства у Покупателя третьими лицами по основаниям, возникшим до исполнения Договора, Продавец обязан возместить Покупателю понесенные им убытки.",
                'align' => 'left',
                'style' => 'normal'
            ),
            40 => array
            (
                'text' => "7. Расторжение Договора",
                'align' => 'center',
                'style' => 'normal'
            ),
            41 => array
            (
                'text' => "7.1. Договор может быть расторгнут по требованию Покупателя в судебном порядке в случае выявления после подписания акта приема-передачи транспортного средства хотя бы одного из следующих фактов:",
                'align' => 'left',
                'style' => 'normal'
            ),
            42 => array
            (
                'text' => "- обнаружены дефекты и повреждения, не отраженные в Договоре (скрытые дефекты), которые не позволяют в дальнейшем эксплуатировать транспортное средство в соответствии с его назначением;",
                'align' => 'left',
                'style' => 'normal'
            ),
            43 => array
            (
                'text' => "- в период владения Продавцом проведен не оговоренный в Договоре ремонт транспортного средства в связи с повреждением в результате дорожно-транспортных происшествий, а также иных событий, которые ухудшают дальнейшую эксплуатацию транспортного средства.",
                'align' => 'left',
                'style' => 'normal'
            ),
            41 => array
            (
                'text' => "8. Заключительные положения",
                'align' => 'center',
                'style' => 'normal'
            ),
            42 => array
            (
                'text' => "8.1. Договор вступает в силу с момента его подписания и действует до исполнения Сторонами своих обязательств.",
                'align' => 'left',
                'style' => 'normal'
            ),
            43 => array
            (
                'text' => "8.2. Договор составлен в 3 (трех) экземплярах, имеющих равную юридическую силу, по одному для каждой Стороны и один для регистрирующего органа.",
                'align' => 'left',
                'style' => 'normal'
            ),
            44 => array
            (
                'text' => "9. Адреса и реквизиты Сторон",
                'align' => 'center',
                'style' => 'normal'
            ),
            45 => array
            (
                'text' => "Продавец:
    ФИО $vendor_fio
    Дата рождения $vendor_birthday
    Паспорт: серия {$_POST['vendor_passport_serial']} № {$_POST['vendor_passport_number']} выдан {$_POST['vendor_passport_bywho']} $vendor_passport_date
    Место жительства: г.$vendor_adress
    Телефон: {$_POST['vendor_phone']}
    Подпись:
    _____________________
    $vendor_fio",
                'align' => 'left',
                'style' => 'normal'
            ),
            46 => array
            (
                'text' => "Покупатель:
    ФИО $buyer_fio
    Дата рождения $buyer_birthday
    Паспорт: серия {$_POST['buyer_passport_serial']} № {$_POST['buyer_passport_number']} выдан {$_POST['buyer_passport_bywho']} $buyer_passport_date
    Место жительства: г.$buyer_adress
    Телефон: {$_POST['buyer_phone']}
    Подпись:
    _____________________
    $buyer_fio",
                'align' => 'right',
                'style' => 'normal'
            ));
        $data = json_encode($data);
        echo $data;
        return true;

    }
    //------------------------------------------------------------------------------------------------------------------

    public function add_documents($doc_id,$user_id,$table)
    {
        $data = array(
            'doc_id' => $doc_id,
            'user_id' => $user_id,
            'table' => $table,
            'date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('documents',$data);
        return $this->db->insert_id();
    }
}