<?php
include('database_connection.php');

// Check if EmployeeID is set
if(isset($_REQUEST['EmployeeID'])) {
    $EmployeeID = $_REQUEST['EmployeeID'];
    
    $fms = $connection->prepare("SELECT * FROM employee WHERE EmployeeID = ?");
    $fms->bind_param("i", $EmployeeID);
    $fms->execute();
    $result = $fms->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['EmployeeID'];
        $y = $row['Name'];
        $z = $row['Position'];
        $v = $row['Salary'];
        $w = $row['Gender'];
    } else {
        echo "employee not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update employee</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script> 


<body bgcolor="pink"><center>
    <h2><u>Update Form of employee</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="EmployeeID" value="<?php echo isset($x) ? $x : ''; ?>">
        
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="Position">Position:</label>
        <input type="text" name="Position" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="Salary">Salary:</label>
        <input type="text" name="Salary" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <label for="Gender">Gender:</label>
        <input type="text" name="Gender" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form   
    $EmployeeID = $_POST['EmployeeID'];
    $Name = $_POST['Name'];
    $Position = $_POST['Position'];
    $Salary = $_POST['Salary'];
    $Gender = $_POST['Gender'];
    
    // Update the employee in the database
    $fms = $connection->prepare("UPDATE employee SET Name=?, Position=?, Salary=?, Gender=? WHERE EmployeeID=?");
    $fms->bind_param("ssdsi", $Name, $Position, $Salary, $Gender, $EmployeeID );
    $fms->execute();
    
    // Redirect to employee.php
    header('Location: employee.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
