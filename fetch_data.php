
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hackngo";

$conn = new mysqli('localhost','root','','hackngo');


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  echo "Connected successfully to the database!<br><br>";
}


$sql = "SELECT * FROM ngodetails";
$result = $conn->query($sql);

if ($result) {
   if ($result->num_rows > 0) {
     echo "<table class='table table-bordered table-striped'>";
     echo "<thead><tr><th>ngo id</th><th>NGO Name</th><th>Location</th><th>Wanted Field</th><th>Wanted Skills</th><th>Phone Number</th><th>Email</th></tr></thead>";
     echo "<tbody>";


    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["ngoid"] . "</td>" ;
      echo "<td>" . $row["NGOname"] . "</td>";
      echo "<td>" . $row["Location"] . "</td>";
      echo "<td>" . $row["wantedfield"] . "</td>";
      echo "<td>" . $row["wantedskills"] . "</td>";
      echo "<td>" . $row["phonenumber"] . "</td>";
      echo "<td>" . $row["email"] . "</td>";
      echo "</tr>";
    }

    echo "</tbody></table>";
  } else {
    echo "No results found.";
  }
} else {
  echo "Error fetching data: " . $conn->error;
}


$conn->close();
?>
