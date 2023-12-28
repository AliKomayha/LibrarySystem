<?php
include ("connection.php");

$conn=connectToDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password = md5($password);
    

    // Retrieve user from the users table
    $result = logIn($username);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if ($password == $row["password"]) {
            // Start session and set user role
            session_start();
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_role"] = $row["rid"];

            // Redirect based on role
            if ($row["rid"] == 1) {
                header("Location: librarianDashboard.php");
            } else if($row["rid"] == 2) {
                header("Location: studentDashboard.php");
            }
        } else {
            echo "Login failed! Incorrect password.";
        }
    } else {
        echo "Login failed! User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <title>Log in</title>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
    
            <div class="container">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="input-group mt-4">
                    <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="input-group mt-2">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="mt-2">
                    <button class="btn btn-secondary text-center" type="submit">Log in</button>
                </div>    
                </form>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>   