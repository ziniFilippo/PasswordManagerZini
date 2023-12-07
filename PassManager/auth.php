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
        $check_user = "SELECT * FROM ACCOUNT WHERE USERNAME='".$user."' AND MD5='".$password."';";
        if ($conn->query($check_user) === TRUE) {
            echo "Redirecting to your home";
        } else {
          echo "Error: " . $check_user . "<br>" . $conn->error;
        }
        $conn->close();
        redirect("./home.php");
    } else {
        redirect("./login.php");
    }
?>