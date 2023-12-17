<?php
    include "connection.php";

    function redirect($url){
        header("Location: ".$url);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $salt = random_bytes($length);
        $password = $password.$salt;
        $hashed_password = hash("sha3",$password);
        $stmt = $conn->prepare("INSERT INTO ACCOUNT (mail, sha3 , salt) VALUES (?, ?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password, $salt);
        $stmt->execute();

        session_start();
        $_SESSION['username'] = $username;
        redirect("./home.php");
    } else {
        redirect("./register.php");
    }
?>