<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Farm</title>
    <style>
        body {
            background-color: grey;
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        header {
            background-color: deeppink;
            padding: 20px;
        }
        section {
            padding: 71px;
            border-bottom: 1px solid #ddd;
            background-color: plum;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: deeppink;
        }
    </style>
        <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body>
<header>
    <ul style="list-style-type: none; padding: 0;">
        <li style="display: inline; margin-right: 10px;"><a href="./home.html" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">HOME</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./about.html" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">ABOUT</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./contact.html" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">CONTACT</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./customer.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">customer</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./employee.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">employee</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./orders.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">orders</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./product.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">product</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./supplier.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">supplier</a></li>
        <li class="dropdown" style="display: inline; margin-right: 10px;">
            <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
            <div class="dropdown-contents">
                <!-- Links inside the dropdown menu -->
                <a href="login.html">Login</a>
                <a href="register.html">Register</a>
                <a href="logout.php">Logout</a>
            </div>
        </li>
    </ul>

    <!-- <div class="col-3 offset">-->
    <form class="d-flex" role="search" action="search.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</header>

<section>
    <h1>Employee Form</h1>
   <form method="post" onsubmit ="return confirmInsert();">
        <label for="EmployeeID">EmployeeID:</label>
        <input type="number" id="EmployeeID" name="EmployeeID" required><br><br>
        <label for="Name">Name:</label>
        <input type="text" id="Name" name="Name" required><br><br>
        <label for="Position">Position:</label>
        <input type="text" id="Position" name="Position" required><br><br>
        <label for="Salary">Salary:</label>
        <input type="text" id="Salary" name="Salary" required><br><br>
        <label for="Gender">Gender:</label>
        <input type="text" id="Gender" name="Gender" required><br><br>

        <input type="submit" name="insert" value="Insert"><br><br>
        <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
    include('database_connection.php');

    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        // Insert section
        $ccf = $connection->prepare("INSERT INTO employee (EmployeeID, Name, Position, Salary, Gender) VALUES (?, ?, ?, ?, ?)");
        $ccf->bind_param("issss", $EmployeeID, $Name, $Position, $Salary, $Gender);
        // Set parameters from POST and execute
        $EmployeeID = $_POST['EmployeeID'];
        $Name = $_POST['Name'];
        $Position = $_POST['Position'];
        $Salary = $_POST['Salary'];
        $Gender = $_POST['Gender'];

        if ($ccf->execute()) {
            echo "New record has been added successfully.<br><br>
             <a href='employee.php'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $ccf->error;
        }

        $ccf->close();
    }
    ?>

    <center><h2>Table of employee</h2></center>
    <table>
        <tr>
            <th>EmployeeID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Salary</th>
            <th>Gender</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        include('database_connection.php');

        // SQL query to fetch data from the farm table
        $sql = "SELECT * FROM employee";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $EmployeeID = $row["EmployeeID"];
                echo "<tr>
                    <td>" . $row["EmployeeID"] . "</td>
                    <td>" . $row["Name"] . "</td>
                    <td>" . $row["Position"] . "</td> 
                    <td>" . $row["Salary"] . "</td>
                    <td>" . $row["Gender"] . "</td>
                    <td><a style='padding:4px' href='delete_employee.php?EmployeeID=$EmployeeID'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_employee.php?EmployeeID=$EmployeeID'>Update</a></td> 
                  </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close connection
        $connection->close();
        ?>
    </table>
</section>

<footer>
    <center>
        <b><h2><i>UR CBE BIT  prepared by:Alice<i></h2></b>
    </center>
</footer>
</body>
</html>
