<?php

    include 'header.php';
    require 'database.php';

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

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
        $kuva = basename($_FILES['kuva']['name']);
         
        // validate input
        $valid = true;
        if (empty($tuotenimi)) {
            $tuotenimiError = 'Pist tuotenimi';
            $valid = false;
        }

        if (empty($lisatiedot)) {
            $lisatiedotError = 'Lait kuKUVvaus';
            $valid = false;
        }
         
        if (empty($hinta)) {
            $hintaError = 'Lisää HINTA';
            $valid = false;
        } 

        if (empty($kuva)) {
            $kuvaError = 'Lait sin kuva';
            $valid = false;
        }
        // insert data
        if ($valid) {
            $tmpName = $_FILES['kuva']['tmp_name'];
            $name = basename($_FILES['kuva']['name']);
            move_uploaded_file($tmpName, 'img/' . $name);
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE tuote  SET tuotenimi = ?,lisatiedot = ?,hinta = ?,kuva = ? WHERE tuoteID = ?";
            $q = $pdo->prepare($sql);
            $pdo->exec("set names utf8");
            $q->execute(array($tuotenimi, $lisatiedot, $hinta, $kuva, $id));
            Database::disconnect();
            header("Location: tuotelista.php");
        }
    }
    else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tuote  WHERE tuoteID = ?";
        $pdo->exec("set names utf8");
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        $tuotenimi = $data['tuotenimi'];
        $lisatiedot =  $data['lisatiedot'];
        $hinta = $data['hinta'];
        $kuva = $data['kuva'];
        if(isset($_SESSION["loggedin"]) && ($_SESSION["kayttajaID"]) == ($data["kayttajaID"]) && $_SESSION["loggedin"] === true)
        {
        }
        else
        {
            header("location: index.php");
            exit;
        }
    } 
?>
 
 <div class="container">
    <div class="card bg-info">
        <div class="card-header">
            <h3>Päivitä tuat ;)</h3>
        </div>
        <div class="body my-3 px-3">
            <form class="body" action="paivita_tuote.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $data['tuoteID'] ;?>"> 
                <div class="form-group row <?php echo !empty($tuotenimiError)?'alert alert-info':'';?>">
                    <label class="col-sm-4 col-form-label">>Tuotenimi</label>
                    <div class="col-sm-8">
                        <input name="tuotenimi" type="text" class="form-control" placeholder="<?php echo $tuotenimi?>" value="<?php echo !empty($tuotenimi)?$tuotenimi:'';?>">
                        <?php if (!empty($tuotenimiError)): ?>
                            <small class="text-muted"><?php echo $tuotenimiError;?></small>
                        <?php endif; ?>
                    </div>
                </div>
        
                <div class="form-group row <?php echo !empty($hintaError)?'alert alert-info':'';?>">
                    <label class="col-sm-4 col-form-label">>Hinta</label>
                    <div class="col-sm-8">
                        <input name="hinta" type="text" class="form-control" placeholder="<?php echo $hinta?>" value="<?php echo !empty($hinta)?$hinta:'';?>">
                        <?php if (!empty($hintaError)): ?>
                            <small class="text-muted"><?php echo $hintaError;?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row <?php echo !empty($lisatiedotError)?'alert alert-info':'';?>">
                    <label class="col-sm-4 col-form-label">>Lisatiedot</label>
                    <div class="col-sm-8">
                        <textarea name="lisatiedot" class="form-control" cols="23" rows="5" placeholder="<?php echo $lisatiedot?>"><?php echo !empty($lisatiedot)?$lisatiedot:'';?></textarea>
                        <?php if (!empty($lisatiedotError)): ?>
                            <small class="text-muted"><?php echo $lisatiedotError;?></small>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="form-group row <?php echo !empty($kuvaError)?'alert alert-info':'';?>">
                    <label class="col-sm-4 col-form-label">>Kuva</label>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input name="kuva" type="file" class="custom-file-input" placeholder="<?php echo $kuva?>" value="<?php echo !empty($kuva)?$kuva:'';?>">
                            <label for="" class="custom-file-label" data-browse="Sëärch"><?php echo $lisatiedot?></label>
                            <?php if (!empty($kuvaError)): ?>
                                <small class="text-muted"><?php echo $kuvaError;?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Päivitä</button>
            <a class="btn" href="kayttaja.php?id=<?php echo $data['kayttajaID']?>">Bäckii</a>
        </div>
    </form>
</div> <!-- /container -->
<?php
    include 'footer.php';
?>