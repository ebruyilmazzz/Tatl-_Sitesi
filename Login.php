<?php
include("baglanti.php");
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$check_table = $baglanti->query("DESCRIBE users");
echo "<!-- Tablo yapısı: -->";
while($row = $check_table->fetch_assoc()) {
    echo "<!-- " . $row['Field'] . " - " . $row['Type'] . " -->";
}

if (isset($_POST["giris"])) {
    $name = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $debug_query = "SELECT * FROM users WHERE username = '$name'";
    $debug_result = $baglanti->query($debug_query);
    if($debug_result) {
        $debug_user = $debug_result->fetch_assoc();
        echo "<!-- Debug: Kullanıcı bilgileri: " . print_r($debug_user, true) . " -->";
    }

    if ($baglanti->connect_error) {
        die('Veritabanı bağlantısı başarısız: ' . $baglanti->connect_error);
    }
    $stmt = $baglanti->prepare("SELECT id, password, is_admin FROM users WHERE username = ?");
    if ($stmt === false) {
        die('prepare() failed: ' . htmlspecialchars($baglanti->error));
    }

    $stmt->bind_param("s", $name);
    if (!$stmt->execute()) {
        die('execute() failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password, $is_admin);
        $stmt->fetch();

        echo "<!-- Debug: Girilen parola: " . $password . " -->";
        echo "<!-- Debug: Hash'lenmiş parola: " . $hashed_password . " -->";
        echo "<!-- Debug: is_admin değeri: " . $is_admin . " -->";
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $name;
            
            if ($is_admin == 1) {
                $_SESSION['admin'] = true;
                header("Location: admin.php");
            } else {
                $_SESSION['admin'] = false;
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Kullanıcı adı veya şifre hatalı.";
        }
    } else {
        $error = "Kullanıcı bulunamadı.";
    }

    $stmt->close();
    $baglanti->close();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap - Lezzetli Tatlılar</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Giriş Yap</h2>
        <?php if(isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label>Kullanıcı Adı:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Şifre:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" name="giris" class="btn">Giriş Yap</button>
            <a href="Register.php" class="btn">Kayıt Ol</a>
        </form>
    </div>
</body>
</html>
