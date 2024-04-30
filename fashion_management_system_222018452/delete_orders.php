<?php
include('database_connection.php');

// Check if OrderID is set
if(isset($_REQUEST['OrderID'])) {
    $oid = $_REQUEST['OrderID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM orders WHERE OrderID = ?");
    $stmt->bind_param("i", $oid);
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
            <input type="hidden" name="OrderID" value="<?php echo $oid; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='orders.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
    ?>
    </body>
    </html>
    <?php

    $stmt->close();
} else {
    echo "OrderID is not set.";
}

$connection->close();
?>
