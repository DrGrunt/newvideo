<?php

    include 'header.php';
    require 'database.php';
    $tuoteID = null;
    $tekijaID = null;
    if ( !empty($_GET['id'])) {
        $tuoteID = $_REQUEST['id'];
    }
     
    if ( null==$tuoteID ) {
        header("Location: tuotelista.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $table = 'tuote';
        $sql = "SELECT * FROM tuote where tuoteID = ?";
        $pdo->exec("set names utf8");
        $q = $pdo->prepare($sql);
        $q->execute(array($tuoteID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        echo "<h2>{$data['tuotenimi']}</h2>";
        echo "<img src='img/{$data['kuva']}'width='300' height='300' >";
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
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>tuote tiedot</h3>
                    </div>

                    
                    <div class="form-horizontal" >


                        <div class="form-group row">
                            <label for="lisatiedot" class="col-sm-2 col-form-label">Lisätiedot</label>
                            <div class="col-sm-10">
                            <textarea readonly name="lisatiedot" cols="23" rows="5"><?php echo $data['lisatiedot']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hinta" class="col-sm-2 col-form-label">Hinta</label>
                            <div class="col-sm-10">
                            <input name="hinta" readonly type="text" placeholder="hinta" value="<?php echo $data['hinta']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kayttaja" class="col-sm-2 col-form-label">Luoja</label>
                            <div class="col-sm-10">
                                <input name="kayttaja" readonly type="text" placeholder="kayttaja" value="<?php print $data['kayttajaID']; ?>">
                            </div>
                        </div>
                        <?php
                        $kayttajaID = $data['kayttajaID'];
                            $pdo = Database::connect();
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $table = 'kayttaja';
                            $sql = "SELECT * FROM kayttaja where kayttajaID = ?";
                            $pdo->exec("set names utf8");
                            $q = $pdo->prepare($sql);
                            $q->execute(array($kayttajaID));
                            $data = $q->fetch(PDO::FETCH_ASSOC);
                            Database::disconnect();
                        ?>
                        <div class="form-group row">
                            <label for="etunimi" class="col-sm-2 col-form-label">Tekijän etunimi</label>
                            <div class="col-sm-10">
                                <input name="etunimi" readonly type="text" placeholder="etunimi" value="<?php echo $data['etunimi']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sahkoposti" class="col-sm-2 col-form-label">Tekijän sähköposti</label>
                            <div class="col-sm-10">
                                <input name="sahkoposti" readonly type="text" placeholder="sahkoposti" value="<?php echo $data['sahkoposti']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postitoimipaikka" class="col-sm-2 col-form-label">Tekijän paikkakunta</label>
                            <div class="col-sm-10">
                                <input name="postitoimipaikka" readonly type="text" placeholder="postitoimipaikka" value="<?php echo $data['postitoimipaikka']; ?>">
                            </div>
                        </div>

                        <div class="form-actions">
                            <a class="btn btn-warning" href="tuotelista.php">Takas</a>
                        </div>
                        </div>
                    </div>
                </div>
                 
    </div> <!-- /container -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>