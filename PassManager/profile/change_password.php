<html>
    <head>
        <title>Change Password</title>
        <?php
            if (isset($_GET['error'])){
                echo $_GET['error']."<br>";
            }
        ?>
    </head>
    <body bgcolor="grey">
       <h1>Change Your Master Password</h1>
        <form action="./change.php" method="post">
            <label for="old_password">Old Password:</label>
            <input type="password" id="old_password" name="old_password"><br><br>
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password"><br><br>
            <label for="new_password">Confirm New Password:</label>
            <input type="password" id="confirm_new_password" name="confirm_new_password"><br><br>
            <input type="submit" value="Submit">
        </form>
        <a href="./profile.php">cancel</a>
    </body>
</html>