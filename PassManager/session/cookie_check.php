<?php
        if (isset($_COOKIE['pm_sess'])) {
            $sess = $_COOKIE['pm_sess'];
            $stmt = $conn->prepare("SELECT * FROM SESSIONE WHERE ID_SESSIONE = ?");
            $stmt->bind_param("s", $sess);
            $stmt->execute();
            $result = $stmt->get_result();
            $session = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                $timeout = $session['TIMEOUT'];
                $timeout = strtotime($timeout);
                $now = strtotime(date("Y-m-d H:i:s"));
                if ($now > $timeout) {
                    header("Location: ./logout.php");
                    exit;
                }
            } else {
                header("Location: ./logout.php");
                exit;
            }
        } else {
            header("Location: ./login/login.php");
            exit;
        }
        $user_id = $session['ACCOUNT_ID'];
?>