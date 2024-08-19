<?php
session_start();
require_once 'db.php';
require_once 'index.php';
?>
<div class="container" style="max-width: 600px; border: 1px solid #c8d6e5; padding: 20px; background-color: #f5f5f5; border-radius: 5px;">
    <?php
    if (isset($_POST['hitungtotal_bayar'])) {
        $durasi_menginap = $_POST['durasi_menginap'];
        $tipe_kamar = $_POST['tipe_kamar'];
        $termasuk_breakfast = isset($_POST['termasuk_breakfast']) ? $_POST['termasuk_breakfast'] : false;
        $tanggal_pesan = $_POST['tanggal_pesan'];

        $harga_standar = 500000;
        $harga_deluxe = 1000000;
        $harga_Family = 1500000;
        $harga_breakfast = 80000;

        switch ($tipe_kamar) {
            case 'Standar':
                $total_bayar = $harga_standar * $durasi_menginap;
                break;
            case 'Deluxe':
                $total_bayar = $harga_deluxe * $durasi_menginap;
                break;
            case 'Family':
                $total_bayar = $harga_Family * $durasi_menginap;
                break;
            default:
                $total_bayar = 0;
                break;
        }

        if ($termasuk_breakfast) {
            $total_bayar += $harga_breakfast;
        }

        if ($durasi_menginap > 3) {
            $diskon = 0.1;
            $total_bayar -= $total_bayar * $diskon;
        }

        if (strtotime($tanggal_pesan) < strtotime(date('Y-m-d'))) {
            echo "<div class='alert alert-danger'>Tanggal tidak valid.</div>";
        } else {
            $_SESSION['total_bayar'] = $total_bayar;
            $_POST['total_bayar'] = $total_bayar;
        }
    }

    if (isset($_POST['addnew'])) {
        if (
            empty($_POST['nama_pemesan']) ||
            empty($_POST['jenis_kelamin']) ||
            empty($_POST['nomor_identitas']) ||
            empty($_POST['tipe_kamar']) ||
            empty($_POST['tanggal_pesan']) ||
            empty($_POST['durasi_menginap']) ||
            empty($_POST['total_bayar'])
        ) {
            echo "<div class='alert alert-danger'>Masukkan semua input.</div>";
        } else {
            $nama_pemesan = $_POST['nama_pemesan'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $nomor_identitas = $_POST['nomor_identitas'];
            $tipe_kamar = $_POST['tipe_kamar'];
            $tanggal_pesan = $_POST['tanggal_pesan'];
            $durasi_menginap = $_POST['durasi_menginap'];
            $termasuk_breakfast = isset($_POST['termasuk_breakfast']) ? 1 : 0;
            $total_bayar = $_POST['total_bayar'];

            $sql = "INSERT INTO hotel (nama_pemesan, jenis_kelamin, nomor_identitas, tipe_kamar, tanggal_pesan, durasi_menginap, termasuk_breakfast, total_bayar) 
                    VALUES ('$nama_pemesan', '$jenis_kelamin', '$nomor_identitas', '$tipe_kamar', '$tanggal_pesan', '$durasi_menginap', '$termasuk_breakfast', '$total_bayar')";

            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    ?>

    <div class="box">
        <h3 style="background-color: #74b9ff; color: white; padding: 10px; text-align: center;">Form Pemesanan</h3>
        <form action="" method="POST" style="padding: 20px;">
            <div class="form-group">
                <label for="nama_pemesan">Nama Pemesan:</label>
                <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <div>
                    <label class="radio-inline"><input type="radio" name="jenis_kelamin" value="Laki-laki" required> Laki-laki</label>
                    <label class="radio-inline"><input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan</label>
                </div>
            </div>

            <div class="form-group">
                <label for="nomor_identitas">Nomor Identitas:</label>
                <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" pattern="\d{16}" title="Isian salah. Data harus 16 digit" required>
            </div>

            <div class="form-group">
                <label for="tipe_kamar">Tipe Kamar:</label>
                <select class="form-control" id="tipe_kamar" name="tipe_kamar" onchange="updateHarga()" required>
                    <option value="Standar">Standar</option>
                    <option value="Deluxe">Deluxe</option>
                    <option value="Family">Family</option>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="text" class="form-control" id="harga" value="" readonly> 
            </div>

            <div class="form-group">
                <label for="tanggal_pesan">Tanggal Pesan:</label>
                <input type="date" class="form-control" id="tanggal_pesan" name="tanggal_pesan" required>
            </div>

            <div class="form-group">
                <label for="durasi_menginap">Durasi Menginap (Hari):</label>
                <input type="number" min="1" class="form-control" id="durasi_menginap" name="durasi_menginap" required>
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="termasuk_breakfast" name="termasuk_breakfast">
                <label class="form-check-label" for="termasuk_breakfast">Termasuk Breakfast</label>
            </div>

            <div class="form-group mt-2">
                <label for="total_bayar">Total Bayar:</label>
                <input type="text" class="form-control" id="total_bayar" name="total_bayar" value="<?php echo isset($_SESSION['total_bayar']) ? number_format($_SESSION['total_bayar'], 3, ',', '.') : ''; ?>" readonly>
            </div>

            <div class="text-center mt-3 mb-4">
                <button type="submit" class="btn btn-primary" name="hitungtotal_bayar" style="width: 30%;">Hitung Total Bayar</button>
                <button type="submit" class="btn btn-success" name="addnew" value="Add New" style="width: 30%;">Simpan</button>
                <button type="reset" class="btn btn-secondary" style="width: 30%;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateHarga() {
    var tipe_kamar = document.getElementById("tipe_kamar").value;
    var harga = 0;

    if (tipe_kamar == "Standar") {
        harga = 500000;
    } else if (tipe_kamar == "Deluxe") {
        harga = 1000000;
    } else if (tipe_kamar == "Family") {
        harga = 1500000;
    }

    document.getElementById("harga").value = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(harga);
}
</script>
