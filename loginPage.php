<?php
include ("connection.php");

$conn=connectToDB();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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