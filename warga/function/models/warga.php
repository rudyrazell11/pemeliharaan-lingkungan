<?php

function getDetail($id_user)
{
    global $koneksi;
    $item = $koneksi->query("SELECT usr.*, wr.jenis_kelamin, wr.nomor_telepon, wr.nomor_whatsapp, wr.tanggal_lahir, wr.id_blok, wr.id_warga, blok.nama_blok, komplek.nama_komplek,wr.nama_warga FROM user usr INNER JOIN warga wr ON wr.id_user=usr.id_user INNER JOIN blok ON blok.id_blok=wr.id_blok INNER JOIN komplek ON komplek.id_komplek=blok.id_komplek WHERE usr.id_user=$id_user")->fetch_assoc();
    return $item;
}

function updateProfile($post)
{
    global $koneksi;

    // update user
    if ($post['password']) {

        $pw_hash = password_hash($post['password'], PASSWORD_BCRYPT);
        $user = $koneksi->query("UPDATE `user` SET `password` = '$pw_hash' WHERE `user`.`id_user` = $_SESSION[id_user]");
    } else {
        $passwordUpdate = NULL;
    }

    // update warga
    $jenis_kelamin = htmlspecialchars($post['jenis_kelamin']);
    $tanggal_lahir = htmlspecialchars($post['tanggal_lahir']);
    $nomor_telepon = htmlspecialchars($post['nomor_telepon']);
    $nomor_whatsapp = htmlspecialchars($post['nomor_whatsapp']);

    $koneksi->query("UPDATE `warga` SET `jenis_kelamin` = '$jenis_kelamin', `tanggal_lahir` = '$tanggal_lahir', `nomor_telepon` = '$nomor_telepon', `nomor_whatsapp` = '$nomor_whatsapp' WHERE `warga`.`id_user` = $_SESSION[id_user]");

    return true;
}

function getTagihan()
{
    global $koneksi;
    $warga = getDetail($_SESSION['id_user']);
    $items = $koneksi->query("SELECT pmb.id_warga, pmb.status, ji.*, pi.* FROM pembayaran pmb RIGHT JOIN periode_iuran pi ON pi.id_periode_iuran=pmb.id_periode_iuran INNER JOIN jenis_iuran ji ON ji.id_jenis_iuran=pi.id_jenis_iuran WHERE pmb.id_warga = $warga[id_warga]");
    $warga = getDetail($_SESSION['id_user']);
    // $items = $koneksi->query("SELECT pi.*, ji.*, pmb.status,pmb.id_warga FROM periode_iuran pi LEFT JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran LEFT JOIN pembayaran pmb ON pmb.id_periode_iuran = pi.id_periode_iuran WHERE pmb.status IS NULL ORDER BY pi.id_periode_iuran DESC");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getPeriodeIuran()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM periode_iuran pi INNER JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function cekPeriodeIuran($id_user, $id_periode_iuran)
{
    global $koneksi;

    $warga = getDetail($id_user);
    $item = $koneksi->query("SELECT * FROM pembayaran pmb INNER JOIN periode_iuran pi ON pi.id_periode_iuran=pmb.id_periode_iuran INNER JOIN jenis_iuran ji ON ji.id_jenis_iuran=pi.id_jenis_iuran WHERE pmb.id_warga = $warga[id_warga] AND pi.id_periode_iuran = $id_periode_iuran")->fetch_assoc();

    if ($item) {
        return $item;
    } else {
        return false;
    }
}

function getMetodePembayaran()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM metode_pembayaran");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function periodeIuranDetail($id_periode_iuran)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM periode_iuran WHERE id_periode_iuran=$id_periode_iuran")->fetch_assoc();
    return $item;
}

function bayarTagihan($post)
{
    global $koneksi;
    $id_pembayaran = $post['id_pembayaran'];
    $id_warga = htmlspecialchars($post['id_warga']);
    $id_periode_iuran = htmlspecialchars($post['id_periode_iuran']);
    $id_metode_pembayaran = htmlspecialchars($post['id_metode_pembayaran']);
    $status = 'Proses';

    // upload bukti
    $file = $_FILES['bukti_pembayaran'];

    // Informasi file
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Memisahkan ekstensi file
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Ekstensi file yang diizinkan
    $allowedExtensions = array('jpg', 'jpeg', 'png');

    // Cek apakah ekstensi file diizinkan
    if (in_array($fileExt, $allowedExtensions)) {
        // Cek apakah ada error saat upload
        if ($fileError === 0) {
            // Cek ukuran file
            if ($fileSize < 5000000) { // Contoh: 5MB (dalam byte)
                // Nama unik untuk file
                $newFileName = uniqid('', true) . '.' . $fileExt;
                $uploadPath = 'uploads/' . $newFileName; // Ganti "uploads/" dengan direktori penyimpanan yang diinginkan

                // var_dump($uploadPath);die();
                // Pindahkan file yang diupload ke direktori tujuan
                if (move_uploaded_file($fileTmpName, $uploadPath)) {

                } else {
                    echo "Gagal mengupload file.";

                }
            } else {
                echo "Ukuran file terlalu besar.";

            }
        } else {
            echo "Error saat upload file.";

        }
    } else {
        echo "Ekstensi file tidak diizinkan.";
    }

    $act = $koneksi->query("UPDATE `pembayaran` SET `id_metode_pembayaran` = '$id_metode_pembayaran', `status` = '$status',`bukti_pembayaran` = '$newFileName'  WHERE `pembayaran`.`id_pembayaran` = $id_pembayaran");

    if ($act) {
        $act = true;
    } else {
        $act = false;
    }

    return $act;
}

function getKodePembayaranBaru()
{
    return time();
}
