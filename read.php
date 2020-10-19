<?php
    include 'header.php';
    require 'database.php';
    $asiakasID = null;
    if ( !empty($_GET['id'])) {
        $asiakasID = $_REQUEST['id'];
    }
     
    if ( null==$asiakasID ) {
        header("Location: asiakas.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM asiakas where asiakasID = ?";
        $sql = 'SELECT *, CONCAT(etunimi, " ", sukunimi) nimi FROM asiakas where asiakasID = ?';
        $q = $pdo->prepare($sql);
        $q->execute(array($asiakasID));
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
                        <h3>Asiakastiedot</h3>
                    </div>

                    
                    <div class="form-horizontal" >

                        <div class="form-group row">
                            <label for="Nimi" class="col-sm-2 col-form-label">Nimi</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['nimi']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Henkilotunnus" class="col-sm-2 col-form-label">Henkilotunnus</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['henkilotunnus']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Sähköposti" class="col-sm-2 col-form-label">Sähköposti</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['sahkoposti']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Osoite" class="col-sm-2 col-form-label">Osoite</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['lahiosoite']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Postinumero" class="col-sm-2 col-form-label">Postinumero</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['postinumero']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Postitoimipaikka" class="col-sm-2 col-form-label">Postitoimipaikka</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['postitoimipaikka']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Puhelin Numero" class="col-sm-2 col-form-label">Puhelin Numero</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data['puhelin']; ?>">
                            </div>
                        </div>

                        <div class="form-actions">
                            <a class="btn btn-warning" href="asiakas.php">Takas</a>
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