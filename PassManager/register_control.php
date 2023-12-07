<?php
    include "connection.php";
    session_start();
    function redirect($url){
        header("Location: ".$url);
        exit();
    }
    $user = $_POST['user'];
    $password = $_POST['password'];
    if ($user != "" and $password != ""){
        $_SESSION["user"] = $user;
        $_SESSION["password"] = $password;
        $add_user = "INSERT INTO ACCOUNT(USERNAME,MD5) VALUES('".$user."','".$password."')";
        if ($conn->query($add_user) === TRUE) {
            echo "New record created successfully";
        } else {
          echo "Error: " . $add_user . "<br>" . $conn->error;
        }
        $conn->close();
        redirect("./home.php");
    } else {
        $_SESSION["error"] = 1;
        redirect("./register.php");
    }
?>