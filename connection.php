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



?>