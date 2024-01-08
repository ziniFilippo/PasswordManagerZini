<?php
    session_start();
    echo "Welcome ".$_SESSION["username"]."<br><br>";
?>
<body>
    <a href="./logout.php">logout</a>
    <br>
    <a href="./change_password.php">change password</a>
    <br>
    <a href="./delete_account.php">delete account</a>
    <br>
    <a href="./view_password.php">view password</a>
</body>