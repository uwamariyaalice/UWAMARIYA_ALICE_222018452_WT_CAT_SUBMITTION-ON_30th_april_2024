<?php 
include('database_connection.php');

// Check if ProductID is set
if(isset($_REQUEST['ProductID'])) {
    $pid = $_REQUEST['ProductID'];
    
    $fms = $connection->prepare("SELECT * FROM product WHERE ProductID = ?");
    $fms->bind_param("i", $pid);
    $fms->execute();
    $result = $fms->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ProductID'];
        $y = $row['Name'];
        $z = $row['Description'];
        $w = $row['Price'];
        $v = $row['SupplierID'];
    } else {
        echo "Product not found.";
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
        <input type="hidden" name="ProductID" value="<?php echo isset($x) ? $x : ''; ?>">
        
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Description">Description:</label>
        <input type="text" name="Description" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Price">Price:</label>
        <input type="number" name="Price" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        
        <label for="SupplierID">SupplierID:</label>
        <input type="number" name="SupplierID" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Name = $_POST['Name'];
    $Description = $_POST['Description'];
    $Price = $_POST['Price'];
    $SupplierID  = $_POST['SupplierID'];
    
    // Update the product in the database
    $fms = $connection->prepare("UPDATE product SET Name=?, Description=?, Price=?, SupplierID=? WHERE ProductID=?");
    $fms->bind_param("sssii", $Name, $Description, $Price, $SupplierID, $pid);
    $fms->execute();
    
    // Redirect to product.php
    header('Location: product.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
