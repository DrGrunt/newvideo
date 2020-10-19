<?php

	include 'header.php'; 
    require 'database.php';

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: asiakas.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM asiakas where ID = ?";
		$pdo->exec("set names utf8");
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Katso asiakastietoja</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Etunimi</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Etunimi'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Sukunimi</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Sukunimi'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Osoite</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Osoite'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Postinumero</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Postinumero'];?>
                            </label>
                        </div> 
                      </div>
					  <div class="control-group">
                        <label class="control-label">Postitoimipaikka</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Postitoimipaikka'];?>
                            </label>
                        </div>
					  </div>  
					  <div class="control-group">
                        <label class="control-label">Puhelin</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Puhelin'];?>
                            </label>
                        </div>
					  </div>
					  <div class="control-group">
                        <label class="control-label">Sähköposti</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Sahkoposti'];?>
                            </label>
                        </div>
					  </div>
                      <div class="form-actions">
                      	<a class="btn" href="asiakas.php">Takaisin</a>
                      </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
	
<?php 
	include 'footer.php'; 
?>