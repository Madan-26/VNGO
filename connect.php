
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $job = $_POST["job"];

    
    $conn = new mysqli('localhost', 'root', '', 'hackngo');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        
        $stmt = $conn->prepare("INSERT INTO signup (firstname, lastname, email, phone, password, job) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $firstName, $lastName, $email, $phone, $password, $job);
        $execval = $stmt->execute();

        if ($execval === false) {
            echo "Registration failed: " . $stmt->error;
        } else {
            echo "Registration successful!";
        }

       
        $stmt->close();
        $conn->close();
    }
}
?>

