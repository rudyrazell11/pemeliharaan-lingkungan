<?php

require_once 'function/models/metode_pembayaran.php';


if (isset($_POST['tambah'])) {
    validasiTambah($_POST);
    $tambah = tambahData($_POST);
    if ($tambah) {
      redirectUrl(BASE_URL . '/main.php?page=metode-pembayaran&status=success&message=Metode Pembayaran berhasil ditambah!');
    } else {
        $error = '
        <div class="alert alert-danger">
         Metode Pembayaran gagal ditambahkan!
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah Metode Pembayaran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=metode-pembayaran' ?>">Data Metode Pembayaran</a></div>
            <div class="breadcrumb-item">Tambah Metode Pembayaran</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($error)) : ?>
                            <?= $error ?>
                        <?php endif; ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" value="" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="nomor">Nomor</label>
                                <input type="text" class="form-control" name="nomor" value="" id="nomor">
                            </div>
                            <div class="form-group">
                                <label for="pemilik">Pemilik</label>
                                <input type="text" class="form-control" name="pemilik" value="" id="pemilik">
                            </div>
                            <div class="form-group">
                                <button name="tambah" class="btn btn-block btn-primary"><i class="fas fa-plus"></i>
                                    Tambah</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</section>
