<?php

require_once './include/company.function.php';
$res = allMyWork();
Result::success($res);