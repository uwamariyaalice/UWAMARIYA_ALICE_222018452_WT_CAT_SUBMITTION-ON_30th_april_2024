<?php
include('database_connection.php');
// Check if the 'query' GET parameter is set
if (isset($_GET['query'])) {
     
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Perform the search query for customer
    $sql = "SELECT * FROM customer WHERE Name LIKE '%$searchTerm%'";
    $result_customer = $connection->query($sql);

    // Perform the search query for farm
    $sql = "SELECT * FROM employee WHERE Name LIKE '%$searchTerm%'";
    $result_employee = $connection->query($sql);

    // Perform the search query for orders
    $sql = "SELECT * FROM orders WHERE OrderDate LIKE '%$searchTerm%'";
    $result_orders = $connection->query($sql);

    // Perform the search query for product
    $sql = "SELECT * FROM product WHERE Name LIKE '%$searchTerm%'";
    $result_product = $connection->query($sql);

    // Perform the search query for sales
    $sql = "SELECT * FROM supplier WHERE Name LIKE '%$searchTerm%'";
    $result_supplier = $connection->query($sql);

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";
    echo "<h3>custmer:</h3>";
    if ($result_customer->num_rows > 0) {
        while ($row = $result_customer->fetch_assoc()) {
            echo "<p>" . $row['Name'] . "</p>";
        }
    } else {
        echo "<p>No customer found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>employee:</h3>";
    if ($result_employee->num_rows > 0) {
        while ($row = $result_employee->fetch_assoc()) {
            echo "<p>" . $row['Name'] . "</p>";
        }
    } else {
        echo "<p>No employee found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>orders:</h3>";
    if ($result_orders->num_rows > 0) {
        while ($row = $result_orders->fetch_assoc()) {
            echo "<p>" . $row['OrderDate'] . "</p>";
        }
    } else {
        echo "<p>No orders found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>product:</h3>";
    if ($result_product->num_rows > 0) {
        while ($row = $result_product->fetch_assoc()) {
            echo "<p>" . $row['Name'] . "</p>";
        }
    } else {
        echo "<p>No product found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>supplier:</h3>";
    if ($result_supplier->num_rows > 0) {
        while ($row = $result_supplier->fetch_assoc()) {
            echo "<p>" . $row['Name'] . "</p>";
        }
    } else {
        echo "<p>No supplier       found matching the search term: " . $searchTerm . "</p>";
    }
    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
