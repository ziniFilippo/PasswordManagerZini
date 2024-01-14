<body>
    <?php
        include "../session/connection.php";
        include "../session/cookie_check.php";
        $qry = "SELECT * FROM ACCOUNT WHERE ACCOUNT.ID = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $user_mail = $user['MAIL'];
        if (isset($_GET['error'])){
            echo $_GET['error']."<br>";
        }
    ?>
    <h1>Profile</h1>
    <div>
        <p>Your E-Mail: <?php  echo $user_mail; ?></p>
    </div>
    <a href="./change_password.php">change password</a>
    <br>
    <a href="./delete_account.php">delete account</a>
    <br>
    <a href="../home.php">home</a>
</body>