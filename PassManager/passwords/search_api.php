<?php
    include "../session/connection.php";
    include "../session/cookie_check.php";
    $id = $user_id;
    if (isset($_GET['search'])){
        $search = $_GET['search'];
        $stmt = $conn->prepare("SELECT * FROM CREDENZIALE WHERE ACCOUNT_ID = ? AND (SITO LIKE ? OR MAIL LIKE ?)");
        $search = "%".$search."%";
        $stmt->bind_param("sss", $id, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
    } else if (!isset($_GET['search']) || $_GET['search'] == ""){
        $stmt = $conn->prepare("SELECT * FROM CREDENZIALE WHERE ACCOUNT_ID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    }

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    if (count($data) == 0){
        $data[] = array("SITO" => "No results found", "MAIL" => "", "PASSWORD" => "", "DATA" => "");
    }
    header('Content-Type: application/json');
    echo json_encode($data);
?>