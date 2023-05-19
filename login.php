<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $username = $_POST['email'];
    $password = $_POST['password'];
    
  
    $servername = 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $dbname = 'hackngo';
    
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    
   
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
   
    $stmt = $conn->prepare('SELECT password FROM signup WHERE email = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    
    
    if ($hashedPassword && $hashedPassword === $password) {
        
        header('Location: home.html');
        exit;
    } else {
       
        echo 'Incorrect email or password.';
    }
    
   
    $stmt->close();
    $conn->close();
}
?>
