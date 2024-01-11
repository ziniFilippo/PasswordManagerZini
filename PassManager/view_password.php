<html>
<style>
    body {
        justify-content: center;
        align-items: center;
        background-color: #343a40;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='28' height='49' viewBox='0 0 28 49'%3E%3Cg fill-rule='evenodd'%3E%3Cg id='hexagons' fill='%239C92AC' fill-opacity='0.25' fill-rule='nonzero'%3E%3Cpath d='M13.99 9.25l13 7.5v15l-13 7.5L1 31.75v-15l12.99-7.5zM3 17.9v12.7l10.99 6.34 11-6.35V17.9l-11-6.34L3 17.9zM0 15l12.98-7.5V0h-2v6.35L0 12.69v2.3zm0 18.5L12.98 41v8h-2v-6.85L0 35.81v-2.3zM15 0v7.5L27.99 15H28v-2.31h-.01L17 6.35V0h-2zm0 49v-8l12.99-7.5H28v2.31h-.01L17 42.15V49h-2z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"), linear-gradient(to right top, #343a40, #2b2c31, #211f22, #151314, #000000);
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
    include "connection.php";
    include "cookie_check.php";
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
        echo "<a href='./home.php' class = 'link'>home</a>";
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
<a href="./home.php" class="link">home</a>
</html>