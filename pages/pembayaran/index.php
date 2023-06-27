<?php

require_once 'function/models/pembayaran.php';

$items = get();
if (isset($_POST['delete'])) {
    $delete = deleteData($_POST['id_pembayaran']);
    redirectUrl(BASE_URL . '/main.php?page=pembayaran&status=success&message=Pembayaran berhasil dihapus!');
}

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
                        <a href="<?= BASE_URL . '/main.php?page=pembayaran-create' ?>" class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
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
                                                <a href="<?= BASE_URL . '/main.php?page=pembayaran-edit&id_pembayaran=' . $item['id_pembayaran'] ?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="text" name="id_pembayaran" value="<?= $item['id_pembayaran'] ?>" hidden>
                                                    <button name="delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                                </form>

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