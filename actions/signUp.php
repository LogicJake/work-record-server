<?php
require_once './include/user.function.php';
if(isset($_POST['type'])){          //根据type决定是民工注册还是企业注册 0：民工；1：企业
    if($_POST['type'] == 0 && isset($_POST['name'],$_POST['age'],$_POST['phone'],$_POST['password'],$_POST['experience'])){
        $res = signUpWorker($_POST['name'],$_POST['age'],$_POST['phone'],$_POST['experience'],$_POST['password']);
        Result::success($res);
    }
    elseif($_POST['type'] == 1){
        $res = signUpWorker($_POST['name'],$_POST['age'],$_POST['phone'],$_POST['experience']);
        Result::success($res);
    }
    else
        Result::error("Illegal parameter 'type'.");     //type参数非法
}
else
	Result::error("Lack of parameters.");