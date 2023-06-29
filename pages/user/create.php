<?php

require_once 'function/models/user.php';
$data_komplek = getKomplek();

if (isset($_POST['tambah'])) {
    validasiTambah($_POST);
    $tambah = tambahData($_POST);
    if ($tambah) {
        redirectUrl(BASE_URL . '/main.php?page=user&status=success&message=User berhasil ditambahkan!');
    } else {
        $error = '
        <div class="alert alert-danger">
         User gagal ditambahkan.
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=dashboard' ?>">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="<?= BASE_URL . '/main.php?page=user' ?>">Data User</a></div>
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
                        <form action="" method="post" id="form">
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
                            <div class="d-warga d-none">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" >
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" value="" id="tanggal_lahir" >
                                </div>
                                <div class="form-group">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="nomor_telepon" class="form-control" name="nomor_telepon" value="" id="nomor_telepon" >
                                </div>
                                <div class="form-group">
                                    <label for="nomor_whatsapp">Nomor Whatsapp</label>
                                    <input type="nomor_whatsapp" class="form-control" name="nomor_whatsapp" value="" id="nomor_whatsapp" >
                                </div>
                                <div class="form-group">
                                    <label for="id_komplek">Komplek</label>
                                    <select name="id_komplek" id="id_komplek" class="form-control" >
                                        <option value="" selected>Pilih Komplek</option>
                                        <?php foreach ($data_komplek as $komplek) : ?>
                                            <option value="<?= $komplek['id_komplek'] ?>"><?= $komplek['nama_komplek'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_blok">Blok</label>
                                    <select name="id_blok" id="id_blok" class="form-control" >
                                        <option value="">Pilih Blok</option>
                                    </select>
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

        let getBlokByKomplek = function(id_komplek) {
            let data;
            $.ajax({
                url: '<?= BASE_URL . '/pages/blok/get-by-komplek.php' ?>',
                async: false,
                type: 'GET',
                data: {
                    id_komplek
                },
                dataType: 'JSON',
                success: function(response) {
                    data = response;
                },
                error: function(err) {
                    console.log(err);
                }
            })

            return data;
        }

        $('#form #level').on('change', function() {
            let level = $(this).val();
            if (level === 'admin') {
                $('.d-warga').addClass('d-none');
            } else {
                $('.d-warga').removeClass('d-none');
            }
        })


        // get blok by komplek
        $('#form #id_komplek').on('change', function() {
            let id_komplek = $(this).val();

            let data_blok = getBlokByKomplek(id_komplek);
            $('#form #id_blok').empty();
            $('#form #id_blok').append(`<option value="">Pilih Blok</option>`)
            data_blok.forEach(blok => {
                $('#form #id_blok').append(`
                    <option value="${blok.id_blok}">${blok.nama_blok}</option>
                `)
            })
        })
    })
</script>
