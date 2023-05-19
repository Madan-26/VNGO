<!DOCTYPE html>
<html lang="en">

<head>
  <title>Filtered NGO Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    body{
      background-image: linear-gradient(135deg, #efacf0 30%, #d7e785 100%);
      background-repeat: no-repeat;
      border: 3px solid black;
    }
    .logo {
        width: 50px;
        height: 50px;
        flex: 0 0 auto;
        overflow: visible;
        height: 50px;
        width: 70px;
        padding-right: 33%;
      }
      
      .logo img {
        height: 50px;
        width: 100px;
        /* border: 1PX SOLID black; */
      }
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      padding: 10;
      margin: 2%;
      border: solid black;
      background-color: rgb(148, 237, 237);
      background-image: linear-gradient(135deg, #FAB2FF 10%, #1904E5 100%);

    }
    .donate-button,
    .login-button,
    .signup-button {
      margin-left: 10px;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      flex: 15%;
    }

    .donate-button:hover,
    .login-button:hover,
    .signup-button:hover {
      background-color: #555;
    }
  </style>
</head>

<body>
<header>
        <div class="logo">
            <img src="images/LogoGreenNOBG.png" alt="Volunteer matching logo">
        </div>
        <button class="login-button" onclick="location.href='http://localhost/FC58/searchvol.php'"> Volunteers</button>
        <!-- <button class="login-button" onclick="location.href='http://localhost/FC58/searchOppo.php'">Find Opportunity</button> -->
        <button class="donate-button" onclick="location.href='https://rzp.io/l/AxJl9Hbi'">Donate</button>
        <button  class="donate-button" onclick="location.href='addshelter.html'">Shelter</button>
        <button  class="donate-button" onclick="location.href='home.html'">Home</button>
        <button  class="donate-button" onclick="location.href='alert.html'">Alert</button>
        <button  class="donate-button" onclick="location.href='contactus.html'">Contact Us</button>
    <button class="login-button" onclick="location.href='login.html'">Logout</button>
    <!-- <button class="signup-button" onclick="location.href='signup.html' ">Sign Up</button> -->
    </header>

  <div class="container">
    <h2>Filtered NGO Details</h2>
    <p>Type something in the input field to search the table for NGO names, locations, or wanted fields:</p>
    <form action="" method="GET" class="form-inline">
      <div class="form-group">
        <input class="form-control" id="searchInput" type="text" name="search" placeholder="Location/field..">
      </div>
      <div class="form-group">
        <input class="form-control" id="filterInput" type="text" name="filter" placeholder="Field..">
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
