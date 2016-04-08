<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function login($login = '', $password = ''){
        $this->db->select('password, id');
        $this->db->from('users');
        $this->db->where('email', $login);
        $query = $this->db->get();
        $result = $query->row();

        if ($query->num_rows() == 1) {
            $password = md5($password . 'soult228');
            if ($result->password === $password) {
                $_SESSION['user_id'] = $result->id;
                $_SESSION['user_email'] = $login;
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    public function reset_pass($email)
    {
        $this->db->where("email", $email);
        $query = $this->db->get("users",1,0);
        if($query->num_rows() == 1)
        {
            $pass = $this->generate_password(8);
            $password = md5($pass . 'soult228');

            $data = array(
                'password' => $password
            );
            $query = $query->row();
            $this->db->where('id',$query->id);
            $this->db->update('users', $data);

            $text = "Спасибо за использование нашего сервиса CarsDoc.ru!<br>";
            $text.= "Ваш новый пароль от <a href=\"http://carsdoc.ru/user/login\">личного кабинета</a><br>";
            $text.= "Пароль: " . $pass . "<br>";
            $text.= "Внимание! Поменяйте сгенерированый пароль на новый!<br>";

            //Отправляем пароль

            $this->load->library('email');

            $this->email->from('admin@carsdoc.ru', 'CarsDoc');
            $this->email->to($email);
            $this->email->set_mailtype("html");
            $this->email->subject('Востановление пароля');
            $this->email->message($text);

            $this->email->send();
        }else{
            return false;
        }
        return true;
    }
    public function register($email)
    {
        $this->db->where("email", $email);
        $query = $this->db->get("users",1,0);
        if($query->num_rows() == 0)
        {
            $pass = $this->generate_password(8);
            $password = md5($pass . 'soult228');
            //preg_match("/(.*)@/", $email, $login);
            $login = $email;
            $data = array(
                'login' => $login,
                'email' => $email,
                'password' => $password
            );
            $this->db->insert('users', $data);
            $user_id = $this->db->insert_id();

            $text = "Спасибо за использование нашего сервиса CarsDoc.ru!<br>";
            $text.= "Теперь вы можете зайти в <a href=\"http://carsdoc.ru/user/login\">личный кабинет</a><br>";
            $text.= "Логин: " . $email . "<br>";
            $text.= "Пароль: " . $pass . "<br>";
            $text.= "Внимание! Поменяйте сгенерированый пароль на новый!<br>";

            //Отправляем почту в фидгии
            $this->send_email_to_db($email);
            //Отправляем на почту логин и пароль
            $this->load->library('email');

            $this->email->from('admin@carsdoc.ru', 'CarsDoc');
            $this->email->to($email);
            $this->email->set_mailtype("html");
            $this->email->subject('Ваш договор готов');
            $this->email->message($text);

            $this->email->send();


        }else{
            $result = $query->row();
            $user_id = $result->id;
        }
        return $user_id;
    }

    public function login_in()
    {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    }

    private function generate_password($number)
    {
        $arr = array('a','b','c','d','e','f',
            'g','h','i','j','k','l',
            'm','n','o','p','r','s',
            't','u','v','x','y','z',
            'A','B','C','D','E','F',
            'G','H','I','J','K','L',
            'M','N','O','P','R','S',
            'T','U','V','X','Y','Z',
            '1','2','3','4','5','6',
            '7','8','9','0','.',',',
            '(',')','[',']','!','?',
            '&','^','%','@','*','$',
            '<','>','/','|','+','-',
            '{','}','`','~');
        // Генерируем пароль
        $pass = "";
        for($i = 0; $i < $number; $i++)
        {
            // Вычисляем случайный индекс массива
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }
        return $pass;
    }
    public function getUserPayments($user_id)
    {
        $this->db->where("userID", $user_id);
        $result = $this->db->get("payments");
        return $result->result_array();
    }
    public function getListDocuments($page = 0)
    {
        $userID = $_SESSION['user_id'];

        $date = new DateTime();
        $date->modify("-30 days");
        $date = $date->format("Y-m-d");

        $this->db->where("documents.user_id", $userID);
        $this->db->where("DATE(documents.date)>", $date);
        $return['pages'] = (int) $this->db->count_all_results('documents') / 5;

        $this->db->distinct("documents.id");
        $this->db->select("documents.id, documents.doc_id, documents.table, types.document_name, payments.type, documents.date, types.url");
        $this->db->where("documents.user_id",$userID);
        $this->db->where("DATE(documents.date)>", $date);
        $this->db->join("types", "types.url=documents.table");
        $this->db->join("payments", "payments.payID=documents.id");
        $this->db->order_by("documents.date","desc");
        $result = $this->db->get("documents",5,$page*5);

        $types = $this->db->get("types")->result_array();

        $data = array();
        foreach ($result->result_array() as $item) {
            $data[$item['id']]['type_s'] = ($item['type']==1)?"Оплаченно":"Не оплаченно";
            $data[$item['id']]['type'] = $item['type'];
            $data[$item['id']]['date'] = $item['date'];

            $this->db->select("{$item['table']}.type_id");
            $this->db->where("id",$item['doc_id']);
            $type_id = $this->db->get($item['table'])->row();

            foreach ($types as $type) {
                if($type['id']==$type_id->type_id)
                    $data[$item['id']]['doc'][] = array(
                        'document_name' => $type['document_name'],
                        'url' => $type['url']
                    );
            }
            if($item['url']=="buy_sale") {
                $data[$item['id']]['block_name'] = $item['document_name'];
                $data[$item['id']]['url'] = $item['url'];
            }
            if($item['url']=="gift"){
                $data[$item['id']]['block_name'] = $item['document_name'];
                $data[$item['id']]['url'] = $item['url'];
            }
            $date = new DateTime($item['date']);
            $interval = $date->diff(new DateTime());
            $data[$item['id']]['day'] = 30 - $interval->format('%a');
        }
        $return['documents'] = $data;

        return $return;
    }
    public function checkSub($user_id, $doc_id)
    {
        $this->db->where("subscribe.user_id", $user_id);
        $this->db->where("subscribe.date_finish > NOW()");
        $result = $this->db->get("subscribe",1,0);
        if($result->num_rows()>0){
            $this->db->insert('payments', array('userID'=>$user_id,'payID'=>$doc_id,'date'=>date("Y-m-d H:i:s"),'type'=>1));
            return true;
        }else{
            return false;
        }

    }
    public function send_email_to_db($email){
        // Ваш ключ доступа к API
        $api_key = "3e8d76dc9e9b4f7e84c7cbaf76b1ef6e";//Поменяй на нужный апи, который тебе выдаст сервис
        //Имя метода
        $method = "listSubscribeOptInNow";
        //параметры
        $list_id = "94138";
        $phone = "";
        $fname = "";
        $lname = "";
        $mobilecountry = "";
        $fname = "";
        $lname = "";
        $parameters = "apikey=$api_key&list_id=$list_id&email=$email&phone=&mobilecountry=&fname=&lname=&names=&values=&optin=TRUE&update_existing=TRUE";
        // Создаём GET-запрос
        $api_url = "http://api.feedgee.com/1.0/$method?$parameters";
        //echo $email;
        // Делаем запрос на API-сервер
        if( $curl = curl_init() ) {
            $uagent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)";
            curl_setopt($curl, CURLOPT_URL, $api_url);
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION,1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl, CURLOPT_ENCODING, "gzip, deflate");
            curl_setopt($curl, CURLOPT_USERAGENT, $uagent);
            curl_setopt($curl, CURLOPT_COOKIEJAR, "coo.txt");
            curl_setopt($curl, CURLOPT_COOKIEFILE, "coo.txt");
            $out = curl_exec($curl);
            curl_close($curl);
        }
    }
    public function userInfo($user_id){
        $this->db->select("*");
        $this->db->where("users.id",$user_id);
        $query = $this->db->get("users",1,0);
        return $query->row();
    }
    public function userGlobalInfo($user_id){

        $this->db->where("user_id",$user_id);
        $data['doc_create'] = $this->db->count_all_results("documents");

        $this->db->select("subscribe.date_finish");
        $this->db->where("subscribe.user_id", $user_id);
        $this->db->where("subscribe.date_finish > NOW()");
        $result = $this->db->get("subscribe",1,0);
        $query = $result->row();
        if($result->num_rows()>0){
            $dif = ceil((strtotime($query->date_finish) - time()) / 86400);
            $data['subscribe'] = $dif. "<small style=\"font-size:50%\">дней</small>";
        }else{
            $data['subscribe'] = "<a style=\"font-size: 15px\" href='/user/subscription'>Оформить</a>";
        }

        $this->db->where("user_id",$user_id);
        $this->db->join("payments","payments.payID=documents.id");
        $data['doc_pay'] = $this->db->count_all_results("documents");
        $this->db->flush_cache();
        $data['doc_all'] = $this->db->count_all("documents");

        return $data;
    }
    public function saveProfile($post, $user_id)
    {
        $this->db->where("email",$post['email']);
        $this->db->where("id <>", $user_id);
        if($this->db->count_all_results("users"))
        {
            return false;
        }

        $this->db->where("id",$user_id);
        $this->db->set("fio",$post['fio']);
        $this->db->set("email",$post['email']);
        $this->db->set("login",$post['email']);
        if(!empty($post['password'])){
            $password = md5($post['password'] . 'soult228');
            $this->db->set("password",$password);
        }
        $this->db->set("about",$post['about']);
        $this->db->update("users");
        return true;
    }
}