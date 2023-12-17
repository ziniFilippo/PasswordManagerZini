<?php
    include "connection.php";
    function redirect($url){
        header("Location: ".$url);
        exit();
    }
    $mail_id = $_GET['mail_id'];
    if (!isset($mail_id)){
        redirect("./register.php");
    }
    if(!isset($_POST['code'])){
        $code = random_int(100000, 999999);
        $stmt = $conn->prepare("UPDATE VERIFICA  SET TOKEN_AUTH = ? WHERE ID = ?");
        $stmt->bind_param("ss", $code, $mail_id);
        $stmt->execute();
        error_log($code);
    } else {
        $code = $_POST['code'];
        $validate = $conn->prepare("SELECT * FROM VERIFICA WHERE TOKEN_AUTH = ?");
        $validate->bind_param("s", $code);
        $validate->execute();
        $result = $validate->get_result();
        if ($result->num_rows > 0) {
            //raccolgo i dati
                $fetch = $result->fetch_assoc();
                $datetime = $fetch['data_richiesta'];
                $salt = $fetch['salt'];
                $password = $fetch['sha3'];
                $mail = $fetch['mail'];
            //inserisco i dati
            $stmt = $conn->prepare("INSERT INTO ACCOUNT (id,mail, sha3, salt, data_registrazione) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $mail_id, $mail, $password, $salt, $datetime);
            $stmt->execute();
            //elimino i dati
            $delete = $conn->prepare("DELETE FROM VERIFICA WHERE codice = ?");
            $delete->bind_param("s", $code);
            $delete->execute();
            redirect("./login.php");    
        } else {
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
        <form action="./verify_code.php" method="post">
            <label for="code">Code:</label>
            <input type="text" id="code" name="code"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>