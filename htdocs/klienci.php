<script>
    $(document).ready(function(){
        
        $("#myForm").submit(function(event){
            event.preventDefault();
            $.ajax({
						url: "dodaj_klienta.php",
						type: "POST",
						data: $("#myForm").serialize(),
						cache: false,
						success: function (response) {
							$("#myTable").append(response);
                            console.log(response);
                        }
						});

        });

    });

</script>

<table class="table table-info table-hover mt-2 mb-5" id="myTable">

    <tr><th>Lp.</th><th>Imie</th><th>Nazwisko</th><th>Nr_tel</th><th>Operacje</th></tr>

<?php

    include 'dbconfig.php';
    session_start();

    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    };

    $zapytanie = "SELECT * FROM klienci LIMIT 10";

    $result = $conn->query($zapytanie);


    if ($result->num_rows > 0) {

        $licznik=1;

        while($row = $result->fetch_assoc()) {

                echo "<tr><td>".$licznik++."</td><td>".$row["imie"]."</td><td>".$row["nazwisko"]."</td><td>".$row["nr_tel"]."</td>";
            if(isset($_SESSION['administrator'])){
                if($_SESSION['administrator']!=0){
                    echo "<td><a class='del' href='delklient.php?id=".$row["id"]."'>usuń</a> | ";
                    echo "<a class='del' href='editklient.php?id=".$row["id"]."'>edytuj</a></td></tr>";
                }
            } else {
                echo "<td>[brak uprawnien]</td></tr>";
            }
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
            <input type="text" pattern="[A-Ż,a-ż]{1,80}" class="form-control mb-3" id="imie" name="imie" placeholder="Wpisz imię" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="nazwisko">Nazwisko:</label>
            <input type="text" pattern="[A-Ż,a-ż]{1,80}" class="form-control mb-3" id="nazwisko" name="nazwisko" placeholder="Wpisz nazwisko" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="nr_tel">Numer telefonu:</label>
            <input type="text" pattern="[0-9]{9}" class="form-control mb-3" id="nr_tel" name="nr_tel" placeholder="Wpisz numer telefonu" autocomplete="off" required>
        </div>

        <button type="reset" class="btn btn-primary">Reset</button>
        <button type="submit" class="btn btn-primary">Dodaj</button>
    </form>
</div>
