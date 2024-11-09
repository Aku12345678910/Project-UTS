<?php
session_start();
require "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        .main {
            height: 100vh;
            background-color: #474C46; /* Mengatur latar belakang agar kontras dengan label putih */
        }
        .login-box {
            width: 500px;
            height: 400px;
            border: solid 5px #836C2D;
            box-sizing: border-box;
            border-radius: 10px;
        }
        .custom-button {
            background-color: #836C2D; 
            color: white; 
        }
        .label-active {
            color: gold; /* Warna gold saat label aktif */
        }
        .form-control:focus {
            border-color: gold; /* Ubah warna border menjadi gold saat fokus */
            box-shadow: 0 0 5px gold; /* Tambahkan efek cahaya gold */
        }
        label {
            color: white; /* Ubah warna label menjadi putih */
        }
    </style>
</head>
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
            <form action="" method="post">
                <div>
                    <label for="username" id="username-label"><b>Username</b></label>
                    <input type="text" class="form-control" name="username" id="username" onfocus="setLabelActive('username-label')" onblur="setLabelInactive('username-label')">
                </div>
                <div>
                    <label for="password" id="password-label"><b>Password</b></label>
                    <input type="password" class="form-control" name="password" id="password" onfocus="setLabelActive('password-label')" onblur="setLabelInactive('password-label')">
                </div>
                <div>
                    <button class="btn custom-button form-control mt-3" type="submit" name="loginbtn"><b>Login</b></button>
                </div>
            </form>
            <script>
                function setLabelActive(labelId) {
                    document.getElementById(labelId).classList.add('label-active');
                }
                function setLabelInactive(labelId) {
                    document.getElementById(labelId).classList.remove('label-active');
                }
            </script>
        </div>
        <div class="mt-3" style="width: 500px;">
            <?php
            if (isset($_POST['loginbtn'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                $query = mysqli_query($con, "SELECT * FROM user WHERE username='$username'");
                $countdata = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);
                if ($countdata > 0) {
                    if (password_verify($password, $data['password'])) {
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['login'] = true;
                        header('location:../admin');
                    } else {
                        ?>
                        <div class="alert alert-warning" role="alert">
                            Password salah
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Akun tidak tersedia
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
