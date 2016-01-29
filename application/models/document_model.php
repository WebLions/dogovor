<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting (0);

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
        echo '<pre>';
        print_r($result);
        //echo $result->place_of_contract;
        echo '</pre>';
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
    public function format_date($date)
    {
        if(empty($date)){
            return false;
        }
        $date = DateTime::createFromFormat('d.m.Y', $date);
        $date = $date->format('"d" m Yг.');
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
    public function set_pack_of_documents($giver, $taker, $type_of_document)
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
    /*public function testpack()
    {
        echo $this->set_pack_of_documents('law','physical','buy_sell');
    }*/
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
        $date_of_contract = $this->format_date($result->date_of_contract);
        $vendor_birthday = $this->format_date($result->vendor_birthday);
        $vendor_passport_date = $this->format_date($result->vendor_passport_date);
        $buyer_passport_date = $this->format_date($result->buyer_passport_date);
        $buyer_birthday = $this->format_date($result->buyer_birthday);
        $payment_date = $this->format_date($result->payment_date);
        //$vendor_law_fio = $this->format_fio($result->vendor_law_surname,$result->vendor_law_name,$result->vendor_law_patronymic);
        //$buyer_law_fio = $this->format_fio($result->buyer_law_surname,$result->buyer_law_name,$result->buyer_law_patronymic);
        //$vendor_ind_fio = $this->format_fio($result->vendor_ind_surname,$result->vendor_ind_name,$result->vendor_ind_patronymic);
        //$buyer_ind_fio = $this->format_fio($result->buyer_ind_surname,$result->buyer_ind_name,$result->buyer_ind_patronymic);
        $spouse_fio = $this->format_fio($result->spouse_surname,$result->spouse_name,$result->spouse_patronymic);
        $marriage = $this->get_marriage_info($result->car_in_marriage, $spouse_fio);
        $other_documents_car = $this->json_to_string($result->documents);
        $accessories = $this->json_to_string($result->accessories);
        $price_str = $this->num2str($result->price);
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
        $document->setValue('date_of_product', $result->date_of_product);
        $document->setValue('engine_model', $result->engine_model);
        $document->setValue('shassi', $result->shassi);
        $document->setValue('carcass', $result->carcass);
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
        $document->setValue('price_str', $price_str);
        $document->setValue('date_of_pay', $payment_date);
        $document->setValue('other_documents_car', $other_documents_car);
        $document->setValue('accessories', $accessories);
        $document->setValue('marriage_info', $marriage['info']);
        $document->setValue('marriage_number', $marriage['number']);
        $document->setValue('penalty', $result->penalty);

        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'.$id.'buy_sale_deal.docx';//Имя файла и путь к нему
        $document->save($name_of_file,true); // Сохранение документа


        $name_for_server = '/documents/buy_sale/'.$id.'buy_sale_deal.docx';
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
        $vendor_fio = $this->format_fio($result->vendor_surname, $result->vendor_name, $result->vendor_patronymic);
        $buyer_fio = $this->format_fio($result->buyer_surname, $result->buyer_name, $result->buyer_patronymic);
        $date_of_contract = $this->format_date($result->date_of_contract);
        $date_of_product = $this->format_date($result->date_of_product);
        $date_of_serial_car = $this->format_date($result->date_of_serial_car);
        $vendor_passport_date = $this->format_date($result->vendor_passport_date);
        $buyer_passport_date = $this->format_date($result->buyer_passport_date);
        $vendor_adress = $this->format_adress($result->vendor_city,$result->vendor_street,$result->vendor_house,$result->vendor_flat);
        $buyer_adress = $this->format_adress($result->buyer_city,$result->buyer_street,$result->buyer_house,$result->buyer_flat);
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

        //Заполнение
        $document->setValue('city_contract', $result->place_contract);
        $document->setValue('date_of_contract', $date_of_contract);
        $document->setValue('header_doc', $header_doc);
        $document->setValue('vendor_fio', $vendor_fio);
        $document->setValue('vendor_serial_ch', $result->vendor_passport_serial);
        $document->setValue('vendor_number_ser', $result->vendor_passport_number);
        $document->setValue('vendor_ser_bywho', $result->vendor_passport_bywho);
        $document->setValue('vendor_bywho_date', $vendor_passport_date);
        $document->setValue('vendor_adress', $vendor_adress);
        $document->setValue('buyer_fio', $buyer_fio);
        $document->setValue('buyer_serial_ch', $result->buyer_passport_serial);
        $document->setValue('buyer_number_ser', $result->vendor_passport_number);
        $document->setValue('buyer_ser_bywho', $result->vendor_passport_bywho);
        $document->setValue('buyer_bywho_date', $buyer_passport_date);
        $document->setValue('buyer_adress', $buyer_adress);
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
        $document->setValue('defects_all', $result->defects);
        $document->setValue('features', $result->features);
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
        $price_str = $this->num2str($result->price);
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
        $document->setValue('price', $result->price);
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
    public function insert_into_database($id_user)
    {
        $type_id = $this->set_pack_of_documents($_POST['type_of_giver'], $_POST['type_of_taker'], $_POST['type_of_contract']);
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
            'carcass' => $_POST['carcass'],
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
        return $doc_id;
    }
    //------------------------------------------------------------------------------------------------------------------
    public function get_data_for_canvas()
    {

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