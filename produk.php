<?php
    require "koneksi.php";
    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    if(isset($_GET['keyword'])){
        $queryProduk =mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
    }
    else if(isset($_GET['kategori'])) {
        $queryGetKategoriId =mysqli_query($con, "SELECT id * FROM kategori WHERE nama='$_GET[keyword]'");
        $kategoriId = mysqli_fetch_array($queryGetKategoriId);
        $queryProduk =mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
    }
    else{
        $queryProduk =mysqli_query($con, "SELECT * FROM produk");
    }
    $countData = mysqli_num_rows($queryProduk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cakraningrat Store | Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php require "navbar.php";?>
    <div class="container-fluid banner-produk">
        <img src="image/produk.png" alt="bannerproduk" class="background-image">
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <ul class="list-group">
                    <?php while($kategori = mysqli_fetch_array($queryKategori)){?>
                    <a class="gold-link" href="produk.php?kategori=<?php echo $kategori['nama'];?>">
                        <li class="list-group-item active"><?php echo $kategori['nama'];?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <?php 
                        if($countData<1){
                    ?>
                        <h4 class="text-center">Produk yang dicari tidak tersedia</h4> 
                    <?php      
                        } 
                    ?>
                <?php while($produk = mysqli_fetch_array($queryProduk)) { ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="image/<?php echo $produk['foto']; ?>" class="card-img-top" alt="Gambar produk">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $produk['nama']; ?></h4>
                                <p class="card-text text-truncate"><?php echo $produk['detail']; ?></p>
                                <p class="card-text text-harga">Rp <?php echo $produk['harga']; ?></p>
                                <a href="produk-detail.php?nama=<?php echo $produk['nama']; ?>" 
                                class="btn warna2 text-white">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
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