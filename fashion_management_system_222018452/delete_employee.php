<?php
include('database_connection.php');

// Check if EmployeeID is set
if(isset($_REQUEST['EmployeeID'])) {
    $Eid = $_REQUEST['EmployeeID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM employee WHERE EmployeeID = ?");
    $stmt->bind_param("i", $Eid);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body bgcolor="grey">
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="EmployeeID " value="<?php echo $Eid; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='employee.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
   ?>
    </body>
    </html>
    <?php
    $stmt->close();
} else {
    echo "EmployeeID is not set.";
}

$connection->close();
?>
