<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Reservasi</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        
        th {
            background-color: #dddddd;
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-container input[type="text"] {
            width: 25%;
            padding: 8px;
            border: 1px solid #dddddd;
            border-radius: 4px;
        }

        .search-container button {
            padding: 8px 16px;
            border: 1px solid #dddddd;
            background-color: #dddddd;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .search-container button:hover {
            background-color: #cccccc;
        }

        .back-button button {
            padding: 8px 16px;
            border: 1px solid #dddddd;
            background-color: #dddddd;
            border-radius: 4px;
            cursor: pointer;
        }

        .back-button button:hover {
            background-color: #cccccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data</h1>
        <div class="search-container">
            <form method="GET" action="" style="flex-grow: 1;">
                <input type="text" name="search" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit">Search</button>
            </form>
            <div class="back-button">
                <button onclick="window.location.href='../index.html'">Kembali</button>
            </div>
        </div>
        <div class="data-list">
            <?php 
            include 'db.php';

            // Retrieve the search keyword
            $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

            // Retrieve the list of tables
            $tablesResult = $conn->query("SHOW TABLES");
            if ($tablesResult->num_rows > 0) {
                while($tableRow = $tablesResult->fetch_array()) {
                    $tableName = $tableRow[0];
                    
                    echo "<h2>Data $tableName</h2>";
                    
                    // Retrieve data from the current table
                    $sql = "SELECT * FROM $tableName";
                    if (!empty($searchKeyword)) {
                        $sql .= " WHERE ";
                        $columnsResult = $conn->query("SHOW COLUMNS FROM $tableName");
                        $columns = [];
                        while ($columnRow = $columnsResult->fetch_assoc()) {
                            $columns[] = $columnRow['Field'];
                            $sql .= $columnRow['Field'] . " LIKE '%" . $conn->real_escape_string($searchKeyword) . "%' OR ";
                        }
                        $sql = rtrim($sql, " OR ");
                    }
                    
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr>";
                        
                        // Get table columns
                        $columnsResult = $conn->query("SHOW COLUMNS FROM $tableName");
                        $columns = [];
                        while ($columnRow = $columnsResult->fetch_assoc()) {
                            $columns[] = $columnRow['Field'];
                            echo "<th>" . $columnRow['Field'] . "</th>";
                        }
                        echo "<th>Actions</th>";
                        echo "</tr>";

                        // Display table rows
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            foreach ($columns as $column) {
                                echo "<td style='text-align: center;'>" . $row[$column] . "</td>"; // Menambahkan gaya CSS untuk menengahkan data
                            }
                            echo "<td><a href='update.php?table=$tableName&id=" . $row['id'] . "'>Edit</a> | <a href='delete.php?table=$tableName&id=" . $row['id'] . "'>Delete</a></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "Data tidak ditemukan pada tabel $tableName.";
                    }
                }
            } else {
                echo "Tabel tidak ditemukan di database";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
