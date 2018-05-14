<?php

require_once './include/worker.function.php';

if(isset($_GET['work_id'])){
	$res = applyJob($_GET['work_id']);
	Result::success($res);
}
else
	Result::error("Lack of parameters.");