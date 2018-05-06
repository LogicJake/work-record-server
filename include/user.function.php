<?php
function addExperience($id,$experience){
    $arr = explode(",",$experience);
    $data = array();
    foreach($arr as $a){
        $left = stripos($a,"(");
        $right = stripos($a,")");
        $field = substr($a,0,$left);
        $year = substr($a,$left+1,$right-$left-1);
        $tmp['field'] = $field;
        $tmp['user_id'] = $id;
        $tmp['year'] = $year;
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