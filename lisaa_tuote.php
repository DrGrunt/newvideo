<?php
     
    require 'header.php';
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
        $kuva = basename($_FILES['kuva']['name']);
        // validate input
        $valid = true;
        if (empty($tuotenimi)) {
            $tuotenimiError = 'Pist tuotenimi';
            $valid = false;
        }

        if (empty($lisatiedot)) {
            $lisatiedotError = 'Lait lisatiedot';
            $valid = false;
        }
        
        if (empty($hinta)) {
            $hintaError = 'Mikä hinta';
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
            $sql = "INSERT INTO tuote (tuotenimi,lisatiedot,hinta,kuva) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($tuotenimi,$lisatiedot,$hinta,$kuva));
            Database::disconnect();
            header("Location: tuotelista.php");
        }
    }
?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<div class="container">
    
    <div class="card bg-info">
        <div class="card-header">
            <h3>Tee tuate</h3>
        </div>
        <div class="body my-3 px-3">
            <form class="body" action="lisaa_tuote.php" method="post" enctype="multipart/form-data">
                <div class="form-group row <?php echo !empty($tuotenimiError)?'alert alert-info':'';?>">
                    <label class="col-sm-4 col-form-label">Tuotenimi</label>
                    <div class="col-sm-8">
                        <input name="tuotenimi" type="text" onfocus="this. placeholder = ''" onblur="this.placeholder = 'tuotenimi'" class="form-control" placeholder="tuotenimi" value="<?php echo !empty($tuotenimi)?$tuotenimi:'';?>">
                        <?php if (!empty($tuotenimiError)): ?>
                            <small class="text-muted"><?php echo $tuotenimiError;?></small>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="form-group row <?php echo !empty($lisatiedotError)?'alert alert-info':'';?>">
                    <label class="col-sm-4 col-form-label">lisatiedot</label>
                    <div class="col-sm-8">
                        <textarea name="lisatiedot" class="form-control" cols="25" rows="5" placeholder="lisatiedot"><?php echo !empty($lisatiedot)?$lisatiedot:'';?></textarea>
                        <?php if (!empty($lisatiedotError)): ?>
                            <small class="text-muted"><?php echo $lisatiedotError;?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row <?php echo !empty($hintaError)?'alert alert-info':'';?>">
                    <label class="col-sm-4 col-form-label">hinta</label>
                    <div class="col-sm-8">
                        <input name="hinta" type="text" class="form-control" placeholder="hinta" value="<?php echo !empty($hinta)?$hinta:'';?>">
                        <?php if (!empty($hintaError)): ?>
                            <small class="text-muted"><?php echo $hintaError;?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row <?php echo !empty($kuvaError)?'alert alert-info':'';?>">
                    <label class="col-sm-4 col-form-label">Kuva</label>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input name="kuva" type="file" class="custom-file-input" placeholder="Kuva" value="<?php echo !empty($kuva)?$kuva:'';?>">
                            <label for="" class="custom-file-label" data-browse="Sörch">Kuva PITÄÄ OLLA 1:1 RATIO LOL</label>
                            <?php if (!empty($kuvaError)): ?>
                                <small class="text-muted"><?php echo $kuvaError;?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Create</button>
                    <a class="btn" href="index.php">Etusivu</a>
                    <a class="btn" href="tuotelista.php">Tuotelista</a>
                </div>
                    
            </form>
        </div>
    </div>
</div> <!-- /container -->
  </body>

</html>
