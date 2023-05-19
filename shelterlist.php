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
        <button class="login-button" onclick="location.href='http://localhost/FC58/searchvol.php'">Volunteers</button>
        <button class="login-button" onclick="location.href='http://localhost/FC58/searchOppo.php'">Opportunity</button>
        <button class="donate-button" onclick="location.href='https://rzp.io/l/AxJl9Hbi'">Donate</button>
        <!-- <button  class="donate-button" onclick="location.href='addshelter.html'">Shelter</button> -->
        <button  class="donate-button" onclick="location.href='home.html'">Home</button>
        <button  class="donate-button" onclick="location.href='alert.html'">Alert</button>
        <button  class="donate-button" onclick="location.href='contactus.html'">Contact Us</button>
    <button class="login-button" onclick="location.href='login.html'">Logout</button>
    <!-- <button class="signup-button" onclick="location.href='signup.html' ">Sign Up</button> -->
    </header>
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
