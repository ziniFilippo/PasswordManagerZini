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
    $data[0] = array("length" => $result->num_rows);
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $data[$i] = $row;
        $i++;
    }
    if (count($data) == 0){
        $data = array("error" => "No results found");
    }
    header('Content-Type: application/json');
    echo json_encode($data);