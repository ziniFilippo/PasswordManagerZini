<?php
    include "../session/connection.php";
    $stmt = $conn->prepare("SELECT * FROM VERIFICA");
    $stmt->execute();
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