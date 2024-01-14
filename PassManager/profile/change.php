<?php
    include "../session/connection.php";
    include "../session/cookie_check.php";
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];
    if ($new_password != $confirm_new_password) {
        header("Location: ./change_password.php?error=Passwords do not match.");
        exit;
    }
    $qry = "SELECT * FROM ACCOUNT WHERE ACCOUNT.ID = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $user_password = $user['SHA3'];
    $salt = $user['SALT'];
    $old_password = hash("sha3-512", $old_password.$salt);
    if ($user_password != $old_password) {
        header("Location: ./change_password.php?error=The old password is wrong.");
        exit;
    }
    $salt = random_bytes(32);
    $salt = bin2hex($salt);
    $new_password = $new_password.$salt;
    $new_password = hash("sha3-512", $new_password);
    $qry = "UPDATE ACCOUNT SET SHA3 = ?, SALT = ? WHERE ACCOUNT.ID = ?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("sss", $new_password,$salt, $user_id);
    $stmt->execute();
    header("Location: ./profile.php?error=Password changed successfully.");
    exit;
?>