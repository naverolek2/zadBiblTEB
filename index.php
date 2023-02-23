<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka TEB</title>
</head>
<body>                                  
                                        <!-- Zamienia to np $, #, @ na interpretacje HTML'ową  -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="search">Search for books:</label>
    <input type="text" name="search" id="search">
    <input type="submit" value="Search"><br>
    <?php 
        $conn = new mysqli('localhost', 'root', '', 'bibiliotekateb');
        if(!$conn) {
            die("Połączenie nie powiodło się");
        }
        else {
            // ta linijka zapobiega wywalaniu wszystkich książek na starcie
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // search to nazwa inputu powyżej.
            $searchTerm = $_POST["search"];
            $sql = "SELECT * FROM ksiazki WHERE tytul LIKE '%$searchTerm%'";
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) > 0) {
                // to po to żeby wszystkie książki co pasują wyświetlić, bo bez tego wyświetla się tylko jedna
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "ID: " . $row["id"] . "<br>";
                    echo "Tytuł: " . $row["tytul"] . "<br>";
                    echo "Autor: " . $row["autor"] . "<br>";
                    echo "Rok publikacji: " . $row["rok_publikacji"] . "<br>";
                    echo "<br>";
                }

            }
            else {
                echo "Nie znaleziono książek.";
            }
            }
        }

        $conn->close();
    ?>
    
</form>

</body>
</html>