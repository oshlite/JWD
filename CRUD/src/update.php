<?php
require 'connect.php';

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    
    return $randomString;
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $npm = $_POST['npm'];
    $name = $_POST['name'];
    $JenisKelamin = $_POST['JenisKelamin'];
    $tanggallahir = $_POST['tanggallahir'];
    $alamat = $_POST['alamat'];
    $foto = $_POST['foto'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . generateRandomString() . basename($_FILES["foto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check === false) {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "File tidak diupload.";
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                echo "File " . htmlspecialchars(basename($_FILES["foto"]["name"])) . " telah diupload. ";
                $foto = $target_file;
                echo "Terjadi kesalahan saat mengupload.";
            }
        }
    }

    $sql = "UPDATE `mahasiswa` SET npm='$npm', name='$name', JenisKelamin='$JenisKelamin', tanggallahir='$tanggallahir', alamat='$alamat', foto='$foto' WHERE id=$id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Data berhasil diupdate!";
    } else {
        echo "Gagal update data: " . mysqli_error($con);
    }
}

if (isset($_GET['userId'])) {
    $id = $_GET['userId'];
    $sql = "SELECT * FROM `mahasiswa` WHERE id=$id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRUD:Update</title>
    <link rel="stylesheet" href="./output.css" />
    <link rel="stylesheet" href="./style.css"/>
</head>
<body>
    <h2>Update Data Mahasiswa</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="npm">NPM:</label>
        <input type="text" id="npm" name="npm" value="<?php echo $row['npm']; ?>" required>
        
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
        
        <label for="JenisKelamin">Jenis Kelamin:</label>
        <input type="text" id="JenisKelamin" name="JenisKelamin" value="<?php echo $row['JenisKelamin']; ?>" required>
        
        <label for="tanggallahir">Tanggal Lahir:</label>
        <input type="date" id="tanggallahir" name="tanggallahir" value="<?php echo $row['tanggallahir']; ?>" required>
        
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required>
        
        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto">
        <input type="hidden" name="foto" value="<?php echo $row['foto']; ?>">
        
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>