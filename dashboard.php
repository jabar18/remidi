<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
$currentDate = date("l,d-m-Y");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
    <header>
    <h2>Selamat datang di Dashboard, <?php echo $username; ?></h2>
    <p>Hari ini: <?php echo $currentDate; ?></p>
    <nav>
    <ul>
        <li><a href="input_guestbook.php">Input Guestbook</a></li>
        <li><a href="view_guestbook.php">Lihat Guestbook</a></li>
       <li> <a href="logout.php">Logout</a></li>
    </ul>
</nav>
</header>
    
</body>
</html>
