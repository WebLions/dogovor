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
        $user_login = $_SESSION['email'];
        $price_final = '0';
        $pay_type = '1';
        $notify_by_api = '0';
        $api_in_key = '';


        $data = array(
            "price_final"=>"true",
            "user_login"=>"onpay",
            "notify_by_api"=>"true",
            "pay_type"=>"1",
            "pay_amount"=>"100",
            "ticker"=>"RUR",
            "md5"=>"cf653b4c4a7861b2224bd31eb3e3f291",
            "pay_for"=>"Order 342",
            "user_email"=>"user@pochta.ru"
        );

        $postdata = http_build_query($data);
        $uagent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://secure.onpay.ru/pay/make_payment_link");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_USERAGENT, $uagent);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_COOKIEJAR, "cokie.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE, "cokie.txt");
        $content = curl_exec($ch);

        echo $link;
        exit;
        return $link;
    }
}