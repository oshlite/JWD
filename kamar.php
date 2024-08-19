<?php
require_once 'index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Lihatport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hotel Rooms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .room-card {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Hotel</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card room-card">
                    <img src="./image/std.jpg" alt="Standard Room">
                    <div class="card-body">
                        <h5 class="card-title">Standard Room</h5>
                        <p class="card-text">Penginapan sederhana dengan fasilitas standar.</p>
                        <a href="insert.php" class="btn btn-primary">Pesan Sekarang</a>
                        <a href="https://youtu.be/uQdlGZFjegw?feature=shared" class="btn btn-info">Lihat Video</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card room-card">
                    <img src="./image/dlx.jpg" class="card-img-top" alt="Deluxe Room">
                    <div class="card-body">
                        <h5 class="card-title">Deluxe Room</h5>
                        <p class="card-text">Fasilitas premium untuk pengalaman lebih baik..</p>
                        <a href="insert.php" class="btn btn-primary">Pesan Sekarang</a>
                        <a href="https://youtu.be/tugJ39H8hfA?feature=shared" class="btn btn-info">Lihat Video</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card room-card">
                    <img src="./image/exc.jpg" class="card-img-top" alt="Family Room">
                    <div class="card-body">
                        <h5 class="card-title">Family Room</h5>
                        <p class="card-text">Ideal untuk perjalanan keluarga dengan ruang ekstra.</p>
                        <a href="insert.php" class="btn btn-primary">Pesan Sekarang</a>
                        <a href="https://youtu.be/1LCXcXR9UFM?feature=shared" class="btn btn-info">Lihat Video</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>