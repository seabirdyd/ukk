<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
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
    .text-center {
      font-size: 1.1rem;
      font-weight: bold;
      color : white;
    }

    .form-group {
      margin-bottom: 1.5rem;
      color : white;
    }
    input[type="email"],
    input[type="text"],
    input[type="password"] {
      border: none;
      border-radius: 10px;
      background-color: rgba(255,255, 255, 0.1);
      color: white;
      padding: 0.75rem 1rem;
      width: 100%;
    }
    input[type="email"]:focus,
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
</head>
<body>
    <?php
    include 'koneksi.php';

    // Check if the form was submitted
    if (isset($_POST['submit']) && $_POST['submit'] == 'Daftar') {
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Consider using password_hash in real applications
        $email = $_POST['email'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $alamat = $_POST['alamat'];

        // Prepare a select statement to check if the username or email already exists
        $stmt = $conn->prepare("SELECT * FROM gallery_user WHERE Username = ? OR Email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            // Username and email do not exist, proceed with insert
            $insertStmt = $conn->prepare("INSERT INTO gallery_user (Username, Password, Email, NamaLengkap, Alamat) VALUES (?, ?, ?, ?, ?)");
            $insertStmt->bind_param("sssss", $username, $password, $email, $nama_lengkap, $alamat);

            if ($insertStmt->execute()) {
                echo '
              <script>
                  alert("Daftar Berhasil, Silahkan Login!!");
                  window.location.href = "login.php";
              </script>
          ';
            } else {
                echo '
              <script>
                  alert("Terjadi kesalahan saat mendaftar.");
              </script>
          ';
            }
        } else {
            echo '
          <script>
              alert("Maaf, akun dengan Username atau Email tersebut sudah ada.");
              window.location.href = "daftar.php";
          </script>
      ';
        }
    }
    ?>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                    
                        <p class="card-subtitle text-center mb-5">Daftar Akun</p>
                    </div>
                    <div class="card-body">
                        <form action="daftar.php" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                              <input type="text" class="form-control" name="nama_lengkap" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" required>
                            </div>
                            <input type="submit" value="Daftar" class="btn btn-success my-3" name="submit">
                        </form>
                        <div class="text-center">
                            <p>Sudah Punya Akun? <a href="login.php" class="link-danger">Login Sekarang</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>