<?php
include ("connection.php");
session_start();

$conn=connectToDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $borrowDate = isset($_POST["borrowDate"]) ? mysqli_real_escape_string($conn, $_POST["borrowDate"]) : '';
    $dueDate = isset($_POST["dueDate"]) ? mysqli_real_escape_string($conn, $_POST["dueDate"]) : '';
    $uid = $_SESSION["user_id"];
    $bid = isset($_POST["bid"]) ? mysqli_real_escape_string($conn, $_POST["bid"]) : '';

    $result=rentBook($borrowDate, $dueDate, $uid, $bid);
            if ($result) {
                echo "Rentedsuccessfully!";
                
            } else {
                echo "Error in renting process " . mysqli_error($conn);
            }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <title>Student Dash</title>
</head>
<body style="margin: 0; padding: 0;">
    
    <div style="width: 100%; height: 50px; background-color: black ;">
        <a href="rentedBooks.php" >My Rented Books</a>
    </div>

    <?php
        $result=selectAllBooks();
        if(mysqli_num_rows($result)>0){
            while($row= mysqli_fetch_assoc($result)){
                echo"<table>";
                echo"
                    <tr><form method='post' action='" .$_SERVER["PHP_SELF"]. "'>
                    <td rowspan= 7><img src='{$row['img']}' width='100' height='130'></td></tr>
                    <tr><td>Book ID: {$row['id']}</td></tr>
                    <tr><td>{$row['title']}</td></tr>
                    <tr><td>{$row['author']}</td></tr>
                    <tr><td>{$row['publicationDate']}</td></tr>
                    <tr><td>{$row['status']}</td></tr>
                    <tr><td>{$row['name']}</td></tr>
                    <tr><td>
                    
                    <a data-bs-toggle='modal' data-bs-target='#rentBook' name='rent_book' class='nav-link' >Rent Book</a>
                    

                    </td></tr>
                ";
                
                echo"</table>";
            }

        }

    ?>
    <div class="modal" id="rentBook">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

                <div class="modal-header">
                    <div class="modal-title">
                        Sign Up
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- hon l shu esmon-->
                    <div class="input-group mt-2">
                        Book ID:
                        <input id="bid" type="text" class="form-control" name="bid" placeholder="Book ID">
                    </div>
                    <div class="input-group mt-2">
                        Borrow Date:
                        <input id="borrowDate" type="date" class="form-control" name="borrowDate" placeholder="Borrow Date">
                    </div>
                    <?php echo"$bid"; ?>
                    <div class="input-group mt-2">
                        Due Date:
                        <input id="dueDate" type="date" class="form-control" name="dueDate" placeholder="Due Date">
                    </div>
                                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Rent Book</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    


                


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>