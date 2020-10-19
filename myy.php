<?php
     
    include 'header.php';
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $tuotenimiError = null;
        $lisatiedotError = null;
        $hintaError = null;
        $kuvaError = null;
        // keep track post values
        $tuotenimi = $_POST['tuotenimi'];
        $lisatiedot =  $_POST['lisatiedot'];
        $hinta = $_POST['hinta'];
        $kuva = $_POST['kuva'];
        // validate input
        $valid = true;
        if (empty($tuotenimi)) {
            $tuotenimiError = 'Syätä se tuate';
            $valid = false;
        }

        if (empty($lisatiedot)) {
            $lisatiedotError = 'Pist sitä tiatooooo tosijaaa';
            $valid = false;
        }
         
        if (empty($hinta)) {
            $hintaError = 'Lisää hinta eurona xd';
            $valid = false;
        } 

        if (empty($kuva)) {
            $henkilotunnusError = 'Anna kuva';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tuote (tuotenimi,lisatiedot,hinta,kuva) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($tuotenimi,$lisatiedot,$hinta,$kuva));
            Database::disconnect();
            header("Location: tuotelista.php");
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
             
                    <form class="form-horizontal" action="myy.php" method="post">
                      <div class="control-group <?php echo !empty($tuotenimiError)?'error':'';?>">
                        <label class="control-label">Tuotenimi</label>
                        <div class="controls">
                            <input name="tuotenimi" type="text"  placeholder="Tuotenimi" value="<?php echo !empty($tuotenimi)?$tuotenimi:'';?>">
                            <?php if (!empty($tuotenimiError)): ?>
                                <span class="help-inline"><?php echo $tuotenimiError;?></span>
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
                      
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>

</html>
