<html>
<head>
    <title>View Passwords</title>
<style>
    body {
        justify-content: center;
        align-items: center;
        background-color: #343a40;
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
</head>
<body>
<script> 
    async function verificaPassword(password) {
        
        // Simuliamo una richiesta all'API (sostituisci l'URL con quello effettivo dell'API)
        const url = '../api/api_ver_master.php';
        const requestOptions = {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ password })
        };
    
        try {
            const response = await fetch(url, requestOptions);
            const data = await response.json();
            
            // Verifica la risposta dell'API
            if (response.ok && data.result === 200) {
               return true;
            } else {
                throw new Error('Errore nella verifica della password');
            }
        } catch (error) {
            console.error('Errore:', error);
            return false; // Segnala un errore
        }
    } 
</script>
<?php
    include "../session/connection.php";
    include "../session/cookie_check.php";

    echo 
    "<script>
        //var input = prompt('inserisci la master password');
        //if(verificaPassword(input)){
        //}
    </script>";
    $stmt = $conn->prepare("SELECT DATA,SITO,MAIL FROM CREDENZIALE WHERE ACCOUNT_ID = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_password_update = new DateTime($row['DATA']);
        $current_date = new DateTime();
        $sito = $row['SITO'];
        $mail = $row['MAIL'];

        $interval = $last_password_update->diff($current_date);
        if ($interval->m >= 1) {
            echo "<script>alert('È passato un mese dall'ultimo aggiornamento della tua password. Per favore, aggiorna la tua password.(sito:[".$sito."];mail:[".$mail."]'));</script>";
        }
    }
?>

<script>
        function remove(id){
            let choice = confirm("Are you sure you want to delete this password?");
            console.log("eliminata"+id);
            if (choice == true){
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "../api/api_delete_password.php?id=" + id, true);
                xhr.onload = function() {
                    search(document.getElementById('search').value);
                }
                xhr.send();
            }
            return;
        }
        function edit(id){
            window.location.href = "./edit_password.php?id=" + id;
        }
        function search(query) {
            console.log(query);
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../api/api_search.php?search=" + query);
            xhr.onload = function() {
                const data = JSON.parse(xhr.responseText);
                var results = document.getElementById('results');
                results.innerHTML = "";

                if (data.hasOwnProperty('error')){
                    results.innerHTML = "<br>"+data['error'];
                    return;
                }

                var table = document.createElement('table');
                var headerRow = document.createElement('tr');
                ['URL', 'MAIL', 'PASSWORD', 'DATA', 'EDIT', 'DELETE'].forEach(function(header) {
                    var th = document.createElement('th');
                    th.textContent = header;
                    headerRow.appendChild(th);
                });
                table.appendChild(headerRow);

                for (var i = 0; i < data.length; i++) {
                    var row = document.createElement('tr');
                    var td = document.createElement('td');
                    var a = document.createElement('a')
                    a.href = data[i]['SITO'];
                    a.textContent = data[i]['SITO'];
                    td.appendChild(a);
                    row.appendChild(td);
                    ['MAIL', 'PASSWORD', 'DATA'].forEach(function(field) {
                        var td = document.createElement('td');
                        td.textContent = data[i][field];
                        row.appendChild(td);
                    });
                    var pass_id = data[i]['ID'];
                    console.log(pass_id);
                    var editButton = document.createElement('button');
                    editButton.textContent = 'edit';
                    editButton.onclick = function() { edit(pass_id); };
                    var editCell = document.createElement('td');
                    editCell.appendChild(editButton);
                    row.appendChild(editCell);

                    var deleteButton = document.createElement('button');
                    deleteButton.textContent = 'delete';
                    deleteButton.id = pass_id;
                    deleteButton.addEventListener('click', function(){
                        remove(this.getAttribute("id"));
                    });
                    var deleteCell = document.createElement('td');
                    deleteCell.appendChild(deleteButton);
                    row.appendChild(deleteCell);

                    table.appendChild(row);
                }

                results.appendChild(table);
}
                xhr.send();
            }
            onload = function() {
                search("");
            }
    </script>
    <h1>Your Passwords</h1>
    <input type="text" id="search"/>
    <button onclick="search(document.getElementById('search').value)">Search</button>
    
    <div id="results"></div>
<br><br>
<a href="./add_password.php" class = "link">add password</a>
<br><br>
<a href="../home.php" class="link">home</a>
</body>
</html>