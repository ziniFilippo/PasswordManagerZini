<html>
<style>
    body {
        justify-content: center;
        align-items: center;
        background-color: #343a40;
        linear-gradient(to right top, #343a40, #2b2c31, #211f22, #151314, #000000);
    }
 
    h1 {
        margin: 20px;
        color: #ffffff;
    }
    a.link,p {
        color: #ffffff;
    }
    table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
    tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }
    th,td {
        padding: 12px 15px;
        border-bottom: 1px solid #dddddd;
    }
</style>
<?php
    include "../session/connection.php";
    include "../session/cookie_check.php";
    $id = $user_id;
    if (isset($_GET['search'])){
        $search = $_GET['search'];
        $stmt = $conn->prepare("SELECT * FROM CREDENZIALE WHERE ACCOUNT_ID = ? AND (SITO LIKE ? OR MAIL LIKE ?)");
        $search = "%".$search."%";
        $stmt->bind_param("sss", $id, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<h1>Your Passwords</h1>";
        echo '<input type="text" id="search" name="search" placeholder="Search a password..."> <button onclick="search()">Search</button> <br><br>';
        echo '<script>
                function search(){
                    var search = document.getElementById("search").value;
                    window.location.href = "./view_password.php?search="+search;
                }
            </script>';
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>URL</th>";
            echo "<th>MAIL</th>";
            echo "<th>PASSWORD</th>";
            echo "<th>DATA</th>";
            echo "<th>EDIT</th>";
            echo "<th>DELETE</th>";
            echo "</tr>";
            while($row = $result->fetch_assoc()) {
                echo "<td>".$row['SITO']."</td>";
                echo "<td>".$row['MAIL']."</td>";
                echo "<td>".$row['PASSWORD']."</td>";
                echo "<td>".$row['DATA']."</td>";
                echo "<td><a href='./edit_password.php?id=".$row['ID']."'>edit</a></td>";
                echo "<td><a href='./delete_password.php?id=".$row['ID']."'>delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No passwords found</p>";
        }
        echo "<br><br>";
        echo "<a href='./add_password.php' class = 'link'>add password</a>";
        echo "<br><br>";
        echo '<a href="./view_password.php" class = "link">view all passwords</a>';
        echo "<br><br>";
        echo "<a href='../home.php' class = 'link'>home</a>";
        exit();
    } else if (!isset($_GET['search']) || $_GET['search'] == ""){
        $stmt = $conn->prepare("SELECT * FROM CREDENZIALE WHERE ACCOUNT_ID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<h1>Your Passwords</h1>";
        echo '<input type="text" id="search" name="search" placeholder="Search a password..."> <button onclick="search()">Search</button> <br><br>';
        echo '<script>
                function search(){
                    var search = document.getElementById("search").value;
                    window.location.href = "./view_password.php?search="+search;
                }
            </script>';
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>URL</th>";
            echo "<th>MAIL</th>";
            echo "<th>PASSWORD</th>";
            echo "<th>DATA</th>";
            echo "<th>EDIT</th>";
            echo "<th>DELETE</th>";
            echo "</tr>";
            while($row = $result->fetch_assoc()) {
                echo "<td>".$row['SITO']."</td>";
                echo "<td>".$row['MAIL']."</td>";
                echo "<td>".$row['PASSWORD']."</td>";
                echo "<td>".$row['DATA']."</td>";
                echo "<td><a href='./edit_password.php?id=".$row['ID']."'>edit</a></td>";
                echo "<td><a href='./delete_password.php?id=".$row['ID']."'>delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No passwords found</p>";
        }
    }
?>
<br><br>
<a href="./add_password.php" class = "link">add password</a>
<br><br>
<a href="./view_password.php" class = "link">view all passwords</a>
<br><br>
<a href="../home.php" class="link">home</a>
</html>