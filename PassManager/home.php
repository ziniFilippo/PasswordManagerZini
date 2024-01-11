<?php
    include "connection.php";
    include "cookie_check.php";
    $stmt = $conn->prepare("SELECT * FROM ACCOUNT WHERE ID = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $mail = $user['MAIL'];
    echo "Welcome ".$mail."<br>";
?>
<body>
    <br>
    <a href="./logout.php">logout</a>
    <br>
    <a href="./view_password.php">view passwords</a>
    <br>
    <a href="./profile.php">view profile</a>
</body>