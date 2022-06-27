<?php
require_once "config.php";
$uploadFlag = false;
// define('DB_SERVER','localhost');
//     define('DB_USERNAME','root');
//     define('DB_PASSWORD','');
//     define('DB_NAME','loginsystem');

//     $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
//      if($link==false)
//         die("Couldn't connect to database. " .mysqli_connect_error());

$username = $password = $confirmPassword = "";
$usernameErr = $passwordErr = $confirmPasswordErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST["username"]))
        $usernameErr = "Please enter a username";
    else
        $username = $_POST["username"];

    if (empty($_POST["password"]))
        $passwordErr = "Enter a password";
    else if (strlen($_POST["password"]) < 8)
        $passwordErr = "Password must contain at least 8 characters";
    else
        $password = $_POST["password"];

    if (empty($_POST["confirmPassword"]))
        $confirmPasswordErr = "Please confirm password";
    else
        $confirmPassword = $_POST["confirmPassword"];
    if ($password != $confirmPassword)
        $confirmPasswordErr = "Passwords do not match";
}

if (empty($usernameErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
    $sql = "INSERT INTO `loginsystem`.`users` (`username`, `password`) VALUES ('$username', '$password')";
}

if ($link->query($sql) == true) {
    // echo "Your details have been uploaded!";
    $uploadFlag= true;
}
 else {
    echo "ERROR: $link->error";
}
$link->close;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
</head>

<body>
    <div class="container">
        <h2>Sign Up</h2>
        <p>Fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="form">
            Username: <input type="text" name="username" value="<?php echo $username; ?>">
            <span class="error">
                <?php echo $usernameErr; ?>
            </span>

            <br><br>

            Password: <input type="password" name="password" value="<?php echo $password; ?>">
            <span class="error">
                <?php echo $passwordErr; ?>
            </span>

            <br><br>

            Confirm Password: <input type="password" name="confirmPassword" value="<?php echo $confirmPassword; ?>">
            <span class="error">
                <?php echo $confirmPasswordErr; ?>
            </span>

            <br><br>
        </div>

        <div class="button">
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>
        <p> <?php if($uploadFlag==true) echo "You are now registered. Login to continue"; ?> </p>
        <p>Already have an account? <a href="#">Login here</a></p>
        </form>
    </div>
</body>