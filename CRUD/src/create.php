<?php
  require 'connect.php';

  if (isset($_POST['submit'])) {
    $npm = $_POST['npm'];
    $name = $_POST['name'];
    $JenisKelamin = $_POST['JenisKelamin'];
    $tanggallahir = $_POST['tanggallahir'];
    $alamat = $_POST['alamat'];
    //$foto = $_POST['foto'];
    $foto = 'test.jpg';

    $sql = "INSERT INTO `mahasiswa` (npm,name,JenisKelamin,tanggallahir,alamat,foto) VALUES('$npm','$name', '$JenisKelamin', '$tanggallahir', '$alamat','$foto')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // echo 'Data inserted successfully';
        header('location:index.php');
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRUD</title>
    <link rel="stylesheet" href="./output.css" />
  </head>
  <body class="flex min-h-screen items-center justify-center bg-gray-100">
    <form
      method="post"
      enctype="multipart/form-data"
      class="w-full max-w-md rounded bg-white p-8 shadow-md"
    >
      <h2 class="mb-6 text-center text-2xl font-bold">Form Data</h2>

      <div class="mb-4">
        <label for="npm" class="mb-2 block font-medium text-gray-700"
          >NPM</label
        >
        <input
          type="text"
          id="npm"
          name="npm"
          minlength="10"
          maxlength="10"
          pattern="\d{10}"
          required
          class="w-full rounded border border-gray-300 px-3 py-2"
        />
      </div>

      <div class="mb-4">
        <label for="name" class="mb-2 block font-medium text-gray-700"
          >Nama</label
        >
        <input
          type="text"
          id="name"
          name="name"
          minlength="5"
          maxlength="128"
          pattern="[A-Za-z]+"
          required
          class="w-full rounded border border-gray-300 px-3 py-2"
        />
      </div>

      <div class="mb-4">
        <label class="mb-2 block font-medium text-gray-700"
          >Jenis Kelamin</label
        >
        <div class="mb-2 flex items-center">
          <input
            type="radio"
            id="JenisKelaminPria"
            name="JenisKelamin"
            value="1"
            class="mr-2"
            required
          />
          <label for="JenisKelaminPria" class="text-gray-700">Pria</label>
        </div>
        <div class="flex items-center">
          <input
            type="radio"
            id="JenisKelaminWanita"
            name="JenisKelamin"
            value="0"
            class="mr-2"
            required
          />
          <label for="JenisKelaminWanita" class="text-gray-700">Wanita</label>
        </div>
      </div>

      <div class="mb-4">
        <label for="tanggallahir" class="mb-2 block font-medium text-gray-700"
          >Tanggal Lahir</label
        >
        <input
          type="date"
          id="tanggallahir"
          name="tanggallahir"
          required
          max="<?php echo date('Y-m-d'); ?>"
          class="w-full rounded border border-gray-300 px-3 py-2"
        />
      </div>

      <div class="mb-4">
        <label for="alamat" class="mb-2 block font-medium text-gray-700"
          >Alamat</label
        >
        <textarea 
          rows="4"
          cols="50"
          id="alamat"
          name="alamat"
          required
          class="w-full rounded border border-gray-300 px-3 py-2"
        ></textarea>
      </div>

      <div class="mb-4">
        <label for="foto" class="mb-2 block font-medium text-gray-700"
          >Foto</label
        >
        <input
          type="file"
          id="foto"
          name="foto"
          required
          accept="image/*"
          class="w-full rounded border border-gray-300 px-3 py-2"
        />
      </div>

      <button
        type="submit"
        name="submit"
        class="w-full rounded bg-blue-500 py-2 text-white hover:bg-blue-600"
      >
        Kirim
      </button>
    </form>
  </body>
</html>