<?php

require_once 'warga/function/models/pembayaran.php';
$id_pembayaran = $_GET['id_pembayaran'];
$item = getById($id_pembayaran);

?>

<section class="section">
    <div class="section-header">
        <h1>Detail Tagihan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item">Detail Tagihan</div>
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

                        <form action="javascript:void(0)" method="post">
                        <div class="form-group">
                                <label for="">Detail Warga</label>
                            </div>
                            <div class="form-group">
                                <label for="id_warga">Nama</label>
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
                            <hr>
                            <div class="form-group">
                                <label for="">Periode Iuran</label>
                            </div>
                            <div class="form-group row">
                            <div class="col-md-6 mb-2">
                                    <label for="nama_jenis">Jenis</label>
                                    <input type="text" class="form-control" name="nama_jenis" value="<?= $item['nama_jenis'] ?>" id="nama_jenis" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="bulan">Bulan</label>
                                    <input type="text" class="form-control" name="bulan" value="<?= getMonthName($item['bulan']) ?>" id="bulan" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="tahun">Tahun</label>
                                    <input type="text" class="form-control" name="tahun" value="<?= $item['tahun'] ?>" id="tahun" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="nominal">Nominal</label>
                                    <input type="text" class="form-control" name="nominal" value="Rp. <?= $item['nominal'] ?>" id="nominal" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Metode Pembayaran</label>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 mb-2">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?= $item['nama'] ?>" id="nama" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="nomor">Nomor</label>
                                    <input type="text" class="form-control" name="nomor" value="<?= $item['nomor'] ?>" id="nomor" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="pemilik">Pemilik</label>
                                    <input type="text" class="form-control" name="pemilik" value="<?= $item['pemilik'] ?>" id="pemilik" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" value="<?= $item['status'] ?>" readonly>
                                </select>
                            </div>
                            <div class="form-group">
                                <a href="<?= BASE_URL . '/warga.php?page=tagihan' ?>" class="btn btn-block btn-warning"><i class="fas fa-arrow-left"></i>
                                    Kembali</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>