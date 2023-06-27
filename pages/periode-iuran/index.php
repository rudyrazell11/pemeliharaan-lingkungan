<?php

require_once 'function/models/periode_iuran.php';
require_once 'function/helper.php';

$items = get();
if (isset($_POST['delete'])) {
    $delete = deleteData($_POST['id_periode_iuran']);
   redirectUrl(BASE_URL . '/main.php?page=periode-iuran&status=success&message=Periode Iuran berhasil dihapus!');
}


if(isset($_POST['submit_tagihan']))
{
    $id_periode_iuran = $_POST['id_periode_iuran_schedule'];
    
    $createSchedule = createPembayaranByAllUserByPeriodeIuran($id_periode_iuran);
    if($createSchedule)
    {
        redirectUrl(BASE_URL . '/main.php?page=periode-iuran&status=success&message=Schedule pembayaran periode berhasil dibuat!');
    }
}

?>
<section class="section">
    <div class="section-header">
        <h1>Data Periode Iuran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item">Data Periode Iuran</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= BASE_URL . '/main.php?page=periode-iuran-create' ?>" class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Jenis Iuran</th>
                                        <th>Nominal</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Schedule</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $item['nama_jenis'] ?></td>
                                            <td>Rp <?= number_format($item['nominal']) ?></td>
                                            <td><?= getMonthName($item['bulan']) ?></td>
                                            <td><?= $item['tahun'] ?></td>
                                            <td>
                                               <?php if($item['is_schedule'] == 0) : ?>
                                                <form action="" method="post">
                                                    <input type="text" hidden name="id_periode_iuran_schedule" value="<?= $item['id_periode_iuran'] ?>">
                                                    <button name="submit_tagihan" class="btn btn-secondary">Submit Schedule</button>
                                                </form>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-success">Sudah</button>
                                               <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= BASE_URL . '/main.php?page=periode-iuran-edit&id_periode_iuran=' . $item['id_periode_iuran'] ?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="text" name="id_periode_iuran" value="<?= $item['id_periode_iuran'] ?>" hidden>
                                                    <button name="delete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                                </form>

                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>