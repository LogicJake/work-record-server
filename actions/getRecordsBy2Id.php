<?php

require_once './include/eth.function.php';

if(isset($_GET['id'],$_GET['work_id'])){
	$res = getRecordsBy2Id($_GET['id'],$_GET['work_id']);
	Result::success($res);
}
else
	Result::error("Lack of parameters.");