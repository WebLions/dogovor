<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pay_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();//Работа с бд
    }
    public function getPayLink()
    {
        $pay_amount = '390.00';
        $pay_for = 'Оплата одного документа';
        $ticker = 'TST';
        $user_login = 'CarsDoc_ru';
        $price_final = '0';
        $pay_type = '1';
        $notify_by_api = '0';
        $api_in_key = 'R0QR6V1juMy';

        $md5 =$pay_amount.":".$pay_for.":".$ticker.":".$user_login;
        $md5.=":".$price_final.":".$pay_type.":".$notify_by_api.":".$api_in_key;
       // echo $md5."<br>";
        $md5 = md5(mb_strtoupper($md5));

        $data = array(
            "price_final"=> $price_final,
            "user_login"=> $user_login,
            "notify_by_api"=> $notify_by_api,
            "pay_type"=> $pay_type,
            "pay_amount"=> $pay_amount,
            "ticker"=> $ticker,
            "md5"=> $md5,
            "pay_for"=> $pay_for,
            "user_email"=> 'igorok901@gmail.com'
        );

        //$postdata = http_build_query($data,PHP_QUERY_RFC3986);
        //echo "&not<br>";
        //echo "<pre>";
        $fields_string = http_build_query($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://secure.onpay.ru/pay/make_payment_link");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}