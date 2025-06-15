<script>

    $(document).ready(function(){
        
        $("#myForm").submit(function(event){
            event.preventDefault();

            const pattern = /^[A-Za-z0-9 ]*$/;
            const textarea = document.getElementById('opis');
            if (!pattern.test(textarea.value)) {
                alert("Dozwolone są tylko litery, cyfry i spacje");
                return;
            }

            $.ajax({
						url: "dodaj_towar.php",
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

<table class="table table-info table-hover mt-2" id="myTable">

    <tr><th>Lp.</th><th>Nazwa</th><th>Cena</th><th>Opis</th><th>Operacje</th></tr>

    <?php

        include 'dbconfig.php';
        session_start();

        $conn = new mysqli($host, $user, $psw, $db);
        if ($conn->connect_error) {
            die("Błąd połączenia z BD: " . $conn->connect_error);
        };

        $zapytanie = "SELECT * FROM towary LIMIT 10";

        $result = $conn->query($zapytanie);


        if ($result->num_rows > 0) {

            $licznik=1;

            while($row = $result->fetch_assoc()) {

                echo "<tr><td>".$licznik++."</td><td>".$row["nazwa"]."</td><td>".$row["cena"]." zł"."</td><td>".$row["opis"]."</td>";

                if(isset($_SESSION['administrator'])){
                    if($_SESSION['administrator']!=0){
                        echo "<td><a class='del' href='deltowar.php?id=".$row["id"]."'>usuń</a> | ";
                        echo "<a class='del' href='edittowar.php?id=".$row["id"]."'>edytuj</a></td></tr>";
                    }
                } else {
                    echo "<td>[brak uprawnien]</td></tr>";
                }

            }
        }

        $conn->close();

    ?>

</table>

<h2>Dodawanie towarów:</h2>

<div>
    <form method="post" id="myForm" action="dodaj_towar.php">
        <div class="form-group">
            <label for="nazwa">Nazwa:</label>
            <input type="text" pattern="[A-Ż,a-ż]{1,80}" class="form-control mb-3" id="nazwa" name="nazwa" placeholder="Wpisz nazwe" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="cena">Cena:</label>
            <input type="text" pattern="[0-9]{1,9}" class="form-control mb-3" id="cena" name="cena" placeholder="Wpisz cene" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="opis">Opis:</label>
            <textarea type="text" class="form-control mb-3" id="opis" name="opis" placeholder="Wpisz opis" autocomplete="off"></textarea>
        </div>

        <button type="reset" class="btn btn-primary">Reset</button>
        <button type="submit" class="btn btn-primary">Dodaj</button>
    </form>
</div>