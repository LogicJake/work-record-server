<?php

require_once './include/eth.function.php';

$res = getworkids();
Result::success($res);