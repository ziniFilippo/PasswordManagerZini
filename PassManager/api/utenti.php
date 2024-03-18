<?php
    include "../session/connection.php";

    if (!isset($_SERVER['PATH_INFO'])) {
        $stmt = $conn->prepare("SELECT * FROM ACCOUNT");
        $stmt->execute();
    } else {
        $userId = ltrim($_SERVER['PATH_INFO'], '/');
        $passwords = substr($userId,2);
        $passId = substr($userId, 12);
        if(is_numeric($userId)){
            $stmt = $conn->prepare("SELECT * FROM ACCOUNT WHERE ID = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            
        } else if ( $passwords=='passwords'){
            $qry = "SELECT * FROM CREDENZIALE WHERE ACCOUNT_ID = ?";
                $stmt = $conn->prepare($qry);
                $stmt->bind_param("i", $userId);
                $stmt->execute();
        } else if ($passId != ""){
            $qry = "SELECT * FROM CREDENZIALE WHERE ACCOUNT_ID = ? AND ID = ?";
            $stmt = $conn->prepare($qry);
            $stmt->bind_param("ii", $userId, $passId);
            $stmt->execute();
        }
    }

    $result = $stmt->get_result();
    $data = array();
    $data[0] = array("length" => $result->num_rows);
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        $data[$i] = $row;
        $i++;
    }
    if (count($data) == 0){
        $data = array("error" => "No results found");
    }
    header('Content-Type: application/json');
    echo json_encode($data);
?>