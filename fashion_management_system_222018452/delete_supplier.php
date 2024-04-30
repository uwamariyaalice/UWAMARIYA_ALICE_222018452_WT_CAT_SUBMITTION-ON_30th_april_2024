   <?php
include('database_connection.php');

// Check if supplierID is set
if(isset($_REQUEST['supplierID'])) {
    $sid = $_REQUEST['supplierID'];
    
    // Prepare and execute the DELETE statement
    $fms = $connection->prepare("DELETE FROM supplier WHERE supplierID = ?");
    $fms->bind_param("i", $sid);
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
            <input type="hidden" name="supplierID" value="<?php echo $sid; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
    if ($fms->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='supplier.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $fms->error;
    }
       ?>
    </body>
    </html>
    <?php


    $fms->close();
} else {
    echo "supplierID is not set.";
}

$connection->close();
?>
