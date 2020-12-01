<?php
    include 'header.php';
?>
    <div class="container">
        <div class="row">
            <h1 style="font-size:500    %;font-family:helvetica;font-weight:bold;">MYYNNISSÄ</h1>
        </div>
            <div class="row">
                <p>
                    <a href="lisaa_tuote.php" class="btn btn-success">Listaa tuote</a>
                </p>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                                <th>Kuva</th>
                                <th>Nimi/Hinta</th>
                                <th>Lisätiedot</th>
                                <th>napullat</th>
                        </tr>
                        </thead>
                  <tbody>
                    <?php
                            include 'database.php';
                            $pdo = Database::connect();
                            $sql = 'SELECT * FROM tuote';
                            foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. "<img src='img/{$row['kuva']}' width='100' height='100'>" . '</td>';
                                echo '<td>';
                                echo '<h3>'. $row['tuotenimi'] .'</h3>';
                                echo '<h6>'. $row['hinta'] . "€" . '</h6>';
                                echo '</td>';
                                echo '<td>'. $row['lisatiedot'] . '</td>';
                                echo '<td>';
                                echo '<a class="btn btn-info" href="katso_tuote.php?id='.$row['tuoteID'].'">Katso lisää</a>';
                                echo '</td>';
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
