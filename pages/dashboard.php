<?php

require_once 'function/models/dashboard.php';
require_once 'function/helper.php';

$total_pembayaran = pembayaran()['total'];
$total_warga = warga()['total'];
$total_jenis_iuran = jenis_iuran()['total'];
$total_periode_iuran = periode_iuran()['total'];

$items = getPembayaranLatest();
?>

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <?= $total_pembayaran ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Warga</h4>
                    </div>
                    <div class="card-body">
                        <?= $total_warga ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Jenis Iuran</h4>
                    </div>
                    <div class="card-body">
                        <?= $total_jenis_iuran ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Periode Iuran</h4>
                    </div>
                    <div class="card-body">
                        <?= $total_periode_iuran ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Laporan Transaksi Tahun </h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Laporan Jumlah Program Berdasarkan Kategori</h4>
                </div>
                <div class="card-body">
                    <canvas id="myPie" style="w-100"></canvas>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pembayaran Terakhir</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dTable">
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
                                foreach ($items as $item) : ?>
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
                                            <?php else : ?>
                                                <span class="badge badge-danger">Gagal</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>