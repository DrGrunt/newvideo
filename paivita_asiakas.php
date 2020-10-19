<?php
    include 'header.php';
    require 'database.php';
    $asiakasID = null;
    if ( !empty($_GET) ) 
    {
        $asiakasID = $_REQUEST['id'];
    
     
        if ( null==$asiakasID ) {
            header("Location: asiakas.php");
        } 
        else {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM asiakas where asiakasID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($asiakasID));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
        }
    }
    elseif ( !empty($_POST)) {
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
        $asiakasID = $_POST['id'];
        $etunimi = $_POST['etunimi'];
        $sukunimi =  $_POST['sukunimi'];
        $sahkoposti = $_POST['sahkoposti'];
        $henkilotunnus = $_POST['henkilotunnus'];
        $lahiosoite = $_POST['lahiosoite'];
        $postinumero = $_POST['postinumero'];
        $postitoimipaikka = $_POST['postitoimipaikka'];
        $puhelin = $_POST['puhelin'];

        $data['asiakasID'] = $_POST['id'];
        $data['etunimi'] = $_POST['etunimi'];
        $data['sukunimi'] =  $_POST['sukunimi'];
        $data['sahkoposti'] = $_POST['sahkoposti'];
        $data['henkilotunnus'] = $_POST['henkilotunnus'];
        $data['lahiosoite'] = $_POST['lahiosoite'];
        $data['postinumero'] = $_POST['postinumero'];
        $data['postitoimipaikka'] = $_POST['postitoimipaikka'];
        $data['puhelin'] = $_POST['puhelin'];
         
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
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE asiakas  SET etunimi = ?,sukunimi = ?,sahkoposti = ?,henkilotunnus = ?,lahiosoite = ?,postinumero = ?,postitoimipaikka = ?,puhelin = ? WHERE asiakasID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($etunimi,$sukunimi,$sahkoposti,$henkilotunnus,$lahiosoite,$postinumero,$etunimi,$puhelin,$asiakasID));
            Database::disconnect();
            header("Location: asiakas.php");
        }
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

                <div class="row">
                    <h3>Päivitä asiakkuutta:D</h3>
                </div>
                <form action="paivita_asiakas.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $data['asiakasID'] ;?>"> 
                    <div class="form-group row">
                        <label for="Etunimi" class="col-sm-2 col-form-label">Etunimi</label>
                            <div class="col-sm-10">
                                <input type="text" name="etunimi" class="form-control" value="<?php echo $data['etunimi']; ?>">
                            </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="Sukunimi" class="col-sm-2 col-form-label">Sukunimi</label>
                            <div class="col-sm-10">
                                <input type="text" name="sukunimi" class="form-control" value="<?php echo $data['sukunimi']; ?>">
                            </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="Henkilötunnus" class="col-sm-2 col-form-label">Henkilötunnus</label>
                            <div class="col-sm-10">
                                <input type="text" name="henkilotunnus" class="form-control" value="<?php echo $data['henkilotunnus']; ?>">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="Sähköposti" class="col-sm-2 col-form-label">Sähköposti</label>
                            <div class="col-sm-10">
                                <input type="text" name="sahkoposti" class="form-control" value="<?php echo $data['sahkoposti']; ?>">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="Osoite" class="col-sm-2 col-form-label">Osoite</label>
                            <div class="col-sm-10">
                                <input type="text" name="lahiosoite" class="form-control" value="<?php echo $data['lahiosoite']; ?>">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="Postinumero" class="col-sm-2 col-form-label">Postinumero</label>
                            <div class="col-sm-10">
                                <input type="text" name="postinumero" class="form-control" value="<?php echo $data['postinumero']; ?>">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="Postitoimipaikka" class="col-sm-2 col-form-label">Postitoimipaikka</label>
                            <div class="col-sm-10">
                                <input type="text" name="postitoimipaikka" class="form-control" value="<?php echo $data['postitoimipaikka']; ?>">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="Puhelinnumero" class="col-sm-2 col-form-label">Puhelinnumero</label>
                            <div class="col-sm-10">
                                <input type="text" name="puhelin" class="form-control" value="<?php echo $data['puhelin']; ?>">
                            </div>
                    </div>
                    <div class="form-actions">
                          <button type="submit" class="btn btn-success">Päivitä</button>
                          <a class="btn" href="asiakas.php">Bäckii</a>
                        </div>
                </form>
            
            </div> <!-- /container -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>