<?php
    include "connection.php";
    session_start();
    function redirect($url){
        header("Location: ".$url);
        exit();
    }
    $user = $_POST['user'];
    $password = $_POST['password'];
    $error = 0;
    if ($user != "" and $password != ""){
        $_SESSION["user"] = $user;
        $_SESSION["password"] = $password;
        $add_user = "INSERT INTO ACCOUNT(USERNAME,MD5) VALUES('".$user."','".$password."')";
        if ($conn->query($add_user) === TRUE) {
            echo "New record created successfully";
        } else {
            $error = 1;
            header("Location: ./register.php?error=$error");
        }
        $conn->close();
        redirect("./home.php");
    } else {
        $error = 1;
        header("Location: ./register.php?error=$error");
    }
?>