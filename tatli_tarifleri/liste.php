<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet_recipes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM desserts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Ürün adı: " . $row["product_name"]. " urun bilgisi: " . $row["product_info"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>