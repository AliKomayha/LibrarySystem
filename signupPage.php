<?php
include ("connection.php");

$conn=connectToDB();

 function escapehtmlchars($input)
 {
     return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
 }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST["email"]) ? mysqli_real_escape_string($conn, $_POST["email"]) : '';
    $fname = isset($_POST["fname"]) ? mysqli_real_escape_string($conn, $_POST["fname"]) : '';
    $lname = isset($_POST["lname"]) ? mysqli_real_escape_string($conn, $_POST["lname"]) : '';
    $phone = isset($_POST["phone"]) ? mysqli_real_escape_string($conn, $_POST["phone"]) : '';
    $username = isset($_POST["username"]) ? mysqli_real_escape_string($conn, $_POST["username"]) : '';
    $password = isset($_POST["password"]) ? mysqli_real_escape_string($conn, $_POST["password"]) : '';
    $rid = isset($_POST["rid"]) ? mysqli_real_escape_string($conn, $_POST["rid"]) : '';

    // Security feature: Escape HTML characters
    $username = escapehtmlchars($username);
    $password = escapehtmlchars($password);
    

    // Security feature: Limit username and password length to 20 characters
    $fname = substr($fname, 0, 20);
    $lname = substr($lname, 0, 20);
    $phone = substr($phone, 0, 8);
    $username = substr($username, 0, 20);
    $password = substr($password, 0, 20);
    $password = md5($password);

    // Security feature: Ensure username and password are not empty
    if (empty($username) || empty($password)) {
        echo "Username and password cannot be empty.";
    } else {
            // Insert user into the users table
            $result=signUP($email, $fname, $lname, $phone, $username, $password, $rid);
            if ($result) {
                echo "Registration successful!";
                redirectToLogInPage();
            } else {
                echo "Error in registration " . mysqli_error($conn);
            }
        }
    }

closeDBconnection($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <title>Sign Up</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
    
            <div class="container">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="input-group">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="input-group mt-2">
                    <input id="fname" type="text" class="form-control" name="fname" placeholder="First name">
                    <input id="lname" type="text" class="form-control" name="lname" placeholder="Last name">
                </div>
                <div class="input-group mt-2">
                    <input id="phone" type="phone" class="form-control" name="phone" placeholder="Phone number">
                </div>

                <div class="input-group mt-4">
                    <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="input-group mt-2">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="mt-2">
                    <button class="btn btn-secondary text-center" type="submit">Sign Up</button>
                </div>    
                </form>
            </div>

        </div>
    </div>
</div>  

    


</body>
</html>     
