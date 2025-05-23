<?php
include("baglanti.php");
$calistirekle = null;
if (isset($_POST["giris"])) {
    $name = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    

    // Hazırlıklı ifade kullanımı
    $stmt = $baglanti->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die('prepare() failed: ' . htmlspecialchars($baglanti->error));
    }

    $stmt->bind_param("sss", $name, $email, $password);
    $calistirekle = $stmt->execute();

    if ($calistirekle) {
        header("Location: Login.php");
        exit(); 
    } else {
        echo '<div class="alert alert-danger" role="alert">Bir problem oluştu.</div>';
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
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form method="POST" action="">
  <div class="form-group p-5">
    <label for="username">Kullanıcı Adı</label>
    <input type="text" name="username" class="form-control" id="username" placeholder="Kullanıcı Adı" required>
  </div>
  <div class="form-group p-5">
    <label for="email">E-mail</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="E-mail" required>
    <small id="emailHelp" class="form-text text-muted">E-mail adresiniz gizli kalacaktır.</small>
  </div>
  <div class="form-group p-5">
    <label for="password">Parola</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Parola" required>
  </div>
  
  <button type="submit" name="giris" class="btn btn-primary">Kaydol</button>
</form>
</body>
</html>
