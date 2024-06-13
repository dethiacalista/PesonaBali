<?php
include 'db.php';

$sql = "SELECT id, name, description FROM data_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='data-item'>";
        echo "<h2>" . $row["name"] . "</h2>";
        echo "<p>" . $row["description"] . "</p>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
