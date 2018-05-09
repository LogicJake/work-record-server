<?php
function addExperience($id,$experience){
    $data = array();
    $arr = json_decode($experience,true);
    foreach($arr as $a){
       
        $tmp['field'] = $a['experience'];
        $tmp['user_id'] = $id;
        $tmp['year'] = $a['year'];
        array_push($data,$tmp);
    }
    global $db;
    $db->insert("worker_experience", $data);
}

function signUpCompany($name,$phone,$mail,$address,$number,$password){
    global $db;
    $re =$db->has("company", [
        "number" => $number,
    ]);
    if($re)
        $return['status']=2;        //已被注册
    else
    {
        $db->insert("company", [
            "name" => $name,
            "phone" => $phone,
            "mail" => $mail,
            "address" => $address, 
            "number" => $number, 
            "password" => $password
        ]);
        $re = $db->get('company',['id'],['number'=> $number]);
        $id = $re['id'];
        $token = Token::addToken(0,$id);
        $return['token'] = $token;
        $return['status']=1;            //注册成功
        $return['id']=$id; 
    }
    return $return;
}

function signUpWorker($name,$age,$phone,$experience,$password){
    global $db;
    $re =$db->has("worker", [
        "phone" => $phone,
    ]);
    if($re)
        $return['status']=2;        //手机号码已被注册
    else
    {
        $db->insert("worker", [
            "name" => $name,
            "age" => $age,
            "phone" => $phone,
            "password" => $password, 
        ]);
        $re = $db->get('worker',['id'],['phone'=> $phone]);
        $id = $re['id'];
        addExperience($id,$experience);
        $token = Token::addToken(1,$id);
        $return['token'] = $token;
        $return['status']=1;            //注册成功
        $return['id']=$id; 
    }
    return $return;
}

function loginWorker($phone,$password){
    global $db;
    $res = $db->has("worker",[
        "phone" => $phone
     ]); 
     if(!$res)
         $ret['status'] = 0;   //0代表该手机号未注册
     else
     {
         $res = $db->has("worker",[
             "phone" => $phone,
             "password" => $password
         ]); 
         if($res){
             $id = $db->get("worker","id",[
                 "phone" => $phone,
                 "password" => $password
             ]); 
             $ret['id'] = $id;
             $ret['status'] = 1;   //1代表成功
             $ret['token'] = Token::addToken(1,$id);
         }
         else
             $ret['status'] = -1;   //-1代表失败
     } 
     return $ret;
}

function loginCampany($number,$password){
    global $db;
    $res = $db->has("company",[
        "number" => $number
     ]); 
     if(!$res)
         $ret['status'] = 0;   //0代表该手机号未注册
     else
     {
         $res = $db->has("company",[
             "number" => $number,
             "password" => $password
         ]); 
         if($res){
             $id = $db->get("company","id",[
                 "number" => $number,
                 "password" => $password
             ]); 
             $ret['id'] = $id;
             $ret['status'] = 1;   //1代表成功
             $ret['token'] = Token::addToken(0,$id);
         }
         else
             $ret['status'] = -1;   //-1代表失败
     } 
     return $ret;
}