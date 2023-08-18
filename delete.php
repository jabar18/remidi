<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $entryId = $_GET['id'];

    $sql = "DELETE FROM guestbook WHERE Id = $entryId";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_guestbook.php");
        exit();
    } else {
        echo "Error deleting entry: " . $conn->error;
    }
}
?>
