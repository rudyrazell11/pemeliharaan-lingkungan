<?php

require_once 'function/models/jenis_iuran.php';


if (isset($_POST['tambah'])) {
    validasiTambah($_POST);
    $tambah = tambahData($_POST);
    if ($tambah) {
      redirectUrl(BASE_URL . '/main.php?page=jenis-iuran&status=success&message=Jenis Iuran berhasil ditambahkan!');
    } else {
        $error = '
        <div class="alert alert-danger">
        Jenis Iuran gagal ditambahkan!
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah Jenis Iuran</h1>
        <div class="section-header-breadcrumb">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=jenis-iuran' ?>">Data Jenis Iuran</a></div>
            <div class="breadcrumb-item">Tambah Jenis Iuran</div>
        </div>
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
                                <label for="nama_jenis">Nama Jenis</label>
                                <input type="text" class="form-control" name="nama_jenis" value="" id="nama_jenis">
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
