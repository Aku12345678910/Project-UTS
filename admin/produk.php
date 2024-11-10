<?php
require "session.php";
require "../koneksi.php";

// Query to fetch products
$queryProduk = mysqli_query($con, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

// Query to fetch categories
$queryKategori = mysqli_query($con, "SELECT * FROM kategori");

// Function to generate a random string
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<style>
    .no-decoration {
        text-decoration: none;
    }
    .form div {
        margin-bottom: 10px;
    }
</style>
<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="admin" class="no-decoration text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>  
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama Produk</label>
                    <input type="text" id="nama" name="nama" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="kategori">Kategori Produk</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">Pilih satu</option>
                        <?php while($data = mysqli_fetch_array($queryKategori)) { ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga Produk</label>
                    <input type="number" name="harga" id="harga" class="form-control">
                </div>
                <div>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail Produk</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>
            <?php
            if (isset($_POST['simpan'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);

                if ($nama == '' || $kategori == '' || $harga == '') {
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Nama, kategori dan harga wajib diisi
                    </div>
            <?php
                } else {
                    if ($nama_file != '') {
                        if ($image_size > 2000000) {
            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                File tidak boleh lebih dari 2 MB
                            </div>
            <?php
                        } else {
                            $allowed_file_types = ['jpg', 'png', 'jpeg', 'gif'];
                            if (!in_array($imageFileType, $allowed_file_types)) {
            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File harus bertipe jpg, png, jpeg, atau gif!
                                </div>
            <?php
                            } else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $random_name . "." . $imageFileType);

                                $queryInsert = mysqli_query($con, "INSERT INTO produk (nama, kategori_id, harga, detail, foto, ketersediaan_stok) VALUES ('$nama', '$kategori', '$harga', '$detail', '$random_name.$imageFileType', '$ketersediaan_stok')");

                                if ($queryInsert) {
            ?>
                                    <div class="alert alert-success mt-3" role="alert">
                                        Produk berhasil disimpan
                                    </div>
                                    <meta http-equiv="refresh" content="1; url=produk.php">
            <?php
                                } else {
                                    echo mysqli_error($con);
                                }
                            }
                        }
                    }
                }
            }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Produk</h2>
            <div class="table-responsive mt-5">
                <table class='table'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Detail</th>
                            <th>Ketersediaan Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahProduk == 0) {
                        ?>
                            <tr>
                                <td colspan="7" class="text-center">Data produk tidak tersedia</td>
                            </tr>
                        <?php
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryProduk)) {
                        ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['kategori_id']; ?></td>
                                    <td><?php echo $data['harga']; ?></td>
                                    <td><?php echo $data['detail']; ?></td>
                                    <td><?php echo $data['ketersediaan_stok']; ?></td>
                                    <td>
                                        <a href="produk-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info">
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
