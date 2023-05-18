<!DOCTYPE html>
<html lang="en">

<head>
  <title>Filtered NGO Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>

  <div class="container">
    <h2>VOLUNTEERS Details</h2>
    <p>Type something in the input field to search the table :</p>
    <form action="" method="GET" class="form-inline">
      <div class="form-group">
        <input class="form-control" id="searchInput" type="text" name="search" placeholder="Search..">
      </div>
      <div class="form-group">
        <input class="form-control" id="filterInput" type="text" name="filter" placeholder="Filter..">
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <br>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>First nname</th>
          <th>Last name</th>
          <th>Location</th>
          <th>Field</th>
          <th>Skills</th>
          <th>Gender</th>
          <th>Phone</th>
          <th>email</th>
        </tr>
      </thead>
      <tbody>
        <?php
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hackngo";

        $conn = new mysqli($servername, $username, $password, $dbname);

        
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $filterTerm = isset($_GET['filter']) ? $_GET['filter'] : '';

        
        $sql = "SELECT * FROM volunteerdetails WHERE 
                (firstname LIKE '%$searchTerm%' OR lastname LIKE '%$searchTerm%' OR  field LIKE '%$searchTerm%' OR location LIKE '%$searchTerm%')
                AND (firstname LIKE '%$filterTerm%' OR Lastname LIKE '%$filterTerm%' OR field LIKE '%$filterTerm%' OR skill LIKE '%$searchTerm%' OR NULL)";
        $result = $conn->query($sql);

        $output = ""; 

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $output .= "<tr>";
            $output .= "<td>" . $row["firstname"] . "</td>";
            $output .= "<td>" . $row["lastname"] . "</td>";
            $output .= "<td>" . $row["location"] . "</td>";
            $output .= "<td>" . $row["field"] . "</td>";
            $output .= "<td>" . $row["skill"] . "</td>";
            $output .= "<td>" . $row["gender"] . "</td>";
            $output .= "<td>" . $row["phone"] . "</td>";
            $output .= "<td>" . $row["email"] . "</td>";
            $output .= "</tr>";
          }
        } else {
          $output = "<tr><td colspan='6'>No results found.</td></tr>";
        }

     
        $conn->close();

        echo $output;
        ?>
      </tbody>
    </table>
  </div>

</body>

</html>
