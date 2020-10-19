<?php
    include 'header.php';
?>
    <div class="container">
        <div class="row">
            <h1 style="font-size:940%;font-family:helvetica;font-weight:bold;">Videotiedot</h1>
        </div>
            <div class="row">
                <p>
                    <a href="lisaa_video.php" class="btn btn-success">Create</a>
                </p>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nimi</th>
                                <th>Genre</th>
                                <th>Kesto</th>
                                <th>Kuva</th>
                                <th>Ikäraja</th>
                                <th>napullat</th>
                            </tr>
                        </thead>
                  <tbody>
                    <?php
                            include 'database.php';
                            $pdo = Database::connect();
                            $sql = 'SELECT * FROM video';
                            foreach ($pdo->query($sql) as $row) 
                                {
                                    echo '<tr>';
                                    echo '<td>'. $row['nimi'] . '</td>';
                                    echo '<td>'. $row['genre'] . '</td>';
                                    echo '<td>'. $row['kesto'] . '</td>';
                                    echo '<td>'. $row['kuva'] . '</td>';
                                    echo '<td>'. $row['ikaraja'] . '</td>';echo '<td width=250>';
                                    echo '<a class="btn btn-info" href="katso_video.php?id='.$row['videoID'].'">Kato</a>';
                                    echo ' ';
                                    echo '<a class="btn btn-success" href="paivita_video.php?id='.$row['videoID'].'">Päivitä</a>';
                                    echo ' ';
                                    echo '<a class="btn btn-danger" href="poista_video.php?id='.$row['videoID'].'">Poista</a>';
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