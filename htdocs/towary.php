<table class="table table-info table-hover mt-2" id="myTable">

    <tr><th>Lp.</th><th>Nazwa</th><th>Cena</th><th>Opis</th></tr>

<?php

    include 'dbconfig.php';

    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    };

    $zapytanie = "SELECT * FROM towary";

    $result = $conn->query($zapytanie);


    if ($result->num_rows > 0) {

        $licznik=1;

        while($row = $result->fetch_assoc()) {

        echo "<tr><td>".$licznik++."</td><td>".$row["nazwa"]."</td><td>".$row["cena"]." zł"."</td><td>".$row["opis"]."</td>";

        }
    }

    $conn->close();

?>

</table>