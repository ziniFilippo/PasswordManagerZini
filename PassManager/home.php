<?php
    session_start();
    echo "Welcome ".$_SESSION["username"]."<br><br>";
?>
<body>
    <a href="./logout.php">logout</a>
</body>