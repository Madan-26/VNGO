<!DOCTYPE html>
<html>
<head>
    <title>Shelter List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
            background-color: #f2f2f2;
            background-image: linear-gradient(135deg, #efacf0 30%, #d7e785 100%);
            background-repeat: no-repeat;
            border: 3px solid black;

        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        select {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Shelter List</h1>
    <form action="" method="GET">
        <label for="location">Filter by Location:</label>
        <select name="location" id="location" onchange="this.form.submit()">
            <option value="">All Locations</option>
            <?php
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "hackngo";

            $conn = new mysqli($host, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

           
            $query = "SELECT DISTINCT location FROM shelter";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $location = $row["location"];
                    $selected = ($_GET["location"] === $location) ? "selected" : "";
                    echo "<option value=\"$location\" $selected>$location</option>";
                }
            }

           
            $conn->close();
            ?>
        </select>
    </form>
    <br>
    <table>
        <tr>
            <th>Location</th>
            <th>Phone</th>
            <th>Availability</th>
        </tr>
        <?php

        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "hackngo";

        
        $conn = new mysqli($host, $username, $password, $database);
    
        $locationFilter = $_GET["location"] ?? "";
        $query = "SELECT location, phone, availability FROM shelter";
        if ($locationFilter) {
            $query .= " WHERE location = '$locationFilter'";
        }
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $location = $row["location"];
                $phone = $row["phone"];
                $availability = $row["availability"];
                echo "<tr>";
                echo "<td>$location</td>";
                echo "<td>$phone</td>";
                echo "<td>$availability</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan=\"3\">No shelters found.</td></tr>";
        }

        
        $conn->close();
        ?>
    </table>
</body>
</html>
