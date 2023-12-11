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
        $check_user = "SELECT * FROM ACCOUNT WHERE USERNAME=".$user." AND MD5=".$password;
        $result = $conn->query($check_user);
        if ( $result->num_rows > 0) {
            echo "Redirecting to your home";
        } else {
            $error = 1;
            header("Location: ./login.php?error=$error");
        }
        $conn->close();
        redirect("./home.php");
    } else {
        $error = 1;
        header("Location: ./login.php?error=$error");
    }
?>