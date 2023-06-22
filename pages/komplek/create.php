<?php

require_once 'function/models/komplek.php';


if (isset($_POST['tambah'])) {
    $tambah = tambahData($_POST);
    if ($tambah) {
      redirectUrl(BASE_URL . '/main.php?page=komplek&status=success');
    } else {
        $error = '
        <div class="alert alert-danger">
         Komplek gagal ditambahkan!
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah Komplek</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="">DataJe nis Iuran</a></div>
            <div class="breadcrumb-item">Tambah Komplek</div>
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
                                <label for="nama_komplek">Nama Komplek</label>
                                <input type="text" class="form-control" name="nama_komplek" value="" id="nama_komplek">
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