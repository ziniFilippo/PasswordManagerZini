<?php
    include "../session/connection.php";
    $stmt = $conn->prepare("SELECT * FROM CREDENZIALE");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    $data[0] = array("length" => $result->num_rows);
    while ($row = $result->fetch_assoc()) {
        $data[1] = $row;
    }
    if (count($data) == 0){
        $data = array("error" => "No results found");
    }
    header('Content-Type: application/json');
    echo json_encode($data);
?>