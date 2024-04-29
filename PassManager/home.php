<?php
    include "./session/connection.php";
    include "./session/cookie_check.php";
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
    <a href="./out.php">logout</a>
    <br>
    <a href="./passwords/view_password.php">view passwords</a>
    <br>
    <a href="./profile/profile.php">view profile</a>
</body>