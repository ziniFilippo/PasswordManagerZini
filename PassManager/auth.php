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
        $check_user = "INSERT INTO ACCOUNT(USERNAME,M5A) VALUES('".$user."','".$password."')";
        if ($conn->query($check_user) === TRUE) {
            echo "New record created successfully";
        } else {
          echo "Error: " . $check_user . "<br>" . $conn->error;
        }
        $conn->close();
        redirect("./Home.php");
    } else {
        redirect("./login.php");
    }
?>