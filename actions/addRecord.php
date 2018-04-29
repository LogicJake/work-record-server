<?php

require_once './include/eth.function.php';

if(isset($_GET['id'],$_GET['num'],$_GET['date'])){
	$res = addRecord($_GET['id'],$_GET['date'],$_GET['num']);
	Result::success($res);
}
else
	Result::error("Lack of parameters.");