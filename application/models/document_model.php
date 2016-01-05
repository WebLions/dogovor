<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Document_model extends CI_Model
{
    //------------------------------------------------------------------------------------------------------------------
    // Тестовые переменные
    public $city_contract = "Одесса";
    public $day = "28";
    public $month = "ноября";
    public $year = "2028";
    public $date_of_contract = '';
    public $vendor_fio = "Иванов Иван Иванович ";
    public $vendor_b_day = "28";
    public $vendor_b_month = "апреля";
    public $vendor_b_year = "1997";
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
    public $buyer_fio = "Петров Петр Петрович";
    public $buyer_b_day = "19";
    public $buyer_b_month = "декабря";
    public $buyer_b_year = "1994";
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
    /*public $serial_car_chars = "ОО";
    public $serial_car_numbers = "23АМ21";*/
    public $day_car = "12";
    public $month_car = "12";
    public $year_car = "2012";
    public $equipment_for_car = "Носовой платок";
    public $other_documents_car = "Другие документы";//Смотря под что приходит
    public $marriage_info = "Имеется в браке";
    public $marriage_number = "777";
    public $penalty_for_buyer = "1 000 000";
    public $penalty_for_vendor = "2 000 000";
    public $penalty_for_garanty = "228 228";
    public $oil_in_car = "95 prime";
    public $vendor_birthday = '';
    public $spouse_fio = 'Леонидов Леонид Леонидович';
    public $spouse_pass_serial = 'ЛЛ';
    public $spouse_pass_number = '42284228';
    public $spouse_pass_bywho = 'Леонидовский отдел';
    public $spouse_pass_date = '23.03.2023';
    public $spouse_adress = 'Леонидовский городо, леонидовская улица 28, кв. 42';
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




    //------------------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $this->load->database();//Работа с бд
        $this->load->library('word');

        //Форматирование даты
        $this->vendor_bywho_date = $this->format_date($this->vendor_bywho_d, $this->vendor_bywho_m, $this->vendor_bywho_y);
        $this->buyer_bywho_date = $this->format_date($this->buyer_bywho_d, $this->buyer_bywho_m, $this->buyer_bywho_y);
        $this->vendor_birthday = $this->format_date($this->vendor_b_day, $this->vendor_b_month, $this->vendor_b_year);
        $this->date_of_contract = $this->format_date($this->day, $this->month, $this->year);
        //Форматирование адреса
        $this->vendor_adress = $this->format_adress($this->vendor_city, $this->vendor_street, $this->vendor_house, $this->vendor_flat);
        $this->buyer_adress = $this->format_adress($this->buyer_city, $this->buyer_street, $this->buyer_house, $this->buyer_flat);

        //Форматирование ФИО

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
    public function format_fio($name, $surname, $patronymic)
    {
        $fio = $name .' '. $surname . ' '. $patronymic;
        return $fio;
    }
    //------------------------------------------------------------------------------------------------------------------

    //Функция вывода заголовка документа
    /*Анализирует лица, между которыми заключается договор и возвращает переменную, в которой содержиться правильный вариант текста*/
    public function set_header_doc()
    {

        //return $header;
    }
    //------------------------------------------------------------------------------------------------------------------
    //договор купли-продажи транспортного средства
    public function get_doc_buy_sale()
    {
        // Подготовка
        $document = $this->word->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/patterns/buy_sale_deal.docx');

        // !Оптимизируй даты. Формат "дд" месяц_имя гггг г.
        // Задание значений
        $document->setValue('city_contract', $this->city_contract);
        $document->setValue('day', $this->day);
        $document->setValue('month', $this->month);
        $document->setValue('year', $this->year);

        $document->setValue('vendor_fio', $this->vendor_fio);
        $document->setValue('vendor_b_day', $this->vendor_b_day);
        $document->setValue('vendor_b_month', $this->vendor_b_month);
        $document->setValue('vendor_b_year', $this->vendor_b_year);
        $document->setValue('vendor_serial_ch', $this->vendor_serial_ch);
        $document->setValue('vendor_number_ser', $this->vendor_number_ser);
        $document->setValue('vendor_ser_bywho', $this->vendor_ser_bywho);
        $document->setValue('vendor_bywho_d', $this->vendor_bywho_d);
        $document->setValue('vendor_bywho_m', $this->vendor_bywho_m);
        $document->setValue('vendor_bywho_y', $this->vendor_bywho_y);
        $document->setValue('vendor_city', $this->vendor_city);
        $document->setValue('vendor_street', $this->vendor_street);
        $document->setValue('vendor_house', $this->vendor_house);
        $document->setValue('vendor_flat', $this->vendor_flat);
        $document->setValue('vendor_phone', $this->vendor_phone);

        $document->setValue('buyer_fio', $this->buyer_fio);
        $document->setValue('buyer_b_day', $this->buyer_b_day);
        $document->setValue('buyer_b_month', $this->buyer_b_month);
        $document->setValue('buyer_b_year', $this->buyer_b_year);
        $document->setValue('buyer_serial_ch', $this->buyer_serial_ch);
        $document->setValue('buyer_number_ser', $this->buyer_number_ser);
        $document->setValue('buyer_ser_bywho', $this->buyer_ser_bywho);
        $document->setValue('buyer_bywho_d', $this->buyer_bywho_d);
        $document->setValue('buyer_bywho_m', $this->buyer_bywho_m);
        $document->setValue('buyer_bywho_y', $this->vendor_bywho_y);
        $document->setValue('buyer_city', $this->buyer_city);
        $document->setValue('buyer_street', $this->buyer_street);
        $document->setValue('buyer_house', $this->buyer_house);
        $document->setValue('buyer_flat', $this->buyer_flat);
        $document->setValue('buyer_phone', $this->buyer_phone);

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
        $document->setValue('additional_equip', $this->additional_equip);
        $document->setValue('serial_car', $this->serial_car);
        $document->setValue('number_of_serial_car', $this->number_of_serial_car);
        $document->setValue('bywho_serial_car', $this->bywho_serial_car);
        $document->setValue('date_of_serial_car', $this->date_of_serial_car);
        $document->setValue('status_of_car', $this->status_of_car);
        $document->setValue('ts_day', $this->ts_day);
        $document->setValue('ts_month', $this->ts_month);
        $document->setValue('ts_year', $this->ts_year);
        $document->setValue('ts_bywho', $this->ts_bywho);
        $document->setValue('defects_all', $this->defects_all);
        $document->setValue('defects_rightnow', $this->defects_rightnow);
        $document->setValue('features', $this->features);
        $document->setValue('price', $this->price);
        $document->setValue('price_str', $this->price_str);
        $document->setValue('day_of_pay', $this->day_of_pay);
        $document->setValue('month_of_pay', $this->month_of_pay);
        $document->setValue('year_of_pay', $this->year_of_pay);
        $document->setValue('serial_car_chars', $this->serial_car);
        $document->setValue('serial_car_numbers', $this->number_of_serial_car);
        $document->setValue('day_car', $this->day_car);
        $document->setValue('month_car', $this->month_car);
        $document->setValue('year_car', $this->year_car);
        $document->setValue('equipment_for_car', $this->equipment_for_car);
        $document->setValue('other_documents_car', $this->other_documents_car);
        $document->setValue('marriage_info', $this->marriage_info);
        $document->setValue('marriage_number', $this->marriage_number);
        $document->setValue('penalty_for_buyer', $this->penalty_for_buyer);
        $document->setValue('penalty_for_vendor', $this->penalty_for_vendor);
        $document->setValue('penalty_for_garanty', $this->penalty_for_garanty);


        // Сохранение результатов
        $name_of_file = $_SERVER['DOCUMENT_ROOT'] . '/documents/buy_sale/'. time() .'buy_sale_deal.docx';//Имя файла и путь к нему
        //setcookie('name_of_doc',$name_of_file);
        $document->save($name_of_file); // Сохранение документа
        echo 'File created.';
        //Запрос предмусмотрен на договор между двумя физическими лицами. Появится ещё несколько новых полей
       /* $this->db->query('SELECT city, day, month, year, vendor_fio, buyer_fio, mark, vin, reg_number, nametype, category, year_of_product, model, chassis, bodycar, color_bodycar, other_parametrs, additional_equip, serial_chars, serial_numbers, serial_bywho, serial_day, serial_month, serial_year, status_of_car, ts_day, ts_month, ts_year, ts_bywho, defects_all, defects_rightnow, price, price_str, day_of_pay, month_of_pay, year_of_pay, serial_car_chars, serial_car_numbers, day_car, month_car, year_car, other_documents_car, equipment_for_car, marriage_info, marriage_number, penalty_for_buyer, penalty_for_vendor, penalty_for_garanty, vendor_b_day, vendor_b_month, vendor_b_year, vendor_serial_ch, vendor_number_ser, vendor_ser_bywho, vendor_bywho_d, vendor_bywho_m, vendor_bywho_y, vendor_city, vendor_house, vendor_flat, vendor_phone, buyer_b_day, buyer_b_month, buyer_b_year, buyer_serial_ch, buyer_number_ser, buyer_ser_bywho, buyer_bywho_d, buyer_bywho_m, buyer_bywho_y, buyer_city, buyer_house, buyer_flat, buyer_phone
FROM buy_deal');*/



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

}

//----------------------------------------------------------------------------------------------------------------------
//Заготовка для обработки документа купли-продажи в случае брака продавца
// Если продавец в браке то
$marriage_info ="4.4. Продавец довел до Покупателя сведения о том, что транспортное средство приобретено им в период брака на совместные денежные средства с супругой(ом) __ ФИО __ и является совместным имуществом супругов. По заявлению Продавца договор заключается по обоюдному согласию супругов, Покупатель ознакомлен с содержанием указанного заявления. ";
$marriage_number = 5; //номер следующего пункта
//Если не в браке
$marriage_info = "";//пропускаем этот пункт
$marriage_number = 4; //номер следующего пункта
//----------------------------------------------------------------------------------------------------------------------

