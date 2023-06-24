<?php

require_once 'warga/function/models/dashboard.php';
require_once 'function/helper.php';

$jumlah_pembayaran = pembayaran()['total'];
$jumlah_tagihan = tagihan()['total'];
$jumlah_jenis_iuran = jenis_iuran()['total'];
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
                        <?= $jumlah_pembayaran ?>
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
                        <h4>Semua Tagihan Iuran</h4>
                    </div>
                    <div class="card-body">
                        <?= $jumlah_tagihan ?>
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
                        <h4>Jumlah Jenis Iuran</h4>
                    </div>
                    <div class="card-body">
                        <?= $jumlah_jenis_iuran ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>