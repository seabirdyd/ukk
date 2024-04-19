<?php
include 'koneksi.php';
session_start();

$submit = @$_POST['submit'];
if ($submit == 'Login') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    // cek apakah username dan password yang di masukan ke dalam <input> ada di database
    $sql = mysqli_query($conn, "SELECT * FROM gallery_user WHERE Username='$username' AND Password='$password' AND Role='$role'");
    $cek = mysqli_num_rows($sql);
    if ($cek != 0) {
        // ambil data dari database untuk membuat session
        $sesi = mysqli_fetch_array($sql);
        echo '
            <script>
                alert("Login Berhasil!!!");
                window.location.href = "' . ($sesi['Role'] == 'Admin' ? 'admin/admin.php' : './') . '";
            </script>
        ';
        $_SESSION['username'] = $sesi['Username'];
        $_SESSION['user_id'] = $sesi['UserID'];
        $_SESSION['email'] = $sesi['Email'];
        $_SESSION['nama_lengkap'] = $sesi['NamaLengkap'];
        $_SESSION['role'] = $sesi['Role'];
    } else {
        echo '
            <script>
                alert("Login Gagal!!!");
                window.location.href = "login.php";
            </script>
        ';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri Foto</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="node_modules/sweetalert2/dist/sweetalert2.js"></script>

</head>
<style>
    body {
      background-image: url('https://images.pexels.com/photos/1072179/pexels-photo-1072179.jpeg?cs=srgb&dl=pexels-c%C3%A1tia-matos-1072179.jpg&fm=jpg&w=4042&h=2695&_gl=1*1qr0quj*_ga*MTYxOTI2ODc4LjE3MTIwMzA2NzA.*_ga_8JE65Q40S6*MTcxMjAzMDY2OS4xLjEuMTcxMjAzMDcyMC4wLjAuMA..');
      background-repeat: no-repeat;
      background-size: cover;
      color: white;
    }

    .login-container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .card {
      width: 30rem;
      background-color: rgba(255, 255, 255, 0.1);
      border: none;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(5px);
    }

    .card-body {
      padding: 2rem;
    }

    .card-title {
      font-size: 1.5rem;
      font-weight: bold;
      text-align: center;
      color : white;
    }

    .form-group {
      margin-bottom: 1.5rem;
      color : white;
    }

    input[type="text"],
    input[type="password"] {
      border: none;
      border-radius: 10px;
      background-color: rgba(255,255, 255, 0.1);
      color: white;
      padding: 0.75rem 1rem;
      width: 100%;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      outline: none;
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.2);
    }

    select.form-control {
      appearance: none;
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 10px;
      padding: 0.75rem 1rem;
      color: white;
      width: 100%;
    }

    select.form-control:focus {
      outline: none;
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.2);
    }

    select.form-control option {
      background-color: rgba(255, 255, 255, 0.1);
    }

    input[type="submit"] {
      border: none;
      border-radius: 10px;
      background-color: white;
      color: #1a1a1a;
      padding: 0.5rem 1rem;
      width: 100%;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    input[type="submit"]:hover {
      background-color: rgba(255, 255, 255, 0.9);
    }

    .form-group p {
      font-size: 0.875rem;
      text-align: center;
      margin-top: 1rem;
    }
</style>
<body class="bg bg-success">
  <div class="login-container">
    <div class="card">
      <div class="card-body">
      
        <p class="card-title">Login Akun</p>
        <?php if (!isset($sesi) || $sesi['Role'] != 'Admin') { ?>
          <form action="login.php" method="post">
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
              <label>Role</label>
              <select class="form-control" name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
              </select>
            </div>
            <input type="submit" value="Login" class="btn btn-success my-3" name="submit">
            <p>Belum Punya Akun? <a href="daftar.php" class="link-danger">Daftar Sekarang</a></p>
          </form>
        <?php } ?>
      </div>
    </div>
  </div>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="node_modules/sweetalert2/dist/sweetalert2.js"></script>
</body>
</html>