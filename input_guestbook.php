<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $message = $_POST['message'];
    $posted = date("Y-m-d");
    
    include('koneksi.php');

    $sql = "INSERT INTO guestbook (Posted, Name, Email, Address, City, Message)
            VALUES ('$posted', '$name', '$email', '$address', '$city', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Data guestbook berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Guestbook</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <h2>Input Guestbook</h2>
    <form method="post" action="">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="address">Alamat:</label>
        <input type="text" id="address" name="address" required><br><br>
        
        <label for="city">Kota:</label>
        <input type="text" id="city" name="city" required><br><br>
        
        <label for="message">Pesan:</label><br>
        <textarea name="message" rows="4" cols="50" required></textarea><br><br>
        
        <input type="submit" value="Submit">
    </form>
    
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
