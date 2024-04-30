<?php
include('database_connection.php');

// Check if CustomerID is set
if(isset($_REQUEST['CustomerID'])) {
    $cid = $_REQUEST['CustomerID'];

    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM customer WHERE CustomerID = ?");
    $stmt->bind_param("i", $cid);
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
            <input type="hidden" name="CustomerID" value="<?php echo $cid; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='customer.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
    ?>
    </body>
    </html>
    <?php

    $stmt->close();
} else {
    echo "CustomerID is not set.";
}

$connection->close();
?>
