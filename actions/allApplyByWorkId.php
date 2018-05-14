<?php

require_once './include/company.function.php';

if(isset($_GET['work_id'])){
	$res = allApplyByWorkId($_GET['work_id']);
	Result::success($res);
}
else
	Result::error("Lack of parameters.");