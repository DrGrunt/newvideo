<?php

    include 'header.php';
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $table = 'kayttaja';
        $sql = "SELECT *, CONCAT(etunimi, ' ', sukunimi) nimi FROM kayttaja where kayttajaID = ?";
        $pdo->exec("set names utf8");
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <title>OHI</title>
  </head>

<body style="background-color:#90fff8;">
    <div class="container">
     
                <div class="row">

                        <div class="form-group collum">
                            <label for="kayttajatunnus" class="col-sm-2 col-form-label">Käyttäjätunnus</label>
                            <div class="col-sm-10">
                                <input name="kayttajatunnus" readonly type="text" placeholder="kayttajatunnus" value="<?php echo $data['kayttajatunnus']; ?>">
                            </div>
                        </div>

                        <div class="form-group collum">
                            <label for="nimi" class="col-sm-2 col-form-label">Nimi</label>
                            <div class="col-sm-10">
                                <input name="nimi" readonly type="text" placeholder="nimi" value="<?php echo $data['nimi']; ?>">
                            </div>
                        </div>

                        <div class="form-group collum">
                            <label for="postitoimipaikka" class="col-sm-2 col-form-label">Postitoimipaikka</label>
                            <div class="col-sm-10">
                                <input name="postitoimipaikka" readonly type="text" placeholder="postitoimipaikka" value="<?php echo $data['postitoimipaikka']; ?>">
                            </div>
                        </div>

                        <div class="form-group collum">
                            <label for="sahkoposti" class="col-sm-2 col-form-label">Sähköposti</label>
                            <div class="col-sm-10">
                                <input name="sahkoposti" readonly type="text" placeholder="sahkoposti" value="<?php echo $data['sahkoposti']; ?>">
                            </div>
                        </div>

                        <div class="form-group collum">
                            <label for="puhelin" class="col-sm-2 col-form-label">Puhelinnumero</label>
                            <div class="col-sm-10">
                                <input name="puhelin" readonly type="text" placeholder="puhelin" value="<?php echo $data['puhelinnumero']; ?>">
                            </div>
                        </div>
                        </div>
                        <div class="form-actions">
                            <a class="btn btn-warning" href="index.php">Etusivu</a>
                        </div>
                        <div class="row">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Kuva</th>
                                <th>Nimi/Hinta</th>
                                <th>Lisätiedot</th>
                                <th>NA Pullaa</th>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                                        $pdo = Database::connect();
                                        $sql = 'SELECT * FROM tuote WHERE kayttajaID =' . $data["kayttajaID"] . '';
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
                                            echo ' ';
                                            if ($_SESSION['kayttajaID'] == $data['kayttajaID'])
                                                {
                                                    echo '<a class="btn btn-info" href="paivita_tuote.php?id=' . $row['tuoteID'] . '">Muokkaa</a>';
                                                    echo ' ';
                                                    echo '<a class="btn btn-danger poista" data-content="Haluatko varmasti poistaa tuotteen ' . $row['tuotenimi'] . ' ?" href="poista_tuote.php?id='.$row['tuoteID'].'">Poista</a>';
                                                }
                                            echo '</td>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                        Database::disconnect();
                                    ?>
                            </tbody>
                    </table>
                </div>
            </div>
                 
    </div> <!-- /container -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>