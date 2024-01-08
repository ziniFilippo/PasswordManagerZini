<?php
    session_start();
    include "connection.php";
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT * FROM ACCOUNT WHERE MAIL = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $id = $user['ID'];
    $stmt = $conn->prepare("SELECT * FROM CREDENZIALE WHERE ACCOUNT_ID = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>URL</th>";
        echo "<th>USERNAME</th>";
        echo "<th>PASSWORD</th>";
        echo "<th>DATA</th>";
        echo "</tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['SITO']."</td>";
            echo "<td>".$row['MAIL']."</td>";
            echo "<td>".$row['PASSWORD']."</td>";
            echo "<td>".$row['DATA']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No password found";
    }
?>
<br>
<a href="./add_password.php">add password</a>