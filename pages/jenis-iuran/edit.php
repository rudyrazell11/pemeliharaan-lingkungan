<?php

require_once 'function/models/jenis_iuran.php';

$id_jenis_iuran = $_GET['id_jenis_iuran'];

$item = getById($id_jenis_iuran);

if(!$item)
   redirectUrl(BASE_URL. '/main.php?page=jenis-iuran');

if (isset($_POST['update'])) {
    validasiEdit($_POST);
    $update = updateData($_POST);
    if ($update) {
      redirectUrl(BASE_URL . '/main.php?page=jenis-iuran&status=success&message=Jenis Iuran berhasil diupdate!');
    } else {
        $error = '
        <div class="alert alert-danger">
         Jenis Iuran gagal diupdate!
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Edit Jenis Iuran</h1>
        <div class="section-header-breadcrumb">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=jenis-iuran' ?>">Data Jenis Iuran</a></div>
            <div class="breadcrumb-item">Edit Jenis Iuran</div>
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
                            <input type="text" name="id_jenis_iuran" value="<?= $item['id_jenis_iuran'] ?>" hidden>
                            <div class="form-group">
                                <label for="nama_jenis">Nama</label>
                                <input type="text" class="form-control" name="nama_jenis" value="<?= $item['nama_jenis'] ?>" id="nama_jenis">
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
