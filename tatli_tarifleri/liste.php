<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uyeler";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM urunler";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Ürün adı: " . $row["urun_adi"]. " urun bilgisi: " . $row["urun_bilgi"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>