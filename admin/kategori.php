<?php
    require "session.php";
    require "../koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<style>
    .no-decoration {
        text-decoration: none;
    }
    .form-control:focus {
        border-color: #836C2D; 
        box-shadow: 0 0 5px gold; 
    }
    body {
        background-color: #eeece3;
        color: #333;
    }
    .breadcrumb {
        background-color: transparent;
    }
    .breadcrumb-item a {
        color: silver;
    }
    .breadcrumb-item.active {
        color: #836C2D;
    }
    h3, h2 {
        color: #836C2D;
    }
    .btn-info {
        background-color: #836C2D;
        border: none;
        color: black;
    }
    .btn-info:hover {
        background-color: #d4af37;
        color: white;
    }
    .table thead th {
        background-color: #836C2D;
        color: black;
    }
    .table tbody tr:nth-child(even) {
        background-color: silver;
    }
    .table tbody tr:nth-child(odd) {
        background-color: white;
    }
    .alert-warning {
        background-color: #f7c948;
        color: black;
    }
    .alert-primary {
        background-color: gold;
        color: black;
    }
    .btn-submit {
        background-color:#629E34;
        border: none;
        border-radius: 3px;
        color: white;
        height: 40px;
        width: 70px;
        border-color: #836C2D; 
        box-shadow: 0 0 5px gold;
    }
</style>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="admin" class="no-decoration text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"> 
                    Kategori
                </li>  
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>

            <form action="" method="post">
                <div>
                    <label for="kategori"></label>
                    <input type="text" id="kategori" name="kategori" placeholder="input nama kategori" class="form-control">
                </div>
                <div class="mt-3">
                    <button type="submit" name="simpan_kategori" class="btn-submit">Simpan</button>
                </div>
            </form>
            <?php
                if (isset($_POST['simpan_kategori'])) {
                    $kategori = htmlspecialchars($_POST['kategori']);

                    $queryExit = mysqli_query($con, "SELECT nama FROM kategori WHERE nama='$kategori'");
                    $jumlahDataKategoriBaru = mysqli_num_rows($queryExit);

                    if ($jumlahDataKategoriBaru > 0) {
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori sudah ada!
                        </div>
                        <?php
                    } else {
                        $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES('$kategori')");
                        if ($querySimpan) {
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Kategori berhasil disimpan
                            </div>
                            <meta http-equiv="refresh" content="2; url=kategori.php"/>
                            <?php
                        } else {
                            echo mysqli_connect_error($con);
                        }
                    }
                }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-5">
                <table class='table'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahKategori == 0) {
                            ?>
                            <tr>
                                <td colspan=3 class="text-center">Data kategori tidak tersedia</td>
                            </tr>
                    <?php
                        } 
                        else {
                            $jumlah = 1;
                            while($data = mysqli_fetch_array($queryKategori)) {
                    ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td>
                                        <a href="kategori-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $jumlah++;
                            }
                        }
                        ?>   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
