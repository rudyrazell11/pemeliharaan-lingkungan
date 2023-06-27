<?php

require_once 'function/models/komplek.php';

$id_komplek = $_GET['id_komplek'];

$item = getById($id_komplek);

if (!$item)
    redirectUrl(BASE_URL . '/main.php?page=komplek');

if (isset($_POST['update'])) {
    validasiEdit($_POST);
    $update = updateData($_POST);
    if ($update) {
        redirectUrl(BASE_URL . '/main.php?page=komplek&status=success&message=Komplek berhasil diupdate!');
    } else {
        $error = '
        <div class="alert alert-danger">
        Komplek Gagal di update.
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Edit Komplek</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="">Data Komplek</a></div>
            <div class="breadcrumb-item">Edit Komplek</div>
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
                            <input type="text" name="id_komplek" value="<?= $item['id_komplek'] ?>" hidden>
                            <div class="form-group">
                                <label for="nama_komplek">Nama Komplek</label>
                                <input type="text" class="form-control" name="nama_komplek" value="<?= $item['nama_komplek'] ?>" id="nama_komplek">
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