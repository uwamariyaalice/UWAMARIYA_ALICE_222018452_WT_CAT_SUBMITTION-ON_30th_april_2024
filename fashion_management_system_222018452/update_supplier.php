<?php
include('database_connection.php');

// Check if supplierID is set
if(isset($_REQUEST['supplierID'])) {
    $spid = $_REQUEST['supplierID'];
    
    $stmt = $connection->prepare("SELECT * FROM supplier WHERE supplierID = ?");
    $stmt->bind_param("i", $spid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['supplierID'];
        $y = $row['Name'];
        $z = $row['Contact'];
        $v = $row['Email'];
        $w = $row['Gendar'];
        $supplierID = $row['supplierID'];
    } else {
        echo "Supplier not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update supplier</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body bgcolor="pink">
    <center>
        <h2><u>Update Form of supplier</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="Name">Name:</label>
            <input type="text" name="Name" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="Contact">Contact:</label>
            <input type="text" name="Contact" value="<?php echo isset($z) ? $z : ''; ?>">
            <br><br>

            <label for="Email">Email:</label>
            <input type="text" name="Email" value="<?php echo isset($v) ? $v : ''; ?>">
            <br><br>
            
            <label for="Gendar">Gender:</label>
            <input type="text" name="Gender" value="<?php echo isset($w) ? $w : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Name = $_POST['Name'];
    $Contact = $_POST['Contact'];
    $Email = $_POST['Email'];
    $Gendar = $_POST['Gendar'];
    // Update the supplier in the database
    $stmt = $connection->prepare("UPDATE supplier SET Name=?, Contact=?, Email=?, Gendar=? WHERE supplierID=?");
    $stmt->bind_param("ssssi", $Name, $Contact, $Email, $Gendar, $spid);
    $stmt->execute();
    
    // Redirect to sales.php
    header('Location: supplier.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
