<?php
include ("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dash</title>
</head>
<body style="margin: 0; padding: 0;">
    
    <div style="width: 100%; height: 50px; background-color: black ;"></div>

    <?php
        $result=selectAllBooks();
        if(mysqli_num_rows($result)>0){
            while($row= mysqli_fetch_assoc($result)){
                echo"<table>";
                echo"
                    <tr><td rowspan= 6><img src='{$row['img']}' width='100' height='100'></td></tr>
                    <tr><td>{$row['title']}</td></tr>
                    <tr><td>{$row['author']}</td></tr>
                    <tr><td>{$row['publicationDate']}</td></tr>
                    <tr><td>{$row['status']}</td></tr>
                    <tr><td>{$row['name']}</td></tr>
                    <tr><td><button>Rent Book</button</td></tr>
                ";
                
                echo"</table>";
                    

            }





        }







    ?>






</body>
</html>