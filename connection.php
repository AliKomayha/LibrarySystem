<?php

    function connectToDB(){
        $conn = new mysqli("localhost", "root","","library");
        if(!$conn){
            die("connection failed ".mysqli_error($conn));
        }
        return $conn;
    }

    function closeDBconnection($conn) {
        mysqli_close($conn);
    }

    function logIn($username){
        $conn= connectToDB();
        $sql="SELECT Users.id, username, password, rid FROM Account, Users, Userroles 
                WHERE account.uid = Users.id
                AND Users.id= Userroles.uid 
                AND Account.username = '$username';";
        $result=mysqli_query($conn,$sql);
        closeDBconnection($conn);
        return $result;

    }
    function signUP($email, $fname, $lname, $phone, $username, $password, $rid){
            $conn= connectToDB();
            $sql=" INSERT INTO `users` (`fname`, `lname`, `email`, `phone`) VALUES
            ( '$fname', '$lname', '$email', '$phone');
            SET @userId = LAST_INSERT_ID();
            INSERT INTO `account` (`username`, `password`, `uid`) VALUES
            ('$username', '$password', @userId);
            INSERT INTO userroles(uid,rid) VALUES (@userId,2); ";

            $result=mysqli_multi_query($conn,$sql);
            closeDBconnection($conn);
            return $result;

    }
    function redirectToLogInPage(){
        header("Location: loginPage.php");
        exit();
    }

    function selectAllBooks(){
        $conn=connectToDB();
        $sql="SELECT book.id, title, author, publicationDate,img, bookstatus.status,category.name 
        FROM book,bookstatus,category
        WHERE book.cid=category.id
        AND book.status=bookstatus.id;";

        $result=mysqli_query($conn,$sql);
        closeDBconnection($conn);
        return $result;
    
    }
    function addBook($title,$author,$publicationDate,$targetPath,$status,$cid){
        $conn=connectToDB();
        $sql=" INSERT INTO `book` (`title`, `author`, `publicationDate`, `img`, `status`,`cid`) VALUES
        ( '$title', '$author', '$publicationDate', '$targetPath', 1, 1); ";
        $result=mysqli_query($conn,$sql);
        closeDBconnection($conn);
        return $result;

    }

    function rentBook($borrowDate, $dueDate, $uid, $bid){
        $conn=connectToDB();
        $sql="INSERT INTO `borroweditems` (`borrowDate`, `dueDate`, `uid`, `bid`) VALUES
        ('$borrowDate', '$dueDate', '$uid', '$bid'); ";
        $result=mysqli_query($conn,$sql);
        // closeDBconnection($conn);
        return $result;
    }
?>