<?php
function listWork($type){
    global $db;
    $res = $db->select("task_wages", [
        "task_id",
        "field",
        "wage"
    ],[
        "field" => $type
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
   return $res;
}