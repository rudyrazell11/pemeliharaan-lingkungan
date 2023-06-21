<?php

require_once 'function/models/user.php';


if (isset($_POST['tambah'])) {
    $tambah = tambahData($_POST);
    if ($tambah) {
        header('Location: ' . BASE_URL . '/main.php?page=user&status=success');
    } else {
        $error = '
        <div class="alert alert-danger">
          Email atau password salah
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('admin.Metode Pembayaran.index') }}">DataJe nis Iuran</a></div>
            <div class="breadcrumb-item">Tambah User</div>
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
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" value="" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="">Pilih Level</option>
                                    <option value="admin">Admin</option>
                                    <option value="warga">Warga</option>
                                </select>
                            </div>
                            <div class="d-warga">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" value="" id="tanggal_lahir" required>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="nomor_telepon" class="form-control" name="nomor_telepon" value="" id="nomor_telepon" required>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_whatsapp">Nomor Whatsapp</label>
                                    <input type="nomor_whatsapp" class="form-control" name="nomor_whatsapp" value="" id="nomor_whatsapp" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" value="" id="password" required>
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

<script>
    $(function() {
        console.log('ok');
    })
</script>