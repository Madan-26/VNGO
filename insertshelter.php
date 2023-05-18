<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $location = $_POST["location"];
    $phone = $_POST["phone"];
    $availability = $_POST["availability"];

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "hackngo";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "INSERT INTO shelter (location, phone, availability) VALUES (?, ?, ?)";
    $statement = $conn->prepare($query);
    $statement->bind_param("ssi", $location, $phone, $availability);

    if ($statement->execute()) {
        echo "Shelter added successfully!";
    } else {
        echo "Error adding shelter: " . $conn->error;
    }

    $statement->close();
    $conn->close();
}
?>
