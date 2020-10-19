<?php

    include 'header.php';
    require 'database.php';
    $_SESSION["kayttajaID"] = $kayttajaID;
    $kayttajaID = null;
    if ( !empty($_GET['kayttajaID'])) {
        $_SESSION = $_REQUEST['kayttajaID'];
    }
     
    if ( null==$kayttajaID ) {
        //header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM kayttaja where kayttajaID = ?";
        $pdo->exec("set names utf8");
        $q = $pdo->prepare($sql);
        $q->execute(array($kayttajaID));
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
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Kayttajatiedot</h3>
                    </div>

                    
                    <div class="form-horizontal" >

                        <div class="form-group row">
                            <label for="kayttajatunnus" class="col-sm-2 col-form-label">Käyttäjätunnus</label>
                            <div class="col-sm-10">
                             <input name="kayttajatunnus" readonly type="text" placeholder="kayttajatunnus" value="<?php echo $data['kayttajatunnus']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="etunimi" class="col-sm-2 col-form-label">Etunimi</label>
                            <div class="col-sm-10">
                             <input name="etunimi" readonly type="text" placeholder="etunimi" value="<?php echo $data['etunimi']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sukunimi" class="col-sm-2 col-form-label">Sukunimi</label>
                            <div class="col-sm-10">
                            <textarea readonly name="sukunimi" cols="23" rows="5"><?php echo $data['sukunimi']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lahiosoite" class="col-sm-2 col-form-label">Lahiosoite</label>
                            <div class="col-sm-10">
                            <input name="lahiosoite" readonly type="text" placeholder="lahiosoite" value="<?php echo $data['lahiosoite']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postinumero" class="col-sm-2 col-form-label">Postinumero</label>
                            <div class="col-sm-10">
                            <input name="postinumero" readonly type="text" placeholder="postinumero" value="<?php echo $data['postinumero']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postitoimipaikka" class="col-sm-2 col-form-label">Postitoimipaikka</label>
                            <div class="col-sm-10">
                             <input name="postitoimipaikka" readonly type="text" placeholder="postitoimipaikka" value="<?php echo $data['postitoimipaikka']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="puhelin" class="col-sm-2 col-form-label">Puhelinnumero</label>
                            <div class="col-sm-10">
                             <input name="puhelin" readonly type="text" placeholder="puhelin" value="<?php echo $data['puhelin']; ?>">
                            </div>
                        </div>

                        <div class="form-actions">
                            <a class="btn btn-warning" href="index.php">Etusivu</a>
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