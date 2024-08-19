<?php
require_once 'db.php';
require_once 'index.php';
echo "<div class='container'>";

$sql = "SELECT * FROM hotel";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 class='mt-4'>List Pemesanan Hotel</h2>";
    while ($row = $result->fetch_assoc()) {
        $Diskon = ($row['durasi_menginap'] > 3) ? "10%"  : "0%";
        $formatted_total = number_format($row['total_bayar'], 0, ',', '.');
        $breakfast_included = $row['termasuk_breakfast'] ? "Ya"  : "Tidak";

        echo "<div style='border : 1px solid #c8d6e5; padding : 15px; margin-bottom : 20px; border-radius : 5px; background-color : #f5f5f5;'>";
        echo "<p>Nama Pemesan : " . $row['nama_pemesan'] . "</p>";
        echo "<p>Nomor Identitas : " . $row['nomor_identitas'] . "</p>";
        echo "<p>Jenis Kelamin : " . $row['jenis_kelamin'] . "</p>";
        echo "<p>Tipe Kamar : " . $row['tipe_kamar'] . "</p>";
        echo "<p>Tanggal Pesan : " . $row['tanggal_pesan'] . "</p>";
        echo "<p>Durasi Menginap : " . $row['durasi_menginap'] . " Hari</p>";
        echo "<p>Termasuk Breakfast : " . $breakfast_included . "</p>";
        echo "<p>Diskon : " . "10%" . "</p>";
        echo "<p>Total Bayar : Rp " . $formatted_total . "</p>";
        echo "</div>";
    }
} else {
    echo "<br><br> Tidak ditemukan pemesanan hotel.";
}
?>
