<?php
    include "connection.php";

    function redirect($url){
        header("Location: ".$url);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("SELECT * FROM ACCOUNT WHERE USERNAME = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $salt = $user['salt'];
            $password = $password.$salt;
            if (password_verify($password, $user['sha3'])) {
                session_start();
                $_SESSION['username'] = $username;
                redirect("./home.php");
            } else {
                redirect("./login.php?error=Invalid password");
            }
        } else {
            redirect("./login.php?error=Invalid username");
        }
    } else {
        redirect("./login.php");
    }
?>