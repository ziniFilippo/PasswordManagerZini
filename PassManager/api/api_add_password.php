<?php
    include "../session/connection.php";
    include "../session/cookie_check.php";
    $id = $user_id;
    $password = $_POST['password'];
    $url = $_POST['url'];
    $mail = $_POST['mail'];
    $data = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO CREDENZIALE (ACCOUNT_ID, SITO, MAIL, PASSWORD, DATA) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $id, $url, $mail, $password, $data);
    $stmt->execute();
    header("Location: ../passwords/view_password.php");