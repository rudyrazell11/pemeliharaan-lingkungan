<?php

require_once 'function/models/metode_pembayaran.php';

$id_metode_pembayaran = $_GET['id_metode_pembayaran'];

$item = getById($id_metode_pembayaran);

if (!$item)
    redirectUrl(BASE_URL . '/main.php?page=metode-pembayaran');

if (isset($_POST['update'])) {

    validasiEdit($_POST);
    $update = updateData($_POST);
    if ($update) {
        redirectUrl(BASE_URL . '/main.php?page=metode-pembayaran&status=success&message=Metode Pembayaran berhasil diupdate!');
    } else {
        $error = '
        <div class="alert alert-danger">
            Metode Pembayaran gagal diupdate!
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Edit Metode Pembayaran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="">Data Metode Pembayaran</a></div>
            <div class="breadcrumb-item">Edit Metode Pembayaran</div>
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
                            <input type="text" name="id_metode_pembayaran" value="<?= $item['id_metode_pembayaran'] ?>" hidden>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?= $item['nama'] ?>" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="nomor">Nomor</label>
                                <input type="text" class="form-control" name="nomor" value="<?= $item['nomor'] ?>" id="nomor">
                            </div>
                            <div class="form-group">
                                <label for="pemilik">Pemilik</label>
                                <input type="text" class="form-control" name="pemilik" value="<?= $item['pemilik'] ?>" id="pemilik">
                            </div>
                            <div class="form-group">
                                <button name="update" class="btn btn-block btn-primary"><i class="fas fa-save"></i>
                                    Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</section>