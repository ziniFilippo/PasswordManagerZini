<?php
    include "./connection.php";
    session_start();
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT * FROM ACCOUNT WHERE MAIL = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $id = $user['ID'];
    $password = $_POST['password'];
    $url = $_POST['url'];
    $mail = $_POST['mail'];
    $data = date("Y-m-d");
    $stmt = $conn->prepare("INSERT INTO CREDENZIALE (ACCOUNT_ID, SITO, MAIL, PASSWORD, DATA) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $id, $url, $mail, $password, $data);
    $stmt->execute();
    header("Location: ./view_password.php");
?>