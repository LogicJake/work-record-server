<?php
ini_set('display_errors',1);            //错误信息 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
session_start();

require_once './include/Medoo.php';
require_once './include/config.php';
require_once './include/result.class.php';
require_once './include/token.class.php';


// white list
$actionList = ['signUp','addRecord','calHour','login','releaseWork','unlockAccount','getRecord'];          //所有action列表

$noTokenList = ['signUp','addRecord','calHour','login','unlockAccount'];         //不需要token的action

$companyTokenList = ['releaseWork','addRecord'];         //只能公司进行的操作

$workerTokenList = ['getRecord'];         //只能工人进行的操作

if (!isset($_GET['_action'])) {
    Result::error('missing _action');
}
if (!in_array($_GET['_action'], $actionList)) {
    Result::error('_action error');
}

if (in_array($_GET['_action'], $noTokenList)){//如果是不需要token的 action 直接进入
    require_once "actions/{$_GET['_action']}.php";

} else {//token验证
    if (!isset($_GET['token'])){//无token错误
        Result::error('no token');
    }
    
    if(Token::userid($_GET['token']) < 1){//token不存在终止
        Result::error('token wrong');
    }

    if (in_array($_GET['_action'], $companyTokenList))  //如果只能公司进行的，检查token
    {
        if(!Token::isCompany($_GET['token']))
            Result::error('No authority');      //无权限
    }

    if (in_array($_GET['_action'], $workerTokenList))  //如果只能工人进行的，检查token
    {
        if(Token::isCompany($_GET['token']))
            Result::error('No authority');      //无权限
    }

    $GLOBALS['uid'] = Token::userid($_GET['token']);
    require_once "actions/{$_GET['_action']}.php";
}