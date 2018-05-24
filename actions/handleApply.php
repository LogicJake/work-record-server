<?php

require_once './include/company.function.php';

if(isset($_GET['apply_id'],$_GET['sure'])){
	$res = handleApply($_GET['apply_id'],$_GET['sure']);
	Result::success($res);
}
else
	Result::error("Lack of parameters.");