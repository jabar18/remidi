<?php
include('koneksi.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql_check_username = "SELECT * FROM users WHERE username='$username'";
$result_check_username = $conn->query($sql_check_username);

if ($result_check_username->num_rows > 0) {
    echo "Username sudah digunakan. Silakan pilih username lain.";
} else {
    $sql_insert_user = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    
    if ($conn->query($sql_insert_user) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Pendaftaran gagal: " . $conn->error;
    }
}
$conn->close();
?>
