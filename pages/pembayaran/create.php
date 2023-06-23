<?php

require_once 'function/models/pembayaran.php';
require_once 'function/helper.php';

$data_warga = getWarga();
$data_jenis_iuran = getJenisIuran();
$data_metode_pembayaran = getMetodePembayaran();
if (isset($_POST['tambah'])) {
    $tambah = tambahData($_POST);
    if ($tambah) {
        redirectUrl(BASE_URL . '/main.php?page=pembayaran&status=success');
    } else {
        $error = '
        <div class="alert alert-danger">
        pembayaran gagal ditambahkan!
        </div>
      ';
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah Pembayaran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="">Data Pembayaran</a></div>
            <div class="breadcrumb-item">Tambah Pembayaran</div>
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
                                <label for="id_warga">Warga</label>
                                <select name="id_warga" id="id_warga" class="form-control">
                                    <option value="">Pilih Warga</option>
                                    <?php foreach ($data_warga as $key => $warga) : ?>
                                        <option value="<?= $warga['id_warga'] ?>"><?= $warga['nama_warga'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 mb-2">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <input type="text" class="form-control" name="jenis_kelamin" value="" id="jenis_kelamin" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="text" class="form-control" name="tanggal_lahir" value="" id="tanggal_lahir" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="komplek">Komplek</label>
                                    <input type="text" class="form-control" name="komplek" value="" id="komplek" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="blok">Blok</label>
                                    <input type="text" class="form-control" name="blok" value="" id="blok" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="nomor_telepon">No. Telepon</label>
                                    <input type="text" class="form-control" name="nomor_telepon" value="" id="nomor_telepon" disabled>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="nomor_whatsapp">No. Whatsapp</label>
                                    <input type="text" class="form-control" name="nomor_whatsapp" value="" id="nomor_whatsapp" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_jenis_iuran">Jenis Iuran</label>
                                <select name="id_jenis_iuran" id="id_jenis_iuran" class="form-control">
                                    <option value="">Pilih Jenis Iuran</option>
                                    <?php foreach ($data_jenis_iuran as $key => $jenis_iuran) : ?>
                                        <option value="<?= $jenis_iuran['id_jenis_iuran'] ?>"><?= $jenis_iuran['nama_jenis'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_periode_iuran">Periode Iuran</label>
                                <select name="id_periode_iuran" id="id_periode_iuran" class="form-control">
                                    <option value="">Pilih Periode Iuran</option>

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
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Bayar">Belum Bayar</option>
                                    <option value="Sudah Bayar">Sudah Bayar</option>
                                    <option value="Gagal">Gagal</option>
                                </select>
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

        let getPeriodeIuran = function(id_jenis_iuran) {
            let data;
            $.ajax({
                url: '<?= BASE_URL . '/pages/pembayaran/get_periode_iuran_by_jenis.php' ?>',
                async: false,
                type: 'GET',
                data: {
                    id_jenis_iuran
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

        let getDetailWarga = function(id_warga) {
            let data;
            $.ajax({
                url: '<?= BASE_URL . '/pages/user/detail_warga.php' ?>',
                async: false,
                type: 'GET',
                data: {
                    id_warga
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

        function getMonthName(monthNumber) {
            switch (monthNumber) {
                case 1:
                    return 'Januari';
                case 2:
                    return 'Februari';
                case 3:
                    return 'Maret';
                case 4:
                    return 'April';
                case 5:
                    return 'Mei';
                case 6:
                    return 'Juni';
                case 7:
                    return 'Juli';
                case 8:
                    return 'Augustus';
                case 9:
                    return 'September';
                case 10:
                    return 'Oktober';
                case 11:
                    return 'November';
                case 12:
                    return 'Desember';
                default:
                    return 'Invalid month number';
            }
        }


        // get periode_iuran by jenis iuran
        $('#id_jenis_iuran').on('change', function() {
            let id_jenis_iuran = $(this).val();

            let data_periode = getPeriodeIuran(id_jenis_iuran);
            $('#id_periode_iuran').empty();
            $('#id_periode_iuran').append(`<option value="">Pilih Periode</option>`)
            data_periode.forEach(periode => {
                let bulan = getMonthName(parseInt(periode.bulan));
                $('#id_periode_iuran').append(`
                    <option value="${periode.id_periode_iuran}">${bulan} - ${periode.tahun} | Rp ${periode.nominal}</option>
                `)
            })
        })

        // get warga by jenis iuran
        $('#id_warga').on('change', function() {
            let id_warga = $(this).val();

            let warga = getDetailWarga(id_warga);
            $('#jenis_kelamin').val(warga.jenis_kelamin);
            $('#tanggal_lahir').val(warga.tanggal_lahir);
            $('#komplek').val(warga.nama_komplek);
            $('#blok').val(warga.nama_blok);
            $('#nomor_telepon').val(warga.nomor_telepon);
            $('#nomor_whatsapp').val(warga.nomor_whatsapp);
           
        })
    })
</script>