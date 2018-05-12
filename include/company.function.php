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
    $res=$db->insert("task",[
        "address" => $address,
        "phone" => $phone,
        "house" => $house,
        "welfare" => $welfare
    ]);
    $id = $db->id();
    addWages($id,$wages);
    $ret['status'] = 1;
    return $ret;
}