<?php
$username = "";
$email = "";
$password = "";
$errors = array();

// connect to the database
//$conn = new mysqli('localhost', 'username', 'password', 'database');

// check the connection
/*if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // form validation: ensure that the form is correctly filled
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password); //encrypt the password before saving in the database

        $query = "INSERT INTO users (username, email, password) 
                  VALUES('$username', '$email', '$password')";
        mysqli_query($conn, $query);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}

// ...
// more PHP code goes here ...
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
</head>

<body>
    <form method="post" action="register.php">
        <div>
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div>
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" value="<?php echo $password; ?>">
        </div>
        <div>
            <input type="submit" name="reg_user" value="Register">
        </div>
    </form>
</body>

</html>