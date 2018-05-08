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
        $token = Token::addToken($id);
        $return['token'] = $token;
        $return['status']=1;            //注册成功
        $return['id']=$id; 
    }
    return $return;
}

function login($type,$phone,$password){
    global $db;
    switch($type)
    {
        case 1:
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
                    $ret['token'] = Token::addToken($id);
                }
                else
                    $ret['status'] = -1;   //1代表失败
            } 
            return $ret;
            break;
        case 0:
            break;
    }
}