<?php

require_once 'function/models/pembayaran.php';
$id_pembayaran = $_GET['id_pembayaran'];
$item = getById($id_pembayaran);
$data_warga = getWarga();
$data_jenis_iuran = getJenisIuran();
$data_metode_pembayaran = getMetodePembayaran();
if (isset($_POST['tambah'])) {
    $tambah = updateData($_POST);
    if ($tambah) {
        redirectUrl(BASE_URL . '/main.php?page=pembayaran&status=success');
    } else {
        $error = '
        <div class="alert alert-danger">
         pembayaran Gagal di update.
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Edit pembayaran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="">Data pembayaran</a></div>
            <div class="breadcrumb-item">Edit pembayaran</div>
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
                            <input type="text" name="id_pembayaran" value="<?= $item['id_pembayaran'] ?>" hidden>
                            <input type="text" name="id_warga" value="<?= $item['id_warga'] ?>" hidden>
                            <div class="form-group">
                                <label for="id_warga">Warga</label>
                                <input type="text" class="form-control" value="<?= $item['nama_warga'] ?>" readonly>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 mb-2">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <input type="text" class="form-control" name="jenis_kelamin" value="<?= $item['jenis_kelamin'] ?>" id="jenis_kelamin" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="text" class="form-control" name="tanggal_lahir" value="<?= $item['tanggal_lahir'] ?>" id="tanggal_lahir" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="komplek">Komplek</label>
                                    <input type="text" class="form-control" name="komplek" value="<?= $item['nama_komplek'] ?>" id="komplek" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="blok">Blok</label>
                                    <input type="text" class="form-control" name="blok" value="<?= $item['nama_blok'] ?>" id="blok" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="nomor_telepon">No. Telepon</label>
                                    <input type="text" class="form-control" name="nomor_telepon" value="<?= $item['nomor_telepon'] ?>" id="nomor_telepon" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="nomor_whatsapp">No. Whatsapp</label>
                                    <input type="text" class="form-control" name="nomor_whatsapp" value="<?= $item['nomor_whatsapp'] ?>" id="nomor_whatsapp" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Periode Iuran</label>
                                <input type="text" class="form-control" value="<?= getMonthName($item['bulan']) . ' - ' . $item['tahun'] . ' | Rp ' . number_format($item['nominal']) ?>" readonly>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_metode_pembayaran">Metode Pembayaran</label>
                                <select name="id_metode_pembayaran" id="id_metode_pembayaran" class="form-control">
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <?php foreach ($data_metode_pembayaran as $key => $metode_pembayaran) : ?>
                                        <option <?php if ($metode_pembayaran['id_metode_pembayaran'] == $item['id_metode_pembayaran']) : ?> selected <?php endif; ?> value="<?= $metode_pembayaran['id_metode_pembayaran'] ?>"><?= $metode_pembayaran['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option <?php if ($item['status'] === 'Belum Bayar') : ?> selected <?php endif; ?> value="Belum Bayar">Belum Bayar</option>
                                    <option <?php if ($item['status'] === 'Sudah Bayar') : ?> selected <?php endif; ?> value="Sudah Bayar">Sudah Bayar</option>
                                    <option <?php if ($item['status'] === 'Gagal') : ?> selected <?php endif; ?> value="Gagal">Gagal</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button name="tambah" class="btn btn-block btn-primary"><i class="fas fa-save"></i>
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