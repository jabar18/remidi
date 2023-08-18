<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $entryId = $_GET['id'];

    $sql = "SELECT * FROM guestbook WHERE Id = $entryId";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $entry = $result->fetch_assoc();
    } else {
        echo "Entry not found.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entryId = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $message = $_POST['message'];

    $sql = "UPDATE guestbook SET Name = '$name', Email = '$email', Address = '$address', City = '$city', Message = '$message' WHERE Id = $entryId";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_guestbook.php");
        exit();
    } else {
        echo "Error updating entry: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Guestbook Entry</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <div class="container">
        <h2>Edit Guestbook Entry</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $entry['Id']; ?>">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="<?php echo $entry['Name']; ?>" required><br><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $entry['Email']; ?>" required><br><br>
            
            <label for="address">Alamat:</label>
            <input type="text" id="address" name="address" value="<?php echo $entry['Address']; ?>" required><br><br>
            
            <label for="city">Kota:</label>
            <input type="text" id="city" name="city" value="<?php echo $entry['City']; ?>" required><br><br>
            
            <label for="message">Pesan:</label><br>
            <textarea name="message" rows="4" cols="50" required><?php echo $entry['Message']; ?></textarea><br><br>
            
            <input type="submit" value="Update">
        </form>
        
        <a href="view_guestbook.php">Kembali ke Lihat Guestbook</a>
    </div>
</body>
</html>
