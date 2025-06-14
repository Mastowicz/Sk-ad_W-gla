<table class="table table-info table-hover mt-2" id="myTable">

    <tr><th>Nr_zamówienia</th><th>Klient</th><th>Towar</th><th>Ilość</th></tr>

<?php

    include 'dbconfig.php';

    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    };

    $zapytanie =    "SELECT
                        zamowienia.nr_zamowenia,
                        klienci.nazwisko,
                        towary.nazwa,
                        zamowienia.ilosc
                    FROM zamowienia 
                        JOIN towary ON zamowienia.id_towaru = towary.id
                        JOIN klienci ON zamowienia.id_klienta = klienci.id
                    ORDER BY zamowienia.nr_zamowenia ASC";

    $result = $conn->query($zapytanie);


    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

        echo "<tr><td>".$row["nr_zamowenia"]."</td><td>".$row["nazwisko"]."</td><td>".$row["nazwa"]."</td><td>".$row["ilosc"]." t"."</td>";

        }
    }

    $conn->close();

?>

</table>