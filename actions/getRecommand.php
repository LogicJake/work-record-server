<?php

require_once './include/worker.function.php';
    $res = getrecommand();
    Result::success($res);
