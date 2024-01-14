<?php
    include "../session/connection.php";
    include "../session/cookie_check.php";
    $qry = "DELETE FROM ACCOUNT WHERE ACCOUNT.ID = ?";
    $elimina_account = $conn->prepare($qry);
    $elimina_account->bind_param("s", $user_id);
    echo 
    "<script>
        let choice = confirm('Are you sure? This action is irreversible');
        if (choice == false) {
            window.location.href = './profile.php';
        }
    </script>";
    $elimina_sessione = "DELETE FROM SESSIONE WHERE ACCOUNT_ID = ?";
    $elimina_sessione = $conn->prepare($elimina_sessione);
    $elimina_sessione->bind_param("s", $user_id);

    $elimina_sessione->execute();
    $elimina_account->execute();
    header("Location: ../logout.php");
    exit;
?>