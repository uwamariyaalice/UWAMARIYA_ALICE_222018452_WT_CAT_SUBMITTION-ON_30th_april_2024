<?php
include('database_connection.php');

// Check if CustomerID is set
if(isset($_REQUEST['CustomerID'])) {
    $cid = $_REQUEST['CustomerID'];
    
    $fms = $connection->prepare("SELECT * FROM customer WHERE CustomerID=?");
    $fms->bind_param("i", $cid);
    $fms->execute();
    $result = $fms->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['CustomerID'];
        $y = $row['Name'];
        $z = $row['Email'];
        $E = $row['Address'];

    } else {
        echo "Customer not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update coffeevarieties</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script> 

</head>
<body bgcolor="pink"><center>
    <h2><u>Update Form of customer</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="name">Name:</label>
        <input type="text" name="Name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Email">Email:</label>
        <input type="text" name="Email" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <label for="Address">Address:</label>
        <input type="text" name="Address" value="<?php echo isset($E) ? $E : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $name = $_POST['Name'];
    $em = $_POST['Email'];
    $adrs = $_POST['Address'];
    
    // Update the customer in the database
    $fms = $connection->prepare("UPDATE customer SET Name=?, Email=?, Address=? WHERE CustomerID=?");
    $fms->bind_param("sssi", $name, $em, $adrs, $cid);
    $fms->execute();
    
    // Redirect to customer.php
    header('Location: customer.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
