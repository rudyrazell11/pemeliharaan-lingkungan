<?php

require_once 'function/models/metode_pembayaran.php';

$items = get();

if (isset($_POST['delete'])) {
    $delete = deleteData($_POST['id_metode_pembayaran']);
   redirectUrl(BASE_URL . '/main.php?page=metode-pembayaran&status=success&message=Metode Pembayaran berhasil dihapus!');
}

?>
<section class="section">
    <div class="section-header">
        <h1>Data Metode Pembayaran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Data Metode Pembayaran</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= BASE_URL . '/main.php?page=metode-pembayaran-create' ?>" class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Nomor</th>
                                        <th>Pemilik</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $item['nama'] ?></td>
                                            <td><?= $item['nomor'] ?></td>
                                            <td><?= $item['pemilik'] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL . '/main.php?page=metode-pembayaran-edit&id_metode_pembayaran=' . $item['id_metode_pembayaran'] ?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="text" name="id_metode_pembayaran" value="<?= $item['id_metode_pembayaran'] ?>" hidden>
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
