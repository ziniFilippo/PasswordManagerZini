<?php
    include "connection.php";

    function redirect($url){
        header("Location: ".$url);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mail = $_POST['username'];
        $password = $_POST['password'];
        $salt = random_bytes(32);
        $salt = bin2hex($salt);
        $password = $password.$salt;
        $hashed_password = hash("sha3-512",$password);
        $datetime = date("Y-m-d H:i:s");
        $stmt = $conn->prepare("INSERT INTO VERIFICA (mail, sha3 , salt, data_richiesta) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $mail, $hashed_password, $salt, $datetime);
        $stmt->execute();
        $mail_id = $conn->prepare("SELECT id FROM VERIFICA WHERE mail = ?");
        $mail_id->bind_param("s", $mail);
        $mail_id->execute();
        $mail_id = $mail_id->get_result();
        $mail_id = $mail_id->fetch_assoc();
        $mail_id = $mail_id['id'];
        redirect("./verify_code.php?mail_id=".$mail_id);
    } else {
        redirect("./register.php?error=Invalid method");
    }
?>