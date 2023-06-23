<?php

require_once 'function/models/blok.php';
require_once 'function/helper.php';

$data_komplek = getKomplek();
if (isset($_POST['tambah'])) {
    $tambah = tambahData($_POST);
    if ($tambah) {
       redirectUrl(BASE_URL . '/main.php?page=blok&status=success');
    } else {
        $error = '
        <div class="alert alert-danger">
        Blok gagal ditambahkan!
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah Blok</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="">Data Blok</a></div>
            <div class="breadcrumb-item">Tambah Blok</div>
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
                                <label for="nama_blok">Nama Blok</label>
                                <input type="text" class="form-control" name="nama_blok" value="" id="nama_blok">
                            </div>
                            <div class="form-group">
                                <label for="id_komplek">Komplek</label>
                                <select name="id_komplek" id="id_komplek" class="form-control">
                                    <option value="" >Pilih Komplek</option>
                                    <?php foreach ($data_komplek as $key => $komplek) : ?>
                                        <option value="<?= $komplek['id_komplek'] ?>"><?= $komplek['nama_komplek'] ?></option>
                                    <?php endforeach; ?>
                                </select>
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
</section>