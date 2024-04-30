<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>orders Form</title>
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
            background-color:deeppink;
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
    <h1>orders Form</h1>
    <form method="post" onsubmit ="return confirmInsert();">
        <label for="OrderID">OrderID:</label>
        <input type="number" id="OrderID" name="OrderID" required><br><br>
        <label for="CustomerID">CustomerID:</label>
        <input type="number" id="CustomerID" name="CustomerID" required><br><br>
        <label for="OrderDate">OrderDate:</label>
        <input type="text" id="OrderDate" name="OrderDate" required><br><br>
        <label for="TotalAmount">TotalAmount:</label>
        <input type="text" id="TotalAmount" name="TotalAmount" required><br><br>
    
        <input type="submit" name="insert" value="Insert"><br><br>
    </form>
    <a href="./home.html">Go Back to Home</a>

    <!-- PHP Code to Insert Data -->
    <?php
    include('database_connection.php');

    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        // Insert section
        $fms = $connection->prepare("INSERT INTO orders (OrderID, CustomerID, OrderDate, TotalAmount) VALUES (?, ?, ?, ?)");
        $fms->bind_param("iiss", $OrderID, $CustomerID, $OrderDate, $TotalAmount);

        // Set parameters from POST and execute
        $OrderID = $_POST['OrderID'];
        $CustomerID = $_POST['CustomerID'];
        $OrderDate = $_POST['OrderDate'];
        $TotalAmount = $_POST['TotalAmount'];
        
        if ($fms->execute()) {
            echo "New record has been added successfully.<br><br>";
        } else {
            echo "Error inserting data: " . $fms->error;
        }

        $fms->close();
    }
    ?>

    <!-- Displaying Table of Orders -->
    <center><h2>table of orderss</h2></center>
    <table>
        <tr>
            <th>OrderID</th>
            <th>CustomerID</th>
            <th>OrderDate</th>
            <th>TotalAmount</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        include('database_connection.php');
        // SQL query to fetch data from the orders table
        $sql = "SELECT * FROM orders";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orderID = $row["OrderID"]; // Added this line to fetch Order ID
                echo "<tr>
                    <td>" . $row["OrderID"] . "</td>
                    <td>" . $row["CustomerID"] . "</td>
                    <td>" . $row["OrderDate"] . "</td>
                    <td>" . $row["TotalAmount"] . "</td>
                    <td><a href='delete_orders.php?OrderID=$orderID'>Delete</a></td>
                    <td><a href='update_orders.php?OrderID=$orderID'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close connection
        $connection->close();
        ?>
    </table>
</section>

<footer>
    <center>
        <b><h2><i>UR CBE BIT prepared by: Alice</i></h2></b>
    </center>
</footer>
</body>
</html>
