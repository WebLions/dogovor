<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pay_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();//Работа с бд
    }
    public function getPayLink($doc_id)
    {
        $pay_amount = '390.00';
        $this->db->where("payID",$doc_id);
        $query = $this->db->get("payments",1,0);

        if($query->num_rows()=='0'){
            $data = array(
                "userID"=>$_SESSION['user_id'],
                "payID"=>$doc_id,
                "type"=>false,
                "money"=>$pay_amount,
                "date"=>date("Y-m-d H:i:s")
            );
            $this->db->insert('payments',$data);
            $for = $this->db->insert_id();
        }else{
            $result = $query->row();
            $for = $result->id;
        }
        $pay_for = $for;
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
            "f"=>11,
            "md5"=> $md5,
            "pay_for"=> $pay_for,
            "user_email"=> 'igorok901@mail.ru'
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
    public function check()
    {
        $pay_for = $_POST['pay_for'];
        $amount = $_POST['amount'];
        $user_email = $_POST['user_email'];
        $singature = $_POST['singature'];
        $way = $_POST['way'];
        $mode = $_POST['mode'];
        $secret_key = 'R0QR6V1juMy';

        $singature_1 = sha1("check;".$pay_for.";".$amount.";".$way.";".$mode.";".$secret_key);
        $this->db->insert("debag",array("text"=>"check"));
        $this->db->insert("debag",array("text"=>json_encode($_POST)));
        if($singature!=$singature_1)
        {
            $return['status'] = false;
            $return['pay_for'] = $pay_for;
            $return['singature'] = sha1("check;false".$pay_for.";".$secret_key);
            echo json_encode($return);
            return false;
        }
        $this->db->select("users.email");
        $this->db->join("payments","payments.userID=users.id");
        $this->db->where("payments.id",$pay_for);
        $query = $this->db->get("users",1,0);
        $result = $query->row();
        if($result->email!=$user_email)
        {
            $return['status'] = false;
            $return['pay_for'] = $pay_for;
            $return['singature'] = sha1("check;false".$pay_for.";".$secret_key);
            echo json_encode($return);
            return false;
        }
        $return['status'] = true;
        $return['pay_for'] = $pay_for;
        $return['singature'] = sha1("check;true".$pay_for.";".$secret_key);
        echo json_encode($return);
        return true;
    }
    public function pay()
    {
        $pay_for = $_POST['pay_for'];
        $user_email = $_POST['user_email'];
        $onpay_id = $_POST['onpay_id'];
        $order_amount = $_POST['order_amount'];
        $order_currency = $_POST['order_currency'];
        $order_id = $pay_for;
        $api_key = 'R0QR6V1juMy';
        $md5 = $_POST['md5'];

        $md5_1 = strtoupper(md5("pay;".$pay_for.";".$onpay_id.";".$order_amount.";".$order_currency.";".$api_key));
        $this->db->insert("debag",array("text"=>"pay"));
        $this->db->insert("debag",array("text"=>json_encode($_POST)));
        if($md5!=$md5_1)
        {
            $this->db->insert("debag",array("text"=>$md5_1));
            $md5 = strtoupper(md5("pay;".$pay_for.";".$onpay_id.";".$order_id.";".$order_amount.";".$order_currency.";7;".$api_key));
            echo<<<END
<?xml version="1.0" encoding="UTF-8"?>
	<result>
		<code>7</code>
		<comment>ERROR: md5 not found</comment>
		<onpay_id>{$onpay_id}</onpay_id>
		<pay_for>{$pay_for}</pay_for>
		<order_id>{$pay_for}</order_id>
		<md5>{$md5}</md5>
	</result>
END;
            return false;
        }
        $this->db->insert("debag",array("text"=>"md5 успешно!"));

        $this->db->select("users.email, payments.subID, users.id");
        $this->db->join("payments","payments.userID=users.id");
        $this->db->where("payments.id",$pay_for);
        $query = $this->db->get("users",1,0);
        $result = $query->row();
        $user_id = $result->id;
        $subID = $result->subID;
        if($result->email!=$user_email)
        {
            $this->db->insert("debag",array("text"=>$user_email));
            $md5 = strtoupper(md5("pay;".$pay_for.";".$onpay_id.";".$order_id.";".$order_amount.";".$order_currency.";3;".$api_key));
            echo<<<END
<?xml version="1.0" encoding="UTF-8"?>
	<result>
		<code>3</code>
		<comment>ERROR: client not found</comment>
		<onpay_id>{$onpay_id}</onpay_id>
		<pay_for>{$pay_for}</pay_for>
		<order_id>{$pay_for}</order_id>
		<md5>{$md5}</md5>
	</result>
END;
            return false;
        }
        $this->db->insert("debag",array("text"=>"email {$pay_for}"));
        //$this->db->flush_cache();
        $this->db->update("payments",array("type"=>"1"),array("id"=>$pay_for));
        /*$data = array(
            'type' => 1
        );
        $this->db->where('id', $pay_for);
        $this->db->update('payments', $data);*/
        //$this->db->flush_cache();
        //$this->db->flush_cache();
        $this->db->insert("debag",array("text"=>"Успешно зачислен!"));
        $md5 = strtoupper(md5("pay;".$pay_for.";".$onpay_id.";".$order_id.";".$order_amount.";".$order_currency.";0;".$api_key));
        echo<<<END
<?xml version="1.0" encoding="UTF-8"?>
	<result>
		<code>0</code>
		<comment>OK</comment>
		<onpay_id>{$onpay_id}</onpay_id>
		<pay_for>{$pay_for}</pay_for>
		<order_id>{$order_id}</order_id>
		<md5>{$md5}</md5>
	</result>
END;
        if($subID>0)
        {
            $this->db->insert("debag",array("text"=>"sub-{$pay_for}"));
            $this->setSub($pay_for, $user_id);
        }
        return true;
    }
    public function setSub($pay_id, $user_id)
    {
        $this->db->where("pay_id",$pay_id);
        $query = $this->db->get("subscribe",1,0);
        if($query->num_rows()>0)
        {
            return false;
        }

        $this->db->where("user_id",$user_id);
        $this->db->order_by("date_finish", "desc");
        $query = $this->db->get("subscribe",1,0);
        $result = $query->row();

        if($query->num_rows()>0)
        {
            $last_date = $result->date_finish;
            $this->db->select("subscribe_type.mouth");
            $this->db->where("payments.id", $pay_id);
            $this->db->join("subscribe_type","subscribe_type.id=payments.subID");
            $query = $this->db->get("payments",1,0);
            $result = $query->row();
            $srok = $result->mouth;
            $data = DateTime::createFromFormat('Y-m-d H:i:s',$last_date);
            $data->modify("+{$srok} month");
            $second_date = $data->format('Y-m-d H:i:s');
            $this->db->insert("debag",array("text"=>"re_sub"));
            $this->db->insert('subscribe',array('pay_id'=>$pay_id,'user_id'=>$user_id,'date_start'=>$last_date,'date_finish'=>$second_date));
            return true;
        }
        $this->db->insert("debag",array("text"=>"pre"));
        $this->db->select("subscribe_type.mouth");
        $this->db->where("payments.id", $pay_id);
        $this->db->join("subscribe_type","subscribe_type.id=payments.subID");
        $query = $this->db->get("payments",1,0);
        $result = $query->row();
        $srok = $result->mouth;
        $last_date = date("Y-m-d H:i:s");
        $data = DateTime::createFromFormat('Y-m-d H:i:s',$last_date);
        $data->modify("+{$srok} month");
        $second_date = $data->format('Y-m-d H:i:s');
        $this->db->insert('subscribe',array('pay_id'=>$pay_id,'user_id'=>$user_id,'date_start'=>$last_date,'date_finish'=>$second_date));
        $this->db->insert("debag",array("text"=>"yes"));
    }
    public function getPaySubLink($sub_id)
    {
        $this->db->where("id",$sub_id);
        $query = $this->db->get("subscribe_type",1,0);
        $result= $query->row();
        $pay_amount = $result->cost;

        $data = array(
            "userID"=>$_SESSION['user_id'],
            "subID"=>$sub_id,
            "type"=>false,
            "money"=>$pay_amount,
            "date"=>date("Y-m-d H:i:s")
        );
        $this->db->insert('payments',$data);
        $for = $this->db->insert_id();

        $pay_for = $for;
        $ticker = 'TST';
        $user_login = 'CarsDoc_ru';
        $user_email = $_SESSION['user_email'];
        $price_final = '0';
        $pay_type = '1';
        $notify_by_api = '0';
        $api_in_key = 'R0QR6V1juMy';

        $md5 =$pay_amount.":".$pay_for.":".$ticker.":".$user_login;
        $md5.=":".$price_final.":".$pay_type.":".$notify_by_api.":".$api_in_key;
        $md5 = md5(mb_strtoupper($md5));

        $data = array(
            "price_final"=> $price_final,
            "user_login"=> $user_login,
            "notify_by_api"=> $notify_by_api,
            "pay_type"=> $pay_type,
            "pay_amount"=> $pay_amount,
            "ticker"=> $ticker,
            "f"=>11,
            "md5"=> $md5,
            "pay_for"=> $pay_for,
            "user_email"=> $user_email
        );

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