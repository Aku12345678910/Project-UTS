<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        .banner {
            position: relative;
            text-align: center;
            color: white;
        }
        .banner .background-image {
            width: 100%;
            height: auto;
        }
        .banner .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .content-subscribe {
            background-color: #343a40;
        }
    </style>
</head>
<body>
<?php require "navbar.php";?>
    <div class="container-fluid banner">
        <img src="image/banner.png" alt="banner" class="background-image">
        <div class="container text-center content">
            <h1>ABOUT US</h1>
        </div>
    </div>
    <div class="container-fluid py-5 text-center">
        <div class="container fs-5">
            <p class="py-5">Cakraningrat Store merupakan badan usaha milik Pimpinan Cabang (PC) Ikatan Pelajar Nahdlatul Ulama 
                (IPNU) dan Ikatan Pelajar Putri Nahdlatul Ulama (IPPNU) Pamekasan. Badan usaha ini didirikan dengan 
                tujuan untuk mendukung dan meningkatkan kemandirian ekonomi organisasi melalui kegiatan kewirausahaan 
                yang inovatif dan berkelanjutan. Pengelolaan Cakraningrat Store berada di bawah tanggung jawab langsung 
                Lembaga Ekonomi dan Kewirausahaan (LEK) PC IPNU IPPNU Pamekasan, yang memastikan bahwa setiap aspek 
                operasional berjalan sesuai dengan visi dan misi organisasi.
            </p>
            <p>
            Selain berfungsi sebagai sumber pendapatan bagi organisasi, Cakraningrat Store juga berperan dalam mengembangkan 
            keterampilan kewirausahaan para anggotanya. Dengan bimbingan dan pengawasan ketat dari PC IPNU IPPNU Pamekasan, 
            toko ini menyediakan berbagai produk yang relevan dengan kebutuhan komunitas lokal, sembari mempromosikan nilai-nilai 
            kemandirian dan kreativitas di kalangan pelajar. Melalui usaha ini, diharapkan anggota IPNU dan IPPNU tidak hanya 
            mendapatkan pengalaman praktis dalam dunia bisnis, tetapi juga mampu berkontribusi positif terhadap pertumbuhan ekonomi daerah.
            </p>
    
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
