<?php

session_start();
include '../../config/config.php';
include '../../config/koneksi.php';
include '../../function/helper.php';
is_login();
is_admin();

require_once '../../function/models/blok.php';

$id_komplek = $_GET['id_komplek'];
$items = getBykomplek($id_komplek);

$json =  json_encode($items,JSON_PRETTY_PRINT);
header('Content-Type: application/json');
echo $json;