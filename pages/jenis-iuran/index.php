<?php

require_once 'function/models/jenis_iuran.php';

$items = get();

if (isset($_POST['delete'])) {
    $delete = deleteData($_POST['id_jenis_iuran']);
    header('Location: ' . BASE_URL . '/main.php?page=jenis-iuran&status=success');
}

?>
<section class="section">
    <div class="section-header">
        <h1>Data Jenis Iuran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item">Data Jenis Iuran</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= BASE_URL . '/main.php?page=jenis-iuran-create' ?>" class="btn btn-sm btn-primary mb-3 btnAdd"><i class="fas fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Jenis</th>
                                        <th>Nominal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $item['nama_jenis'] ?></td>
                                            <td><?= $item['nominal'] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL . '/main.php?page=jenis-iuran-edit&id_jenis_iuran=' . $item['id_jenis_iuran'] ?>" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="text" name="id_jenis_iuran" value="<?= $item['id_jenis_iuran'] ?>" hidden>
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