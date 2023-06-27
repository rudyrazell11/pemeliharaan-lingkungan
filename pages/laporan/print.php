<?php
require_once '../../config/koneksi.php';
require_once '../../function/helper.php';
require_once '../../config/config.php';
require_once '../../function/models/pembayaran.php';

$filter = [
    'id_jenis_iuran' => $_GET['id_jenis_iuran'],
    'id_periode_iuran' => $_GET['id_periode_iuran'],
    'status' => $_GET['status']
];

$data_pembayaran = getPembayaranFilter($filter);
if ($filter['id_jenis_iuran']) {
    $jenis_iuran = getIuranById($filter['id_jenis_iuran']);
}else{
    $jenis_iuran = NULL;
}

if ($filter['id_periode_iuran']) {
    $periode = getPeriodeById($filter['id_periode_iuran']);
}else{
    $periode = NULL;
}

if ($filter['status']) {
    $status = $filter['status'];
} else {
    $status = 'Semua';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pembayaran</title>
    <style>
        body {
            font-size: 12px;
        }

        table {
            width: 100%;
        }

        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row,
        tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
    <script>
        window.print();
    </script>
</head>

<body>
    <h2 style="text-align: center">Laporan Pembayaran</h2>
    <table class="tb-info">
        <tr>
            <td style="text-align:left">Jenis Iuran</td>
            <td> : </td>
            <td>
                <?= $jenis_iuran['nama_jenis'] ?? 'Semua' ?>
            </td>
        </tr>
        <tr>
            <td style="text-align:left">Periode Iuran</td>
            <td> : </td>
            <td>
                <?php if ($periode) : ?>
                    <?= getMonthName($periode['bulan']) . ' - ' . $periode['tahun']  ?>
                <?php else : ?>
                    Semua
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align:left">Status</td>
            <td> : </td>
            <td>
                <?= $status ?>
            </td>
        </tr>
    </table>
    <table class="styled-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Kode Pembayaran</th>
                <th>Nama Warga</th>
                <th>Jenis Iuran</th>
                <th>Nominal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data_pembayaran as $item) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $item['tanggal'] ?></td>
                    <td><?= $item['kode_pembayaran'] ?></td>
                    <td><?= $item['nama_warga'] ?></td>
                    <td><?= $item['nama_jenis'] ?></td>
                    <td>Rp <?= number_format($item['nominal']) ?></td>
                    <td>
                        <?php if ($item['status'] === 'Belum Bayar') : ?>
                            <span class="badge badge-info">Belum Bayar</span>
                        <?php elseif ($item['status'] === 'Sudah Bayar') : ?>
                            <span class="badge badge-success">Sudah Bayar</span>
                        <?php elseif ($item['status'] === 'Proses') : ?>
                            <span class="badge badge-info">Menunggu Verifikasi</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Gagal</span>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>