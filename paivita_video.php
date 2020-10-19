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
        $kuvausError = null;
        $hintaError = null;
        $kuvaError = null;
         
        // keep track post values
        $tuote = $_POST['tuote'];
        $kuvaus =  $_POST['kuvaus'];
        $hinta = $_POST['hinta'];
        $ikaraja = $_POST['ikaraja'];
         
        // validate input
        $valid = true;
        if (empty($tuote)) {
            $tuotenimiError = 'Pist tuote';
            $valid = false;
        }

        if (empty($kuvaus)) {
            $kuvausError = 'Lait kuKUVvaus';
            $valid = false;
        }
         
        if (empty($hinta)) {
            $hintaError = 'Lisää HINTA';
            $valid = false;
        } 

        if (empty($kuva)) {
            $kuvaError = 'Lait sin NEEKERI';
            $valid = false;
        }
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE video  SET tuote = ?,kuvaus = ?,hinta = ?,kuva = ? WHERE newvideoID = ?";
            $q = $pdo->prepare($sql);
            $pdo->exec("set names utf8");
            $q->execute(array($tuote, $kuvaus, $hinta, $kuva, $id));
            Database::disconnect();
            header("Location: newvideo.php");
        }
    }
    else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM video  WHERE newvideoID = ?";
        $pdo->exec("set names utf8");
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        $tuote = $data['tuote'];
        $kuvaus =  $data['kuvaus'];
        $hinta = $data['hinta'];
        $kuva = $data['kuva'];
    } 
?>
 
<div class="container">

    <div class="row">
        <h3>Päivitä vireo ;)</h3>
    </div>
    <form class="form-horizontal" action="paivita_video.php?id=<?php echo $id; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $data['videoID'] ;?>"> 
        <div class="control-group row <?php echo !empty($tuotenimiError)?'alert alert-info':'';?>">
            <label class="col-sm-2 col-form-label">tuote</label>
            <div class="col-sm-10">
                <input name="tuote" type="text"  placeholder="tuote" value="<?php echo !empty($tuote)?$tuote:'';?>">
                <?php if (!empty($tuotenimiError)): ?>
                    <small class="text-muted"><?php echo $tuotenimiError;?></small>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="control-group row <?php echo !empty($kuvausError)?'alert alert-info':'';?>">
            <label class="col-sm-2 col-form-label">Kuvaus</label>
            <div class="col-sm-10">
                <textarea name="kuvaus" cols="23" rows="5"><?php echo !empty($kuvaus)?$kuvaus:'Kuvaus';?></textarea>
                <?php if (!empty($kuvausError)): ?>
                    <small class="text-muted"><?php echo $kuvausError;?></small>
                <?php endif; ?>
            </div>
        </div>

        <div class="control-group row <?php echo !empty($hintaError)?'alert alert-info':'';?>">
            <label class="col-sm-2 col-form-label">hinta</label>
            <div class="col-sm-10">
                <input name="genre" type="text"  placeholder="genre" value="<?php echo !empty($genre)?$genre:'';?>">
                <?php if (!empty($hintaError)): ?>
                    <small class="text-muted"><?php echo $hintaError;?></small>
                <?php endif; ?>
            </div>
        </div>


        <div class="control-group row <?php echo !empty($kuvaError)?'alert alert-info':'';?>">
            <label class="col-sm-2 col-form-label">Kuva</label>
            <div class="col-sm-10">
                <input name="kuva" type="text"  placeholder="kuva" value="<?php echo !empty($kuva)?$kuva:'';?>">
                <?php if (!empty($kuvaError)): ?>
                    <small class="text-muted"><?php echo $kuvaError;?></small>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Päivitä</button>
            <a class="btn" href="tuotelista.php">Bäckii</a>
        </div>
    </form>
</div> <!-- /container -->
<?php
    include 'footer.php';
?>