<?php

    include 'header.php';
    require 'database.php';
    $videoID = null;
    if ( !empty($_GET['id'])) {
        $videoID = $_REQUEST['id'];
    }
     
    if ( null==$videoID ) {
        header("Location: video.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM video where videoID = ?";
        $pdo->exec("set names utf8");
        $q = $pdo->prepare($sql);
        $q->execute(array($videoID));
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
    <title>cdon mutta hyvä</title>
  </head>

<body style="background-color:#90fff8;">
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>videotiedot</h3>
                    </div>

                    
                    <div class="form-horizontal" >

                        <div class="form-group row">
                            <label for="nimi" class="col-sm-2 col-form-label">Nimi</label>
                            <div class="col-sm-10">
                             <input name="nimi" readonly type="text" placeholder="nimi" value="<?php echo $data['nimi']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kuvaus" class="col-sm-2 col-form-label">Kuvaus</label>
                            <div class="col-sm-10">
                            <textarea readonly name="kuvaus" cols="23" rows="5"><?php echo $data['kuvaus']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="genre" class="col-sm-2 col-form-label">Genre</label>
                            <div class="col-sm-10">
                            <input name="genre" readonly type="text" placeholder="genre" value="<?php echo $data['genre']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ikaraja" class="col-sm-2 col-form-label">Ikäraja</label>
                            <div class="col-sm-10">
                            <input name="ikaraja" readonly type="text" placeholder="ikaraja" value="<?php echo $data['ikaraja']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="julkaisupaiva" class="col-sm-2 col-form-label">Julkaisupaiva</label>
                            <div class="col-sm-10">
                             <input name="julkaisupaiva" readonly type="text" placeholder="julkaisupaiva" value="<?php echo $data['julkaisupaiva']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tuotantovuosi" class="col-sm-2 col-form-label">Tuotantovuosi</label>
                            <div class="col-sm-10">
                             <input name="tuotantovuosi" readonly type="text" placeholder="tuotantovuosi" value="<?php echo $data['tuotantovuosi']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kesto" class="col-sm-2 col-form-label">Kesto</label>
                            <div class="col-sm-10">
                             <input name="kesto" readonly type="text" placeholder="kesto" value="<?php echo $data['kesto']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ohjaaja" class="col-sm-2 col-form-label">Ohjaaja</label>
                            <div class="col-sm-10">
                             <input name="ohjaaja" readonly type="text" placeholder="ohjaaja" value="<?php echo $data['ohjaaja']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nayttelijat" class="col-sm-2 col-form-label">Näyttelijät</label>
                            <div class="col-sm-10">
                             <textarea name="nayttelijat" readonly placeholder="nayttelijat" cols="23" rows="5"> <?php echo $data['nayttelijat']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kuva" class="col-sm-2 col-form-label">Kuva</label>
                            <div class="col-sm-10">
                             <input name="kuva" readonly type="text" placeholder="kuva" value="<?php echo $data['kuva']; ?>">
                            </div>
                        </div>

                        

                        <div class="form-actions">
                            <a class="btn btn-warning" href="video.php">Takas</a>
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