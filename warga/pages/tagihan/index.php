<?php

require_once 'warga/function/models/warga.php';

$items = getPeriodeIuran();

?>
<section class="section">
    <div class="section-header">
        <h1>Daftar Tagihan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item">Daftar Tagihan</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Jenis Iuran</th>
                                        <th>Nominal</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($items as $item) : ?>
                                        <?php $cek_periode = cekPeriodeIuran($_SESSION['id_user'], $item['id_periode_iuran']);  ?>
                                        <!-- cek jika belum bayar, tampilkan -->
                                        <?php if ($cek_periode == false || $cek_periode['status'] !== 'Sudah Bayar') : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $item['nama_jenis'] ?></td>
                                                <td>Rp <?= number_format($item['nominal']) ?></td>
                                                <td><?= getMonthName($item['bulan']) ?></td>
                                                <td><?= $item['tahun'] ?></td>
                                                <td>
                                                    <?php if ($cek_periode == false) : ?>
                                                        <a href="<?= BASE_URL . '/warga.php?page=bayar-iuran&id_periode_iuran=' . $item['id_periode_iuran'] ?>" class="btn btn-info">Bayar Sekarang</a>
                                                    <?php elseif ($cek_periode['status'] === 'Proses') : ?>
                                                        <span class="btn btn-warning">Menunggu Verifikasi</span>
                                                    <?php elseif ($cek_periode['status'] === 'Gagal') : ?>
                                                        <span class="btn btn-danger">Gagal</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
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