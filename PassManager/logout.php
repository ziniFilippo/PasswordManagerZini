<?php
    include "./session/connection.php";
    if (isset($_COOKIE['pm_sess'])) {
        $sess = $_COOKIE['pm_sess'];
        $stmt = $conn->prepare("SELECT * FROM SESSIONE WHERE ID_SESSIONE = ?");
        $stmt->bind_param("s", $sess);
        $stmt->execute();
        $result = $stmt->get_result();
        $session = $result->fetch_assoc();
        $user_id = $session['ACCOUNT_ID'];
        setcookie('pm_sess', '', time() - 3600, '/');
        $elimina_sessione = "DELETE FROM SESSIONE WHERE ACCOUNT_ID = ?";
        $elimina_sessione = $conn->prepare($elimina_sessione);
        $elimina_sessione->bind_param("s", $user_id);
        $elimina_sessione->execute();
        header("Location: ./login/login.php");
    } else {
        header("Location: ./login/login.php");
    }
?>