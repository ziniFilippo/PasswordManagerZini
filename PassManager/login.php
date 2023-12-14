<html>
    <head>
        <title>Login</title>
        <?php
            if (isset($_GET['error'])){
                echo "Username e/o password errata";
            }
        ?>
    </head>
    <body bgcolor="grey">
       <h1>Login Password Manager</h1>
        <form action="./auth.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"><br><br>
            <label for="password">Password:</label>
            <input type="text" id="password" name="password"><br><br>
            <input type="submit" value="Submit">
        </form>
        <a href="./register.php">Non ho un account.</a>
    </body>
</html>