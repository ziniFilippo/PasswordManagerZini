<?php
    include "connection.php";
    include "cookie_check.php";
    $password_id = $_GET['id'];
    $url = $_POST['url'];
    $mail = $_POST['mail'];
    $password =$_POST['password'];
    $data = date("Y-m-d H:i:s");
    $qry = $conn->prepare("UPDATE CREDENZIALE SET SITO = ?, MAIL = ?, PASSWORD = ?, DATA = ? WHERE ID = ?");
    $qry->bind_param("sssss", $url, $mail, $password, $password_id,$data);
    $qry->execute();
    header("Location: view_password.php");
?>