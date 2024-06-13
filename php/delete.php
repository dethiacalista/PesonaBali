<?php
include 'db.php';

$id = $_GET['id'];
$tableName = $_GET['table']; // Menambahkan pengambilan nama tabel dari parameter URL

$sql = "DELETE FROM $tableName WHERE id='$id'"; // Menggunakan nama tabel yang diperoleh dari parameter

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header('Location: read.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
