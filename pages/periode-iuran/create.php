<?php

require_once 'function/models/periode_iuran.php';
require_once 'function/helper.php';

$data_bulan = getMonth();
$data_jenis_iuran = getJenisIuran();
if (isset($_POST['tambah'])) {
    validasiTambah($_POST);
    $tambah = tambahData($_POST);
    if ($tambah) {
      redirectUrl(BASE_URL . '/main.php?page=periode-iuran&status=success&message=Periode Iuran berhasil ditambahkan!');
    } else {
        $error = '
        <div class="alert alert-danger">
         Periode Iuran gagal ditambahkan!
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah Periode Iuran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('admin.Metode Pembayaran.index') }}">Data Periode Iuran</a></div>
            <div class="breadcrumb-item">Tambah Periode Iuran</div>
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
                                <label for="bulan">Bulan</label>
                                <select name="bulan" id="bulan" class="form-control">
                                    <?php foreach ($data_bulan as $key => $bulan) : ?>
                                        <option value="<?= $key ?>"><?= $bulan ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_jenis_iuran">Jenis Iuran</label>
                                <select name="id_jenis_iuran" id="id_jenis_iuran" class="form-control">
                                    <?php foreach ($data_jenis_iuran as $key => $jenis) : ?>
                                        <option value="<?= $jenis['id_jenis_iuran'] ?>"><?= $jenis['nama_jenis'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="number" class="form-control" name="tahun" value="" id="tahun">
                            </div>
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="number" class="form-control" name="nominal" value="" id="nominal">
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