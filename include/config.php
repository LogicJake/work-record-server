<?php
use Medoo\Medoo;

$db = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'work_record',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8'
]);