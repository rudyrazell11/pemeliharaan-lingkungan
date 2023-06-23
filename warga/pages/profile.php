<?php
require_once 'warga/function/models/warga.php';
require_once 'function/helper.php';

$item = getDetail($_SESSION['id_user']);

if (isset($_POST['update'])) {
    // cek kedua password apakah sama
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if ($password !== $konfirmasi_password) {
        $error = '
        <div class="alert alert-danger">
        Password dan Konfirmasi Password tidak sesuai!
        </div>
      ';
    } else {
        $update = updateProfile($_POST);
        if ($update) {
            redirectUrl(BASE_URL . '/warga.php?page=profile');
        } else {
            $error = '
            <div class="alert alert-danger">
            Profile gagal diupdate!
            </div>
          ';
        }
    }
}
?>

<section class="section">
    <div class="section-header">
        <h1>Profile</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php if (isset($error)) : ?>
                        <?= $error ?>
                    <?php endif; ?>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?= $item['nama'] ?>" id="nama" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" value="<?= $item['email'] ?>" id="email" disabled>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option <?php if ($item['jenis_kelamin'] === 'Laki-laki') : ?> selected <?php endif; ?> value="Laki-laki">Laki-laki</option>
                                <option <?php if ($item['jenis_kelamin'] === 'Perempuan') : ?> selected <?php endif; ?> value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" value="<?= $item['tanggal_lahir'] ?>" id="tanggal_lahir">
                        </div>
                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input type="nomor_telepon" class="form-control" name="nomor_telepon" value="<?= $item['nomor_telepon'] ?>" id="nomor_telepon">
                        </div>
                        <div class="form-group">
                            <label for="nomor_whatsapp">Nomor Whatsapp</label>
                            <input type="nomor_whatsapp" class="form-control" name="nomor_whatsapp" value="<?= $item['nomor_whatsapp'] ?>" id="nomor_whatsapp">
                        </div>
                        <div class="form-group">
                            <label for="nama_komplek">Nama Komplek</label>
                            <input type="nama_komplek" class="form-control" name="nama_komplek" value="<?= $item['nama_komplek'] ?>" id="nama_komplek" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nama_blok">Nama Blok</label>
                            <input type="nama_blok" class="form-control" name="nama_blok" value="<?= $item['nama_blok'] ?>" id="nama_blok" disabled>
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span class="small text-danger">(Abaikan jika tidak ingin merubah password)</span></label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password">Konfirmasi Password <span class="small text-danger">(Abaikan jika tidak ingin merubah password)</span></label>
                            <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password">
                        </div>
                        <div class="form-group float-right">
                            <button name="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>