<?php

require_once './include/eth.function.php';

if(isset($_GET['id'])){
	$res = calHour($_GET['id']);
	Result::success($res);
}
else
	Result::error("Lack of parameters.");