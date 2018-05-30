<?php
function getTaskInfo($id){
    global $db;
    $task = $db->get("task",[
        "address",
        "phone",
        "house",
        "welfare",
        "start_time",
        "company_id",
        "add_time"
    ],[
        "id" => $id
    ]);
    return $task;
}

function getCompanyInfo($id){
    global $db;
    $company = $db->get("company",[
            "name",
            "phone",
            "mail",
            "address",
            "number"
        ],[
            "id" => $id
        ]);
    return $company;
}

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
        "LIMIT" => [ $start_page,  $start_page+$page_num],
        "ORDER"=>["task_id"=>"DESC"]
    ]);
    foreach($res as $k => $v){
        $task = getTaskInfo($v['task_id']);
        $v = array_merge($v,$task);
        $company = getCompanyInfo($task['company_id']);
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

function listApplyJob($page){
    $page_num = 10;
    $start_page = ($page-1)*$page_num;
    global $uid,$db;
    $res = $db->select("apply",[
        "work_id",
        "status",
        "add_time"
    ],[
        "worker_id" => $uid,
        "LIMIT" => [$start_page,$start_page+$page_num],
        "ORDER"=>["add_time"=>"DESC"]
    ]);
    foreach($res as $k => $v){
        $task = getTaskInfo($v['work_id']);
        $v['task_info'] = $task;
        $res[$k]=$v;
    }

    $count = $db->count("apply", [
        "worker_id" => $uid
    ]);
    $max_page = $count/$page_num;
    if($page<$max_page)
        $ret['finished'] = FALSE;
    else
        $ret['finished'] = TRUE;
    $ret['apply_work'] = $res;
    return $ret;
}

function getrecommand()
{
    global $db,$uid;
    $allexp =['装修施工', '建筑施工', '家装主材安装', '门窗玻璃安装', '隔墙吊顶', '家具软装维修', '电器安装维修', '家政服务', '管道疏通', '园林绿化', '路桥建设', '其他'];

    foreach ($allexp as $keyi => $valuei) {
        foreach ($allexp as $keyj => $valuej) {
            $relaexp[$valuei][$valuej]=0;
        }

    }
    $worker = $db->select('worker_experience',
        'user_id'
        // 'field'
    ,[
        'GROUP'=>'user_id'
    ]);
    $worker_exp=[];
    foreach ($worker as $key => $value) {
        // var_dump($value);
        $re = $db->select('worker_experience',
        [
            'user_id',
            'field'
        ]
        ,[
            'user_id'=>$value,
            'GROUP'=>'field'
        ]);
        foreach ($re as $keyi => $valuei) {
            // var_dump($valuei['user_id']);
            foreach ($re as $keyj => $valuej){
                if($keyj>$keyi)
                {
                    if($valuei['field']==$valuej['field'])
                    {
    
                    }else{
                        // var_dump($valuei['user_id'].' ppppppppp'.$valuei['field'].' '.$valuej['field'].'  '.$relaexp[$valuei['field']][$valuej['field']]);
                        $relaexp[$valuei['field']][$valuej['field']]+=1;
                        $relaexp[$valuej['field']][$valuei['field']]+=1;
                        if($valuei['field']=='隔墙吊顶'&&$valuej['field']=='建筑施工')
                        {
                            // var_dump('ppppppppp'.$valuei['field'].' '.$valuej['field'].'  '.$relaexp[$valuei['field']][$valuej['field']]);
                        }
    
                    }

                }
                // var_dump($relaexp[$valuej['field']][$valuei['field']]);
            }
            # code...
            // var_dump($valuei['field'],$value);
        }
    }
    foreach ($relaexp as $key => $value) {
        arsort($relaexp[$key]);
    }
    $wexp = $db->select('worker_experience',
        // 'user_id'
        'field'
    ,[
        'user_id' => $uid,
        'GROUP'=>'field'
    ]);
    $re=[];
    foreach ($wexp as $key => $value) {
        $i=0;
            foreach ($relaexp[$value] as $key1 => $value1) {

                if($value1>0)
                {
                    array_push($re,$key1);
                }
                $i++;
                if($i>3)
                    break;
            }

    }
    $re = array_unique($re);
    return $re;
}