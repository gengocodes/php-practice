<?php
    include("database.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <h2>Welcome to Fakebook!</h2>
        <label htmlFor="username">Username: </label>
        <input type="text" name="username" required><br>
        <label htmlFor="password">Password: </label>
        <input type="password" name="password" required><br>
        <input type="submit" name="submit" value="Register">
    </form>
</body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
        if (empty($username) && empty($password)){
            echo "Please enter a username and password!";
        } elseif (empty($username)){
            echo "Please enter a username!";
        } elseif (empty($password)){
            echo "Please enter a password!";
        } else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (user,password) VALUES ('$username', '$hash')";
            mysqli_query($conn, $sql);
            echo "You are now registered, $username!";
        }
    }
    
    mysqli_close($conn);
?>