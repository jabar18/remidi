<?php
include('koneksi.php');

$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    session_start();
    $_SESSION['username'] = $username;
    header("Location: dashboard.php"); 
} else {
    echo "Login gagal. Cek kembali username dan password Anda.";
}

$conn->close();
?>
