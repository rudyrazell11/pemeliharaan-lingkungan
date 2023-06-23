<?php

session_start();
include '../../config/config.php';
include '../../config/koneksi.php';
include '../../function/helper.php';
is_login();
is_admin();

require_once '../../function/models/pembayaran.php';

$id_jenis_iuran = $_GET['id_jenis_iuran'];
$items = getPeriodeIuranByJenisIuran($id_jenis_iuran);

$json =  json_encode($items,JSON_PRETTY_PRINT);
header('Content-Type: application/json');
echo $json;