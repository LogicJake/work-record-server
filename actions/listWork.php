<?php

require_once './include/worker.function.php';

if(isset($_GET['type'],$_GET['page'])){
	$res = listWork($_GET['type'],$_GET['page']);
	Result::success($res);
}
else
	Result::error("Lack of parameters.");