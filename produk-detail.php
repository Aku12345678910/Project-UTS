<?php
    require "koneksi.php";
    
    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk =mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
    $produk = mysqli_fetch_array($queryProduk);
    
    $queryProdukTerkait = mysqli_query($con,"SELECT *FROM produk WHERE kategori_id='$produk[kategori_id]'
    AND id!='$produk[id]' LIMIT 4");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk | Pengunjung Web</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<?php require "navbar.php";?>
<div class="container-fluid py-5">
    <div class="container">
        <div clas="row">
            <div class="col-mb-5">
                <img src="image/<?php echo $produk['foto']; ?>" alt="" class="produk-image">
            </div>
            <div class="col-md-6 offset-md-1">
                <h1><?php echo $produk['nama']; ?></h1>
                <p><?php echo $produk['detail']; ?></p>
                <p class="text-harga">Rp <?php echo $produk['harga']; ?></p>
                <p clas="fs-5">Status Ketersediaan:<strong><?php echo $produk['ketersediaan_stok']; ?></strong></p>
            </div>
        </div>
    </div>
</div>
    <div class="container-fluid py-5 warna2">
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Terkait</h2>
            <div class="row">
                <?php while($data=mysqli_fetch_array($queryProdukTerkait)) {?>
                <div class="col-md-6 col-lg-3 mb-3">
                <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                    <img src="image/<?php echo $data['foto']; ?>" class="img-fluid img-thumbnail
                    produk-terkait-image" alt="">
                </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 content-subscribe text-light">
        <div class="container">
            <h5 class="text-center mb-4">Temui Kami</h5>
            <div class="row justify-content-center">
                <div class="col-sm-1 d-flex justify-content-center mb-2">
                    <i class="fab fa-facebook fs-4"></i>
                </div>
                <div class="col-sm-1 d-flex justify-content-center mb-2">
                    <i class="fab fa-instagram fs-4"></i>
                </div>
                <div class="col-sm-1 d-flex justify-content-center mb-2">
                    <i class="fab fa-twitter fs-4"></i>
                </div>
                <div class="col-sm-1 d-flex justify-content-center mb-2">
                    <i class="fab fa-whatsapp fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-3 warna4 text-dark">
        <div class="container d-flex justify-content-center">
            <label>&copy;2024 Cakraningrat Store</label>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script> 
</body>
</html>