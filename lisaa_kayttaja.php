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
			$pdo->exec("set names utf8");
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

   
  </body>
 
<body style="background-color:#90fff8;">
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Tee usari</h3>
                    </div>
             
                    <form class="form-horizontal" action="lisaa_kayttaja.php" method="post">
                      <div class="control-group row <?php echo !empty($etunimiError)?'error':'';?>">
                        <label class="col-sm-4">Etuimi</label>
                        <div class="col-sm-10">
                            <input name="etunimi" type="text"  placeholder="Etunimi" value="<?php echo !empty($etunimi)?$etunimi:'';?>">
                            <?php if (!empty($etunimiError)): ?>
                                <span class="help-inline"><?php echo $etunimiError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group row <?php echo !empty($sukunimiError)?'error':'';?>">
                        <label class="col-sm-4">Sukunimi</label>
                        <div class="col-sm-10">
                            <input name="sukunimi" type="text" placeholder="Sukunimi" value="<?php echo !empty($sukunimi)?$sukunimi:'';?>">
                            <?php if (!empty($sukunimiError)): ?>
                                <span class="help-inline"><?php echo $sukunimiError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group row <?php echo !empty($sahkopostiError)?'error':'';?>">
                        <label class="col-sm-4">Sähköposti</label>
                        <div class="col-sm-10">
                            <input name="sahkoposti" type="text"  placeholder="Sähköposti" value="<?php echo !empty($sahkoposti)?$sahkoposti:'';?>">
                            <?php if (!empty($sahkopostiError)): ?>
                                <span class="help-inline"><?php echo $sahkopostiError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group row <?php echo !empty($postitoimipaikkaError)?'error':'';?>">
                        <label class="col-sm-4">Postitoimipaikka</label>
                        <div class="col-sm-10">
                            <input name="postitoimipaikka" type="text"  placeholder="Postitoimipaikka" value="<?php echo !empty($postitoimipaikka)?$postitoimipaikka:'';?>">
                            <?php if (!empty($postitoimipaikkaError)): ?>
                                <span class="help-inline"><?php echo $postitoimipaikkaError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group row <?php echo !empty($puhelinnumeroError)?'error':'';?>">
                        <label class="col-sm-4">Puhelinnumero</label>
                        <div class="col-sm-10">
                            <input name="puhelinnumero" type="text" placeholder="Puhelinnumero" value="<?php echo !empty($puhelinnumero)?$puhelinnumero:'';?>">
                            <?php if (!empty($puhelinnumeroError)): ?>
                                <span class="help-inline"><?php echo $puhelinnumeroError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group row <?php echo !empty($kayttajatunnusError)?'error':'';?>">
                        <label class="col-sm-4">Käyttäjätunnus</label>
                        <div class="col-sm-10">
                            <input name="kayttajatunnus" type="text" placeholder="Käyttäjätunnus" value="<?php echo !empty($kayttajatunnus)?$kayttajatunnus:'';?>">
                            <?php if (!empty($kayttajatunnusError)): ?>
                                <span class="help-inline"><?php echo $kayttajatunnusError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group row <?php echo !empty($salasanaError)?'error':'';?>">
                        <label class="col-sm-4">Salasana</label>
                        <div class="col-sm-10">
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
