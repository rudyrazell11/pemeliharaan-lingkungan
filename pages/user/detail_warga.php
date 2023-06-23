<?php

session_start();
include '../../config/config.php';
include '../../config/koneksi.php';
include '../../function/helper.php';
is_login();
is_admin();

require_once '../../function/models/user.php';

$id_warga = $_GET['id_warga'];
$items = getDetailWarga($id_warga);

$json =  json_encode($items,JSON_PRETTY_PRINT);
header('Content-Type: application/json');
echo $json;