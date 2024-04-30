<?php
 include('database_connection.php');
// Check if OrderID is set
if(isset($_REQUEST['OrderID'])) {
    $oid = $_REQUEST['OrderID'];
    
    $fms = $connection->prepare("SELECT * FROM orders WHERE OrderID=?");
    $fms->bind_param("i", $oid);
    $fms->execute();
    $result = $fms->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['OrderID'];
        $y = $row['CustomerID'];
        $z = $row['OrderDate'];
        $w = $row['TotalAmount'];

    } else {
        echo "orders not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update orders</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script> 


<body bgcolor="pink"><center>
    <h2><u>Update Form of orders</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="OrderID" value="<?php echo isset($x) ? $x : ''; ?>">
        
        <label for="CustomerID">CustomerID:</label>
        <input type="number" name="CustomerID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="OrderDate">OrderDate:</label>
        <input type="Date" name="OrderDate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="TotalAmount">TotalAmount:</label>
        <input type="number" name="TotalAmount" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $CustomerID = $_POST['CustomerID'];
    $OrderDate = $_POST['OrderDate'];
    $TotalAmount = $_POST['TotalAmount'];
    
    // Update the orders in the database
    $fms = $connection->prepare("UPDATE orders SET CustomerID=?, OrderDate=?, TotalAmount=? WHERE OrderID=?");
    $fms->bind_param("sssi", $CustomerID, $OrderDate, $TotalAmount, $oid);
    $fms->execute();
    
    // Redirect to farmer.php
    header('Location: orders.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
