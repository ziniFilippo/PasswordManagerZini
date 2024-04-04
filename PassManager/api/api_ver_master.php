<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("SELECT * FROM ACCOUNT WHERE MAIL = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $salt = $user['SALT'];
            $password = $password.$salt;
            $password = hash("sha3-512",$password);
            if ($password == $user['SHA3']) {
                header("HTTP/1.1 200 OK");
            } else {
                header("HTTP/1.1 400");
            }
        } else {
            header("HTTP/1.1 400");
        }
    } else {
        header("HTTP/1.1 400");
    }