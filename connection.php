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


?>