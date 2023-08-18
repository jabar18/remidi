<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

include('koneksi.php'); 

$sql = "SELECT * FROM guestbook";
$result = $conn->query($sql);

$guestbookData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $guestbookData[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lihat Guestbook</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
        <h2>Lihat Guestbook</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Posted</th>
                    <th>Message</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($guestbookData as $entry): ?>
                    <tr>
                        <td><?php echo $entry['Name']; ?></td>
                        <td><?php echo $entry['Email']; ?></td>
                        <td><?php echo $entry['Address']; ?></td>
                        <td><?php echo $entry['City']; ?></td>
                        <td><?php echo $entry['Posted']; ?></td>
                        <td><?php echo $entry['Message']; ?></td>
                        <td><a href="edit.php?id=<?php echo $entry['Id']; ?>">Edit</a></td>
                        <td><a href="delete.php?id=<?php echo $entry['Id']; ?>" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashboard.php">Kembali ke Dashboard</a>
    </div>
</body>
</html>
