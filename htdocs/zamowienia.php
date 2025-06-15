<table class="table table-info table-hover mt-2" id="myTable">

    <tr><th>Nr_zamówienia</th><th>Klient</th><th>Towar</th><th>Ilość</th><th>Operacje</th></tr>

<?php

    include 'dbconfig.php';
    session_start();

    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    };

    $zapytanie1 =    "SELECT
                        zamowienia.nr_zamowienia,
                        klienci.nazwisko,
                        towary.nazwa,
                        zamowienia.ilosc
                    FROM zamowienia 
                        JOIN towary ON zamowienia.id_towaru = towary.id
                        JOIN klienci ON zamowienia.id_klienta = klienci.id
                    ORDER BY zamowienia.nr_zamowienia ASC
                    LIMIT 10";

    $result1 = $conn->query($zapytanie1);


    if ($result1->num_rows > 0) {

        while($row = $result1->fetch_assoc()) {

            echo "<tr><td>".$row["nr_zamowienia"]."</td><td>".$row["nazwisko"]."</td><td>".$row["nazwa"]."</td><td>".$row["ilosc"]." t"."</td>";

            if(isset($_SESSION['administrator'])){
                if($_SESSION['administrator']!=0){
                    echo "<td><a class='del' href='delzamowienie.php?nr_zamowienia=".$row["nr_zamowienia"]."'>usuń</a> | ";
                    echo "<a class='del' href='editzamowienie.php?nr_zamowienia=".$row["nr_zamowienia"]."'>edytuj</a></td></tr>";
                }
            } else {
                echo "<td>[brak uprawnien]</td></tr>";
            }

        }
    }

?>

</table>

<?php

    $zapytanie2 = "SELECT id, nazwisko FROM klienci";
    $zapytanie3 = "SELECT id, nazwa FROM towary";

    $result2 = $conn->query($zapytanie2);
    $result3 = $conn->query($zapytanie3);

?>

<div>
    <form method="post" id="myForm" action="dodaj_zamowienie.php">
        <div>
            <label for="klient">Klient:</label>
            <select id="klient" name="klient" class="form-select mb-3">
                
                <?php

                    if ($result2->num_rows > 0) {

                        while ($row = $result2->fetch_assoc()) {

                        echo "<option value='" .$row["id"]. "'>" .$row["nazwisko"]. "</option>";

                        }

                    }

                ?>

            </select>
        </div>
        <div>
            <label for="towar">Towar:</label>
            <select id="towar" name="towar" class="form-select mb-3">
                
                <?php

                    if ($result3->num_rows > 0) {

                        while ($row = $result3->fetch_assoc()) {

                        echo "<option value='" .$row["id"]. "'>" .$row["nazwa"]. "</option>";

                        }

                    }

                ?>

            </select>
        </div>
        <div class="form-group">
            <label for="ilosc">Ilość:</label>
            <input type="text" pattern="[0-9]{1,9}" class="form-control mb-3" id="ilosc" name="ilosc" placeholder="Wpisz cene" autocomplete="off" required>
        </div>

        <button type="reset" class="btn btn-primary">Reset</button>
        <button type="submit" class="btn btn-primary">Dodaj</button>
    </form>
</div>

<?php

    $conn->close();

?>