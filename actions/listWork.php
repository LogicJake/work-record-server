<?php

require_once './include/worker.function.php';

if(isset($_GET['type'])){
	$res = listWork($_GET['type']);
	Result::success($res);
}
else
	Result::error("Lack of parameters.");