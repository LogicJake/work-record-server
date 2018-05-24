<?php

require_once './include/worker.function.php';
if(isset($_GET['page'])){
    $res = listApplyJob($_GET['page']);
    Result::success($res);
}
else
	Result::error("Lack of parameters.");