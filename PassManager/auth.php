<?php 
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
        redirect("./Home.php");
    } else {
        redirect("./login.php");
    }
?>