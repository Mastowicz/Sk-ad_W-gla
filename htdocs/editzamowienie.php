<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/bin/bootstrap.min.css">
        <script src="/bin/popper.min.js"></script>
        <script src="/bin/bootstrap.bundle.min.js"></script>
        <script src="/bin/jquery.min.js"></script>
        <link rel="stylesheet" href="/css/style.css">
    <title>Skład Węgla</title>
</head>

<?php

    include 'dbconfig.php';

    $id = $_GET['nr_zamowienia'];

    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    }

    $zapytanie = "SELECT
                    klienci.nazwisko,
                    towary.nazwa,
                    zamowienia.ilosc,
                    zamowienia.id_klienta,
                    zamowienia.id_towaru,
                    zamowienia.nr_zamowienia
                FROM
                    zamowienia
                JOIN klienci ON zamowienia.id_klienta = klienci.id 
                JOIN towary ON zamowienia.id_towaru = towary.id 
                WHERE `zamowienia`.`nr_zamowienia` = $id LIMIT 1;";
                
    $result = $conn->query($zapytanie);

            if ($result->num_rows > 0) {
            
                while ($row1 = $result->fetch_assoc()) {

    $zapytanie2 = "SELECT id AS klient, nazwisko FROM klienci";
    $zapytanie3 = "SELECT id AS towar, nazwa FROM towary";

    $result2 = $conn->query($zapytanie2);
    $result3 = $conn->query($zapytanie3);

?>

<div>
    <form method="post" id="myForm" action="zapisz_dodaj_zamowienie.php">
        <div>
            <input type="text" name="nr_zamowienia" value="<?php echo $row1['nr_zamowienia'];?>" hidden>
            <label for="klient">Klient:</label>
            <select id="klient" name="klient" class="form-select mb-3">
                
                <?php

                    if ($result2->num_rows > 0) {

                        while ($row = $result2->fetch_assoc()) {

                        echo "<option value='" .$row["klient"]. "' ";
                        if ($row1["id_klienta"] == $row["klient"]) echo 'selected';
                        echo ">" .$row["nazwisko"]. "</option>";

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

                        echo "<option value='" .$row["towar"]. "' ";
                        if ($row1["id_towaru"] == $row["towar"]) echo 'selected';
                        echo ">" .$row["nazwa"]. "</option>";

                        }

                    }

                ?>

            </select>
        </div>
        <div class="form-group">
            <label for="ilosc">Ilość:</label>
            <input type="text" pattern="[0-9]{1,9}" class="form-control mb-3" id="ilosc" name="ilosc" value="<?php echo $row1['ilosc'];?>" autocomplete="off" required>
        </div>

        <button type="reset" class="btn btn-primary">Reset</button>
        <button type="submit" class="btn btn-primary">Popraw</button>
    </form>
</div>

<?php

            }
        } else {
            echo "0 results";
        }

        $conn->close();
?>