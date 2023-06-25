<?php
require_once 'dompdf/autoload.inc.php';
require_once 'function/models/pembayaran.php';

use Dompdf\Dompdf;

$data_jenis_iuran = getJenisIuran();


?>
<section class="section">
    <div class="section-header">
        <h1>Rekap Laporan Pembayaran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item">Rekap Laporan Pembayaran</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= BASE_URL . '/pages/laporan/print.php' ?>" method="get">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="id_jenis_iuran">Jenis Iuran</label>
                                        <select name="id_jenis_iuran" id="id_jenis_iuran" class="form-control">
                                            <option value="">Pilih Jenis Iuran</option>
                                            <?php foreach ($data_jenis_iuran as $key => $jenis_iuran) : ?>
                                                <option value="<?= $jenis_iuran['id_jenis_iuran'] ?>"><?= $jenis_iuran['nama_jenis'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="id_periode_iuran">Periode Iuran</label>
                                        <select name="id_periode_iuran" id="id_periode_iuran" class="form-control">
                                            <option value="">Pilih Periode Iuran</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">Semua</option>
                                            <option value="Sudah Bayar">Sudah Bayar</option>
                                            <option value="Proses">Proses</option>
                                            <option value="Belum Bayar">Belum Bayar</option>
                                            <option value="Gagal">Gagal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 align-self-end">
                                    <div class="form-group">
                                        <button name="export" class="btn btn-danger py-2"><i class="fas fa-file-pdf"></i> Export</button>
                                    </div>
                                </div>
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
    })
</script>