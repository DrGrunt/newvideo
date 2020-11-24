<?php
    include 'header.php';
    if(isset($_SESSION["loggedin"]) && ($_SESSION["kayttajaID"]) != 1 && $_SESSION["loggedin"] === false)
    {
        header("location: index.php");
        exit;
    }
?>
    <div class="container">
        <div class="row">
            <h1 style="font-size:940%;font-family:helvetica;font-weight:bold;">PHP CRUD Grid</h1>
        </div>
            <div class="row">
                <p>
                    <a href="lisaa_kayttaja.php" class="btn btn-success">Create</a>
                </p>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nimi</th>
                                <th>Sähköposti</th>
                                <th>Puhelinnumero</th>
                                <th>Postitoimipaikka</th>
                                <th>napullat</th>
                            </tr>
                        </thead>
                  <tbody>
                    <?php
                            include 'database.php';
                            $pdo = Database::connect();
                            $sql = 'SELECT *, CONCAT(etunimi, " ", sukunimi) nimi FROM asiakas';
                            foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['nimi'] . '</td>';
                                echo '<td>'. $row['sahkoposti'] . '</td>';
                                echo '<td>'. $row['puhelin'] . '</td>';
                                echo '<td>'. $row['postitoimipaikka'] . '</td>';echo '<td width=250>';
                                echo '<a class="btn btn-info" href="read.php?id='.$row['asiakasID'].'">Tarkista</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="paivita_asiakas.php?id='.$row['asiakasID'].'">Päivitä</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="poista_asiakas.php?id='.$row['asiakasID'].'">Poista</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            Database::disconnect();
                        ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
    
    <?php
        include 'footer.php'
    ?>
     </body>
</html>