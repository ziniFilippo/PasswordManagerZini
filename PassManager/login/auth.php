<?php
    include "../session/connection.php";

    function redirect($url){
        header("Location: ".$url);
        exit();
    }

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
                $sess = bin2hex(random_bytes(25));
                setcookie("pm_sess",$sess, time() + 3600, "/");
                $data = mktime(date('H')+3,date('i'),date('s'),date('m'),date('d'),date('Y'));
                $timeout = date('Y-m-d H:i:s',$data);
                $time = date("Y-m-d H:i:s"); 
                $user_id = $user['ID'];	
                $qry = $conn->prepare("INSERT INTO SESSIONE(ID_SESSIONE,ACCOUNT_ID,DATA_INIZIO,TIMEOUT) VALUES (?,?,?,?)");
                $qry->bind_param("ssss",$sess,$user_id,$time,$timeout);
                $qry->execute();
                redirect("../home.php");
            } else {
                redirect("./login.php?error=Invalid password");
            }
        } else {
            redirect("./login.php?error=Invalid or non-existent e-mail");
        }
    } else {
        redirect("./login.php");
    }
?>