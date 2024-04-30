<?php
include('database_connection.php');

// Check if ProductID is set
if(isset($_REQUEST['ProductID'])) {
    $pid = $_REQUEST['ProductID'];
    
    // Prepare and execute the DELETE statement
    $fms = $connection->prepare("DELETE FROM product WHERE ProductID = ?");
    $fms->bind_param("i", $pid);
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
            <input type="hidden" name="ProductID" value="<?php echo $pid; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
    if ($fms->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='product.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $fms->error;
    }
    ?>
    </body>
    </html>
    <?php

    $fms->close();
} else {
    echo "ProductID is not set.";
}

$connection->close();
?>
