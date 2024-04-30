<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <br>
    <a href="forgot_password.php">Forgot Password</a><br>  
    <a href="create_account.php">Create New Account</a>

    <?php
    session_start(); // Start the session

    include('database_connection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare the SQL statement to prevent SQL injection
        $sql = "SELECT * FROM user WHERE email=?"; 
        $fms = $connection->prepare($sql);
        $fms->bind_param("s", $email);
        $fms->execute();
        $result = $fms->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify the hashed password
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                header("Location: home.html");
                exit();
            } else {
                echo "Invalid email or password";
            }
        } else {
            echo "User not found";
        }
    }

    $connection->close();
    ?>
</body>
</html>
