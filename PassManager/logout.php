<?php
    include "./session/connection.php";
    include "./session/cookie_check.php";
    setcookie('pm_sess', '', time() - 3600, '/');
    $elimina_sessione = "DELETE FROM SESSIONE WHERE ACCOUNT_ID = ?";
    $elimina_sessione = $conn->prepare($elimina_sessione);
    $elimina_sessione->bind_param("s", $user_id);
    $elimina_sessione->execute();
    header("Location: ./login/login.php");
?>