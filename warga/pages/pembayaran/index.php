<?php

require_once 'warga/function/models/pembayaran.php';

$items = get();

?>
<section class="section">
    <div class="section-header">
        <h1>Data Pembayaran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item">Data Pembayaran</div>
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
                                        <th>Tanggal</th>
                                        <th>Kode Pembayaran</th>
                                        <th>Nama Warga</th>
                                        <th>Jenis Iuran</th>
                                        <th>Periode</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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
                                            <td><?= getMonthName($item['bulan']) . ' - ' . $item['tahun'] ?></td>
                                            <td>Rp <?= number_format($item['nominal']) ?></td>
                                            <td>
                                                <?php if ($item['status'] === 'Belum Bayar') : ?>
                                                    <span class="badge badge-info">Belum Bayar</span>
                                                <?php elseif ($item['status'] === 'Sudah Bayar') : ?>
                                                    <span class="badge badge-success">Sudah Bayar</span>
                                                <?php elseif ($item['status'] === 'Proses') : ?>
                                                    <span class="badge badge-warning">Menunggu Verifikasi</span>
                                                <?php else : ?>
                                                    <span class="badge badge-danger">Gagal</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= BASE_URL . '/warga.php?page=pembayaran-detail&id_pembayaran=' . $item['id_pembayaran'] ?>" class="btn btn-warning"><i class="fas fa-eye"></i> Detail</a>
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