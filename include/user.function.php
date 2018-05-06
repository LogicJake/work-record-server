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