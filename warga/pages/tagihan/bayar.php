<?php

require_once 'warga/function/models/warga.php';
require_once 'function/helper.php';

$warga = getDetail($_SESSION['id_user']);
$periode_iuran = periodeIuranDetail($_GET['id_periode_iuran']);
if (!isset($periode_iuran) || !$warga) {
    redirectUrl(BASE_URL . '/warga.php?page=tagihan');
}
$data_metode_pembayaran = getMetodePembayaran();
$id_pembayaran = isset($_GET['id_pembayaran']) ? $_GET['id_pembayaran'] : NULL;
if (isset($_POST['bayar'])) {
    $_POST['id_pembayaran'] = $id_pembayaran;

    // validasi
    if(!$_FILES['bukti_pembayaran']['name'] || !$_POST['id_metode_pembayaran'])
    {
        redirectUrl(BASE_URL . '/warga.php?page=bayar-iuran&id_periode_iuran='.$_POST['id_periode_iuran'].'&id_pembayaran='.$_GET['id_pembayaran'].'&status=error&message=Metode Pembayaran dan Bukti Pembayaran tidak boleh kosong.');
    }

    $bayar = bayarTagihan($_POST);
    if ($bayar) {
        redirectUrl(BASE_URL . '/warga.php?page=tagihan&status=success&message=Tagihan berhasil di buat. Silahkan tunggu admin untuk verifikasi pembayaran.');
    } else {
        $error = '
        <div class="alert alert-danger">
         Pembayaran gagal!
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Bayar Tagihan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/warga.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/warga.php?page=tagihan' ?>">Data Tagihan</a></div>
            <div class="breadcrumb-item">Bayar Tagihan</div>
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

                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="text" value="<?= $warga['id_warga'] ?>" name="id_warga" hidden>
                            <input type="text" value="<?= $periode_iuran['id_periode_iuran'] ?>" name="id_periode_iuran" hidden>
                            <input type="text" value="<?= $periode_iuran['nominal'] ?>" name="nominal" hidden>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" value="<?= $warga['nama_warga'] ?>" readonly>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Periode Iuran</label>
                                <input type="text" class="form-control" value="<?= getMonthName($periode_iuran['bulan']) . ' - ' . $periode_iuran['tahun'] . ' | Rp ' . number_format($periode_iuran['nominal']) ?>" readonly>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_metode_pembayaran">Metode Pembayaran</label>
                                <select name="id_metode_pembayaran" id="id_metode_pembayaran" class="form-control">
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <?php foreach ($data_metode_pembayaran as $key => $metode_pembayaran) : ?>
                                        <option value="<?= $metode_pembayaran['id_metode_pembayaran'] ?>"><?= $metode_pembayaran['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                <input type="file" class="form-control"  name="bukti_pembayaran">
                                </select>
                            </div>
                            <div class="form-group">
                                <button name="bayar" class="btn btn-block btn-primary"><i class="fas fa-save"></i>
                                    Konfirmasi Sudah Bayar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
