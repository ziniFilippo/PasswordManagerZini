<html>
    <head>
        <title>Register</title>
        <?php
            if (isset($_GET['error'])){
                echo $_GET['error']."<br>";
            }
        ?>  
    </head>
    <body bgcolor="grey">
       <h1>Registration Password Manager</h1>
        <form action="./pre_register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"><br><br>
            <label for="password">Password:</label>
            <input type="text" id="password" name="password"><br><br>
            <input type="submit" value="Submit">
        </form>
        <a href="./login.php">Ho già un account.</a>
    </body>
</html>