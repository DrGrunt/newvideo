<?php
     
    include 'header.php';
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $etunimiError = null;
        $sukunimiError = null;
        $sahkopostiError = null;
        $henkilotunnusError = null;
        $lahiosoiteError = null;
        $postinumeroError = null;
        $postitoimipaikkaError = null;
        $puhelinError = null;
         
        // keep track post values
        $etunimi = $_POST['etunimi'];
        $sukunimi =  $_POST['sukunimi'];
        $sahkoposti = $_POST['sahkoposti'];
        $henkilotunnus = $_POST['henkilotunnus'];
        $lahiosoite = $_POST['lahiosoite'];
        $postinumero = $_POST['postinumero'];
        $postitoimipaikka = $_POST['postitoimipaikka'];
        $puhelin = $_POST['puhelin'];
         
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

        if (empty($henkilotunnus)) {
            $henkilotunnusError = 'Anna henkkarit';
            $valid = false;
        }
         
        if (empty($lahiosoite)) {
            $lahiosoiteError = 'Mikä osote';
            $valid = false;
        }

        if (empty($postinumero)) {
            $postinumeroError = 'Kuntas numero';
            $valid = false;
        }
         
        if (empty($postitoimipaikka)) {
            $postitoimipaikkaError = 'Kuntas nimi';
            $valid = false;
        }

        if (empty($puhelin)) {
            $puhelinError = 'Lait sin puhelinnumero';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO asiakas (etunimi,sukunimi,sahkoposti,henkilotunnus,lahiosoite,postinumero,postitoimipaikka,puhelin) values(?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($etunimi,$sukunimi,$sahkoposti,$henkilotunnus,$lahiosoite,$postinumero,$etunimi,$puhelin));
            Database::disconnect();
            header("Location: asiakas.php");
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

    <title>cdon mutta hyvä</title>
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
                        <h3>Tee asiakas</h3>
                    </div>
             
                    <form class="form-horizontal" action="lisaa_asiakas.php" method="post">
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
                      <div class="control-group <?php echo !empty($henkilotunnusError)?'error':'';?>">
                        <label class="control-label">Henkilötunnus</label>
                        <div class="controls">
                            <input name="henkilotunnus" type="text" placeholder="Henkilötunnus" value="<?php echo !empty($henkilotunnus)?$henkilotunnus:'';?>">
                            <?php if (!empty($henkilotunnusError)): ?>
                                <span class="help-inline"><?php echo $henkilotunnusError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($lahiosoiteError)?'error':'';?>">
                        <label class="control-label">Lähiosoite</label>
                        <div class="controls">
                            <input name="lahiosoite" type="text"  placeholder="Lähiosoite" value="<?php echo !empty($lahiosoite)?$lahiosoite:'';?>">
                            <?php if (!empty($lahiosoiteError)): ?>
                                <span class="help-inline"><?php echo $lahiosoiteError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($postinumeroError)?'error':'';?>">
                        <label class="control-label">Postinumero</label>
                        <div class="controls">
                            <input name="postinumero" type="text" placeholder="Postinumero" value="<?php echo !empty($postinumero)?$postinumero:'';?>">
                            <?php if (!empty($postinumeroError)): ?>
                                <span class="help-inline"><?php echo $postinumeroError;?></span>
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
                      <div class="control-group <?php echo !empty($puhelinError)?'error':'';?>">
                        <label class="control-label">Puhelinnumero</label>
                        <div class="controls">
                            <input name="puhelin" type="text" placeholder="Puhelinnumero" value="<?php echo !empty($puhelin)?$puhelin:'';?>">
                            <?php if (!empty($puhelinError)): ?>
                                <span class="help-inline"><?php echo $puhelinError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="asiakas.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>

</html>
