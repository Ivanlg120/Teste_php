<?php
// Conexão
require_once 'db_connect.php';
echo "teste <br>";
$sql = "SELECT * FROM filme, diretor where filme.Filme_iddiretor=diretor.iddiretor";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        print_r($row);
        //echo $row['Filme_Nome'];
        echo "<br>";
    }
} else {
    echo "0 results";
}

echo "teste2 <br>";
