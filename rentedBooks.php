<?php
include("connection.php");
session_start();
$conn=connectToDB();
$uid=$_SESSION['user_id'];

// echo" $uid ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $returnDate = isset($_POST["returnDate"]) ? mysqli_real_escape_string($conn, $_POST["returnDate"]) : '';
    $brid = isset($_POST["brid"]) ? mysqli_real_escape_string($conn, $_POST["brid"]) : '';
    $bid = isset($_POST["bid"]) ? mysqli_real_escape_string($conn, $_POST["bid"]) : '';

    $result=returnBook($returnDate, $brid, $bid);
    if ($result) {
       echo "Book returned successfully!";
    } else {
        echo "Error in returning " . mysqli_error($conn);
    }

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rented Books</title>
</head>
<body>
<h4>Return a book</h4>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
    <c>Return Date: </c>
    <input id="returnDate" type="date" class="form-control" name="returnDate" placeholder="Return Date" required>
    <input id="brid" type="text" class="form-control" name="brid" placeholder="Renting ID">
    <input id="bid" type="text" class="form-control" name="bid" placeholder="Book ID">
    <input type="submit" name="submit" value="Return Book">
</form>
</br></br>


<?php
        $result=showRented($uid);
        if(mysqli_num_rows($result)>0){
            while($row= mysqli_fetch_assoc($result)){
                echo"<table border=1>";
                echo"
                    <tr><form method='post' action='" .$_SERVER["PHP_SELF"]. "'>
                    <td>Renting ID:</td> <th colspan=2>{$row['id']}</th></tr>
                    <tr><td rowspan= 6><img src='{$row['img']}' width='100' height='130'></td></tr>
                    <tr><td>Book ID:</td><th> {$row['bid']}</th></tr>
                    <tr><td>Title:</td><td>{$row['title']}</td></tr>
                    <tr><td>Author:</td><td> {$row['author']}</td></tr>
                    <tr><td>Borrow Date:</td><td> {$row['borrowDate']}</td></tr>
                    <tr><td>Due Date:</td><td> {$row['dueDate']}</td></tr>
                    <tr><td>Returned Date:</td><td colspan= 2> {$row['returnDate']}</td></tr>
                    <br><br>

                
                ";
                
                echo"</table>";
            }

        }

    ?>
    
</body>
</html>