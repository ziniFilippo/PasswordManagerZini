<?php
    include "../session/connection.php";
    function redirect($url){
        header("Location: ".$url);
        exit();
    }
    if(!isset($_GET['code'])){
        $mail_id = $_GET['mail_id'];
        $code = random_int(100000, 999999);
        $stmt = $conn->prepare("UPDATE VERIFICA  SET TOKEN_AUTH = ? WHERE ID = ?");
        $stmt->bind_param("ss", $code, $mail_id);
        $stmt->execute();
        error_log($code);
    } else {
        $code = $_GET['code'];
        $check = $conn->prepare("SELECT * FROM VERIFICA WHERE TOKEN_AUTH = ?");
        $check->bind_param("s", $code);
        $check->execute();
        $result = $check->get_result();
        if ($result->num_rows > 0) {
            $fetch = $result->fetch_assoc();
            $mail_id = $fetch['ID'];
            $validate = $conn->prepare("SELECT * FROM VERIFICA WHERE TOKEN_AUTH = ?");
            $validate->bind_param("s", $code);
            $validate->execute();
            $result = $validate->get_result();
            if ($result->num_rows > 0) {
                //raccolgo i dati
                    $fetch = $result->fetch_assoc();
                    $salt = $fetch['SALT'];
                    $password = $fetch['SHA3'];
                    $mail = $fetch['MAIL'];
                    $ssl_key = $fetch['SSL_KEY'];
                //inserisco i dati
                $stmt = $conn->prepare("INSERT INTO ACCOUNT (id,mail, sha3, salt) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $mail_id, $mail, $password, $salt);
                $stmt->execute();
                //elimino i dati
                $delete = $conn->prepare("DELETE FROM VERIFICA WHERE TOKEN_AUTH = ?");
                $delete->bind_param("s", $code);
                $delete->execute();
                
                //redirect("");
                redirect("../login/login.php?key=$ssl_key&id=$mail_id");
            }
        }else {
            redirect("./verify_code.php?error=Invalid code");
        }
    }
?>
<html>
    <head>
        <title>Verify Code</title>
    </head>
    <body bgcolor="grey">
        <h1>Verify Code</h1>
        <form action="./verify_code.php" method="get">
            <label for="code">Code:</label>
            <input type="text" id="code" name="code"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>