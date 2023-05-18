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
    <h2>Filtered NGO Details</h2>
    <p>Type something in the input field to search the table for NGO names, locations, or wanted fields:</p>
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
          <th>NGO Name</th>
          <th>Location</th>
          <th>Wanted Field</th>
          <th>Wanted Skills</th>
          <th>Phone Number</th>
          <th>Email</th>
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

        
        $sql = "SELECT * FROM ngodetails WHERE 
                (NGOname LIKE '%$searchTerm%' OR Location LIKE '%$searchTerm%' OR wantedfield LIKE '%$searchTerm%' OR wantedskills LIKE '%$searchTerm%')
                AND (NGOname LIKE '%$filterTerm%' OR Location LIKE '%$filterTerm%' OR wantedfield LIKE '%$filterTerm%' OR wantedskills LIKE '%$searchTerm%' OR NULL)";
        $result = $conn->query($sql);

        $output = ""; 
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $output .= "<tr>";
            $output .= "<td>" . $row["NGOname"] . "</td>";
            $output .= "<td>" . $row["Location"] . "</td>";
            $output .= "<td>" . $row["wantedfield"] . "</td>";
            $output .= "<td>" . $row["wantedskills"] . "</td>";
            $output .= "<td>" . $row["phonenumber"] . "</td>";
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
