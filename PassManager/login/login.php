<html>
    <head>
        <title>Login</title>
        <?php
            if (isset($_GET['error'])){
                echo $_GET['error']."<br>";
            }
            if(isset($ssl_key)){
                $ssl_key = $_GET['key'];
                $mail_id = $_GET['id'];
                echo "<script>document.location.href='./download.php?key=$ssl_key&id=$mail_id';</script>";
            }
        ?>
    </head>
    <body bgcolor="grey">
       <h1>Login Password Manager</h1>
        <form action="./auth.php" method="post">
            <label for="username">E-mail:</label>
            <input type="email" id="username" name="username"><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Submit">
        </form>
        <a href="../registration/register.php">Non ho un account.</a>
    </body>
</html>