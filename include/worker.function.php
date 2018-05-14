<?php
function listWork($type,$page){
    $page_num = 10;
    $start_page = ($page-1)*$page_num;
    global $db;
    $count = $db->count("task_wages", [
        "field" => $type,
    ]);
    $max_page = $count/$page_num;
    if($page<$max_page)
        $ret['finished'] = FALSE;
    else
        $ret['finished'] = TRUE;
    $res = $db->select("task_wages", [
        "task_id",
        "field",
        "wage"
    ],[
        "field" => $type,
        "LIMIT" => [ $start_page,  $start_page+$page_num]
    ]);
    foreach($res as $k => $v){
        $task = $db->get("task",[
            "address",
            "phone",
            "house",
            "welfare",
            "start_time",
            "company_id"
        ],[
            "id" => $v['task_id']
        ]);
        $v = array_merge($v,$task);
        $company = $db->get("company",[
            "name",
            "phone",
            "mail",
            "address",
            "number"
        ],[
            "id" => $task['company_id']
        ]);
        $v['comapny_info'] = $company;
        $res[$k]=$v;
    }
    $ret['work'] = $res;
    return $ret;
}

function applyJob($work_id){
    global $uid,$db;
    date_default_timezone_set('PRC');
    $add_time = time();
    $res = $db->has("apply",[
        "work_id" => $work_id,
        "worker_id" => $uid
    ]);
        if($res)
        $ret['status'] = -1;
    else{
        $db->insert("apply",[
            "work_id" => $work_id,
            "worker_id" => $uid,
            "status" => 0,
            "add_time" => $add_time
        ]);
        $ret['status'] = 1;
    }
    return $ret;
}