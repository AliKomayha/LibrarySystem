<?php
include("connection.php");


$conn=connectToDB();

 function escapehtmlchars($input)
 {
     return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
 }

 $targetDir = "img/";

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = isset($_POST["title"]) ? mysqli_real_escape_string($conn, $_POST["title"]) : '';
    $author = isset($_POST["author"]) ? mysqli_real_escape_string($conn, $_POST["author"]) : '';
    $publicationDate = isset($_POST["publicationDate"]) ? mysqli_real_escape_string($conn, $_POST["publicationDate"]) : '';
    $status = isset($_POST["status"]) ? mysqli_real_escape_string($conn, $_POST["status"]) : '';
    $cid = isset($_POST["cid"]) ? mysqli_real_escape_string($conn, $_POST["cid"]) : '';


    $fileName = basename($_FILES["file"]["name"]);
    $targetPath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
    $allowedTypes = array("jpg", "jpeg", "png");

    if (!in_array($fileType, $allowedTypes)) {
        echo "Error: Only JPG, JPEG, and PNG files are allowed.";
    } else {
        // Check file size (limit to 5MB)
        if ($_FILES["file"]["size"] > 5 * 1024 * 1024) {
            echo "Error: File size should be less than 5MB.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)) {

                $result=addBook($title,$author,$publicationDate,$targetPath,$status,$cid);
                if ($result) {
                    echo "Book added successfully!";
                    // redirectToLogInPage();
                } else {
                    echo "Error in adding " . mysqli_error($conn);
                }

        }else {
            echo "Error: File upload failed.";
        }
        }
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian</title>
</head>
<body>

<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
    <input id="title" type="text" class="form-control" name="title" placeholder="Book Title">
    <input id="author" type="text" class="form-control" name="author" placeholder="Author Name">
    <input id="publicationDate" type="Date" class="form-control" name="publicationDate" placeholder="Publication Date">
    <!-- <select name="" required>
        <option value="teacher">Teacher</option>
        <option value="student">Student</option>
    </select><br> -->
    <label for="file">Select File:</label>
    <input type="file" name="file" id="file" accept=".jpg, .jpeg, .png" required>

    <input type="submit" name="submit" value="Add Book">

</form>

<!-- here we will display all books in a certain way, okkay hobb -->
    
</body>
</html>