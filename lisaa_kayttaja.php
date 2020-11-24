<?php
     
    include 'header.php';
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $etunimiError = null;
        $sukunimiError = null;
        $sahkopostiError = null;
        $postitoimipaikkaError = null;
        $puhelinnumeroError = null;
        $kayttajatunnusError = null;
        $salasanaError = null;
         
        // keep track post values
        $etunimi = $_POST['etunimi'];
        $sukunimi =  $_POST['sukunimi'];
        $sahkoposti = $_POST['sahkoposti'];
        $postitoimipaikka = $_POST['postitoimipaikka'];
        $puhelinnumero = $_POST['puhelinnumero'];
        $kayttajatunnus = $_POST['kayttajatunnus'];
        $salasana = $_POST['salasana'];
         
        // validate input
        $valid = true;
        if (empty($etunimi)) {
            $etunimiError = 'Syätä se etunimi';
            $valid = false;
        }

        if (empty($sukunimi)) {
            $sukunimiError = 'Pist se sukunimi';
            $valid = false;
        }
         
        if (empty($sahkoposti)) {
            $sahkopostiError = 'Lisää sähköposti';
            $valid = false;
        } else if ( !filter_var($sahkoposti,FILTER_VALIDATE_EMAIL) ) {
            $sahkopostiError = 'Lisää se OIKEA sähköposti bruh';
            $valid = false;
        }
         
        if (empty($postitoimipaikka)) {
            $postitoimipaikkaError = 'Kuntas nimi';
            $valid = false;
        }

        if (empty($puhelinnumero)) {
            $puhelinnumeroError = 'Lait sin puhelinnumero';
            $valid = false;
        }

        if (empty($kayttajatunnus)) {
            $kayttajatunnusError = 'Käyttis plz';
            $valid = false;
        }

        if (empty($salasana)) {
            $salasanaError = 'Salariplz';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $salasana = password_hash($salasana, PASSWORD_DEFAULT);
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO kayttaja (etunimi,sukunimi,sahkoposti,postitoimipaikka,puhelinnumero,kayttajatunnus,salasana) values(?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($etunimi,$sukunimi,$sahkoposti,$postitoimipaikka,$puhelinnumero,$kayttajatunnus,$salasana));
            Database::disconnect();
            header("Location: sisaan.php");
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>OHI</title>
  </head>
  <body style="background-color:#90fff8;">
    
            </table>
        </div>
    </div> <!-- /container -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
 
<body style="background-color:#90fff8;">
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Tee usari</h3>
                    </div>
             
                    <form class="form-horizontal" action="lisaa_kayttaja.php" method="post">
                      <div class="control-group <?php echo !empty($etunimiError)?'error':'';?>">
                        <label class="control-label">Etuimi</label>
                        <div class="controls">
                            <input name="etunimi" type="text"  placeholder="Etunimi" value="<?php echo !empty($etunimi)?$etunimi:'';?>">
                            <?php if (!empty($etunimiError)): ?>
                                <span class="help-inline"><?php echo $etunimiError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($sukunimiError)?'error':'';?>">
                        <label class="control-label">Sukunimi</label>
                        <div class="controls">
                            <input name="sukunimi" type="text" placeholder="Sukunimi" value="<?php echo !empty($sukunimi)?$sukunimi:'';?>">
                            <?php if (!empty($sukunimiError)): ?>
                                <span class="help-inline"><?php echo $sukunimiError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($sahkopostiError)?'error':'';?>">
                        <label class="control-label">Sähköposti</label>
                        <div class="controls">
                            <input name="sahkoposti" type="text"  placeholder="Sähköposti" value="<?php echo !empty($sahkoposti)?$sahkoposti:'';?>">
                            <?php if (!empty($sahkopostiError)): ?>
                                <span class="help-inline"><?php echo $sahkopostiError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($postitoimipaikkaError)?'error':'';?>">
                        <label class="control-label">Postitoimipaikka</label>
                        <div class="controls">
                            <input name="postitoimipaikka" type="text"  placeholder="Postitoimipaikka" value="<?php echo !empty($postitoimipaikka)?$postitoimipaikka:'';?>">
                            <?php if (!empty($postitoimipaikkaError)): ?>
                                <span class="help-inline"><?php echo $postitoimipaikkaError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($puhelinnumeroError)?'error':'';?>">
                        <label class="control-label">Puhelinnumero</label>
                        <div class="controls">
                            <input name="puhelinnumero" type="text" placeholder="Puhelinnumero" value="<?php echo !empty($puhelinnumero)?$puhelinnumero:'';?>">
                            <?php if (!empty($puhelinnumeroError)): ?>
                                <span class="help-inline"><?php echo $puhelinnumeroError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($kayttajatunnusError)?'error':'';?>">
                        <label class="control-label">Käyttäjätunnus</label>
                        <div class="controls">
                            <input name="kayttajatunnus" type="text" placeholder="Käyttäjätunnus" value="<?php echo !empty($kayttajatunnus)?$kayttajatunnus:'';?>">
                            <?php if (!empty($kayttajatunnusError)): ?>
                                <span class="help-inline"><?php echo $kayttajatunnusError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($salasanaError)?'error':'';?>">
                        <label class="control-label">Salasana</label>
                        <div class="controls">
                            <input name="salasana" type="password" placeholder="Salasana" value="<?php echo !empty($salasana)?$salasana:'';?>">
                            <?php if (!empty($salasanaError)): ?>
                                <span class="help-inline"><?php echo $salasanaError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>

</html>
