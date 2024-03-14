<?php
    include "../session/connection.php";

    if (!isset($_SERVER['PATH_INFO'])) {
        // No extra parameters, return all users
        $stmt = $conn->prepare("SELECT * FROM ACCOUNT");
        $stmt->execute();
    } else {
        // There's an extra parameter, return the user with that ID
        $userId = ltrim($_SERVER['PATH_INFO'], '/');  // Remove the leading slash
        $stmt = $conn->prepare("SELECT * FROM ACCOUNT WHERE ID = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
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