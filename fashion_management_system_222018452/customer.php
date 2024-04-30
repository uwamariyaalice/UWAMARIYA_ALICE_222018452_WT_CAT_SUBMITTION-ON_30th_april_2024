<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>customer</title>
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
    <form class="d-flex" role="search" action="search.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</header>
<section>
    <h1>Customer Form</h1>
    <form method="post" onsubmit ="return confirmInsert();">
    <label for="CustomerID">CustomerID :</label>
        <input type="number" id="CustomerID" name="CustomerID" required><br><br>
        <label for="Name">Name:</label>
        <input type="text" id="Name" name="Name" required><br><br>
        <label for="Email">Email:</label>
        <input type="text" id="Email" name="Email" required><br><br>
        <label for="Address">Address:</label>
        <input type="text" id="Address" name="Address" required><br><br>
        <label for="gender">Gender:</label>
        <select name="gender" id="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>
        <input type="submit" name="insert" value="Insert"><br><br>
    </form>
    <a href="./home.html">Go Back to Home</a>
    <!-- PHP Code to Insert Data -->
    <?php
    // Include the database connection file
    include('database_connection.php');

    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        // Prepare the insert statement
        $stmt = $connection->prepare("INSERT INTO customer (CustomerID, Name, Email,Address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $cid, $cname, $cem ,$caddress);
        // Set parameters from POST and execute
        $cid = $_POST['CustomerID'];
        $cname = $_POST['Name'];
        $cem = $_POST['Email'];
        $caddress = $_POST['Address'];

        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
        $stmt->close();
    }

    // Fetch data from the customer table
    $sql = "SELECT * FROM customer";
    $result = $connection->query($sql);
    ?>
    <!-- Displaying Table of customer -->
    <center><h2>Table of Customer</h2></center>
    <table>
        <tr>
            <th>CustomerID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>

            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        include('database_connection.php');
        // Check if there are any results
        if ($result->num_rows > 0) { 
            // Loop through each row
            while ($row = $result->fetch_assoc()) {
                // Store the CustomerID in a variable
                $cid = $row["CustomerID"];
                // Output the data in table row format
                echo "<tr>
                    <td>" . $row["CustomerID"] . "</td>
                    <td>" . $row["Name"] . "</td>
                    <td>" . $row["Email"] . "</td>
                    <td>" . $row["Address"] . "</td> 
                    <td><a href='delete_customer.php?CustomerID=$cid'>Delete</a></td> 
                    <td><a href='update_customer.php?CustomerID=$cid'>Update</a></td> 
                </tr>";
            }
        } else {
            // If no data found, display a message
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</section>
<footer>
    <center> 
        <b><h2><i>UR CBE BIT  prepared by:Alice</i></h2></b>
    </center>
</footer>
</body>
</html>
