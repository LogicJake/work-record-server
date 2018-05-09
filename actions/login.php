<?php
require_once './include/user.function.php';
if(isset($_GET['type'])){          //根据type决定是民工还是企业 1：民工；0：企业
    if($_GET['type']==1){
        if(isset($_GET['phone'],$_GET['password']))
        {
            $res = loginWorker($_GET['phone'],$_GET['password']);
            Result::success($res);
        }
        else
	        Result::error("Lack of parameters.");
    }
    elseif($_GET['type']==0){
        if(isset($_GET['number'],$_GET['password']))
        {
            $res = loginCampany($_GET['number'],$_GET['password']);
            Result::success($res); 
        }
        else
            Result::error("Lack of parameters.");
    }
    else
        Result::error("Illegal parameter 'type'.");     //type参数非法
}
else
	Result::error("Lack of parameters.");