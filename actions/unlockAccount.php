<?php

require_once './include/eth.function.php';

	$res = unlockAccount();
	Result::success($res);