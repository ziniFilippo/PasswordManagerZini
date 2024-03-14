<?php
    include "../session/connection.php";
    include "../session/cookie_check.php";
    $password_id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM CREDENZIALE WHERE ID = ?");
    $stmt->bind_param("s", $password_id);
    $stmt->execute();
    header("Location: ./view_password.php");
?>