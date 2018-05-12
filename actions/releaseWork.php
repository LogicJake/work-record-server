<?php

require_once './include/company.function.php';

if(isset($_GET['address'],$_GET['phone'],$_GET['wages'],$_GET['house'],$_GET['welfare'],$_GET['start_time'])){
	$res = releaseWork($_GET['address'],$_GET['phone'],$_GET['wages'],$_GET['house'],$_GET['welfare'],$_GET['start_time']);
	Result::success($res);
}
else
	Result::error("Lack of parameters.");