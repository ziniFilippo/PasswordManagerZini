<?php
    session_start();
    echo "Welcome ".$_SESSION["user"]."<br><br>";
?>
<body>
    <a href="/">logout</a>
</body>