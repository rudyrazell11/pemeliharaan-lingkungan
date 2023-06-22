<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT user.*, warga.jenis_kelamin, warga.nomor_telepon, warga.nomor_whatsapp,blok.nama_blok, komplek.nama_komplek FROM user LEFT JOIN warga ON warga.id_user = user.id_user LEFT JOIN blok ON blok.id_blok=warga.id_blok LEFT JOIN komplek ON komplek.id_komplek=blok.id_komplek");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function tambahData($post)
{
    global $koneksi;
    // cek apakah admin atau warga
    $nama = htmlspecialchars($post['nama']);
    $email = htmlspecialchars($post['email']);
    $level = htmlspecialchars($post['level']);
    $password = password_hash($post['password'], PASSWORD_BCRYPT);
    if ($post['level'] === 'admin') {
        // jika admin
        // langsung create admin
        $insert = $koneksi->query("INSERT INTO `user` (`id_user`, `nama`, `email`,`password`) VALUES (NULL, '$nama','$email','$password')");
    } else {
        // jika warga
        $nama = htmlspecialchars($post['nama']);
        $jenis_kelamin = htmlspecialchars($post['jenis_kelamin']);
        $tanggal_lahir = htmlspecialchars($post['tanggal_lahir']);
        $nomor_telepon = htmlspecialchars($post['nomor_telepon']);
        $nomor_whatsapp = htmlspecialchars($post['nomor_whatsapp']);
        $id_blok = htmlspecialchars($post['id_blok']);

        $koneksi->begin_transaction();
        try {
            // Query pertama untuk membuat pengguna (user)
            $result1 = $koneksi->query("INSERT INTO `user` (`id_user`, `nama`, `email`,`password`,`level`) VALUES (NULL, '$nama','$email','$password','$level')");


            if (!$result1) {
                throw new Exception("Query 1 gagal: " . $koneksi->error);
            }
            $insertId2 = $koneksi->insert_id;

            // Query kedua untuk membuat warga
            $insert = $koneksi->query("INSERT INTO `warga` (`id_warga`, `nama_warga`, `jenis_kelamin`, `tanggal_lahir`, `nomor_telepon`, `nomor_whatsapp`, `id_blok`, `id_user`) VALUES (NULL, '$nama', '$jenis_kelamin', '$tanggal_lahir', '$nomor_telepon', '$nomor_whatsapp', $id_blok, $insertId2);");

            if (!$insert) {
                throw new Exception("Query 2 gagal: " . $koneksi->error);
            }

            // Commit transaksi jika kedua query berhasil
            $koneksi->commit();
        } catch (Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            var_dump($e->getMessage());
            die();
            $koneksi->rollback();
        }
    }


    if ($insert) {
        $insertId =  true;
    } else {
        $insertId = false;
    }

    return $insertId;
}

function getById($id_user)
{
    global $koneksi;
    $item = $koneksi->query("SELECT usr.*, wr.jenis_kelamin, wr.nomor_telepon, wr.nomor_whatsapp, wr.tanggal_lahir, wr.id_blok FROM user usr LEFT JOIN warga wr ON wr.id_user=usr.id_user WHERE usr.id_user=$id_user")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
  
    // cek apakah admin atau warga
    $nama = htmlspecialchars($post['nama']);
    $email = htmlspecialchars($post['email']);
    $level = htmlspecialchars($post['level']);

    // update user
    if ($post['password']) {
        $pw_hash = password_hash($post['password'],PASSWORD_BCRYPT);
        $passwordUpdate = ",`password` = " . "'". $pw_hash . "'";
    } else {
        $passwordUpdate = NULL;
    }
    $koneksi->query("UPDATE `user` SET `nama` = '$nama', `email` = '$email' $passwordUpdate WHERE `user`.`id_user` = $post[id_user]");

    if ($post['level'] === 'admin') {
    } else {
        // jika warga
        $nama = htmlspecialchars($post['nama']);
        $jenis_kelamin = htmlspecialchars($post['jenis_kelamin']);
        $tanggal_lahir = htmlspecialchars($post['tanggal_lahir']);
        $nomor_telepon = htmlspecialchars($post['nomor_telepon']);
        $nomor_whatsapp = htmlspecialchars($post['nomor_whatsapp']);
        $id_blok = htmlspecialchars($post['id_blok']);

        $koneksi->query("UPDATE `warga` SET `nama_warga` = '$nama', `jenis_kelamin` = '$jenis_kelamin', `tanggal_lahir` = '$tanggal_lahir', `nomor_telepon` = '$nomor_telepon', `nomor_whatsapp` = '$nomor_whatsapp', `id_blok` = $id_blok WHERE `warga`.`id_user` = $post[id_user]");
    }

    return true;
}

function deleteData($id_user)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM user WHERE id_user=$id_user");
}

function getKomplek()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM komplek");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getBlokDetail($id_blok)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM blok  WHERE id_blok=$id_blok")->fetch_assoc();
    return $item;
}
