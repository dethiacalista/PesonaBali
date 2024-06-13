<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO subscribe (name, email) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $email);

if ($stmt->execute()) {
    echo "<script>alert('Anda berhasil berlangganan!');</script>"; // Menampilkan pesan pop-up jika eksekusi berhasil
} else {
    echo "<script>alert('Error: " . $stmt->error . "');</script>"; // Menampilkan pesan pop-up jika terjadi kesalahan
}

$stmt->close();
$conn->close();
?>
