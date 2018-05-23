<?php
function addWages($id,$wages){
    $data = array();
    $arr = json_decode($wages,true);
    foreach($arr as $a){
       
        $tmp['field'] = $a['type'];
        $tmp['task_id'] = $id;
        $tmp['wage'] = $a['wage'];
        array_push($data,$tmp);
    }
    global $db;
    $db->insert("task_wages", $data);
}

function releaseWork($address,$phone,$wages,$house,$welfare,$start_time){
    global $db;
    global $uid;
    date_default_timezone_set('PRC');
    $add_time = time();
    $res=$db->insert("task",[
        "address" => $address,
        "phone" => $phone,
        "house" => $house,
        "welfare" => $welfare,
        "start_time" => $start_time,
        "company_id" => $uid,
        "add_time" => $add_time
    ]);
    $id = $db->id();
    addWages($id,$wages);
    $ret['status'] = 1;
    return $ret;
}

function handleApply($apply_id,$sure){
    global $db;
    if($sure==1){
        $db-> update("apply",[
            "status"=> 1
        ],[
            "id"=>$apply_id
        ]);

    }
    else{
        $db-> update("apply",[
            "status"=> -1
        ],[
            "id"=>$apply_id
        ]);
    }
    $ret['status'] = 1;
    return $ret;
}

function allMyWork(){
    global $uid,$db;
    $res = $db->select("task",[
        "id",
        "address",
        "phone",
        "house",
        "welfare",
        "start_time"
    ],[
        "company_id" => $uid
    ]);
    return $res;
}

function allApplyByWorkId($work_id){
    global $uid,$db;
    $res = $db->select("apply",[
        "id",
        "worker_id",
        "status"
    ],[
        "work_id" => $work_id
    ]);
    foreach ($res as $key => $value) {
        $name = $db->get("worker","name",[
        "id"=>$res[$key]["worker_id"]
        ]);
        $res[$key]["name"] = $name;
        $res[$key]["work_id"] = $work_id;
    }
    return $res;
}