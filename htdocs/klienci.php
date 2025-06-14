<table class="table table-info table-hover mt-2 mb-5" id="myTable">

    <tr><th>Lp.</th><th>Imie</th><th>Nazwisko</th><th>Nr_tel</th></tr>

<?php

    include 'dbconfig.php';

    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    };

    $zapytanie = "SELECT * FROM klienci";

    $result = $conn->query($zapytanie);


    if ($result->num_rows > 0) {

        $licznik=1;

        while($row = $result->fetch_assoc()) {

        echo "<tr><td>".$licznik++."</td><td>".$row["imie"]."</td><td>".$row["nazwisko"]."</td><td>".$row["nr_tel"]."</td>";

        }
    }

    $conn->close();

?>

</table>

<h2>Dodawanie klienta:</h2>

<div>
    <form method="post" id="myForm" action="dodaj_klienta.php">
        <div class="form-group">
            <label for="imie">Imie:</label>
            <input type="text" pattern="[A-Ż,a-ż]{1,80}" class="form-control" id="imie" name="imie" placeholder="Wpisz imię" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="nazwisko">Nazwisko:</label>
            <input type="text" pattern="[A-Ż,a-ż]{1,80}" class="form-control" id="nazwisko" name="nazwisko" placeholder="Wpisz nazwisko" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="nr_tel">Nr_tel:</label>
            <input type="text" pattern="[0-9]{9}" class="form-control" id="nr_tel" name="nr_tel" placeholder="Wpisz numer telefonu" autocomplete="off" required>
        </div>

        <button type="submit" class="btn btn-primary">Dodaj</button>
    </form>
</div>
