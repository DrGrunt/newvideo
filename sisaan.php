<?php
    include 'header.php';

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: asiakas.php");
    exit;
}

require_once "database.php";
 
$kayttajatunnus = $salasana = "";
$kayttajatunnusError = $salasanaError = "";
 
if( $_SERVER["REQUEST_METHOD"] == "POST" ){
 
    if(empty(trim($_POST["kayttajatunnus"]))){
        $kayttajatunnusError = "pistä käyttäjätunnus";
    } else{
        $kayttajatunnus = trim($_POST["kayttajatunnus"]);
    }
    
    if(empty(trim($_POST["salasana"]))){
        $salasanaError = "Laita salainen sana";
    } else{
        $salasana = trim($_POST["salasana"]);
    }
    
    if(empty($kayttajatunnusError) && empty($salasanaError)){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT kayttajaID, kayttajatunnus, salasana FROM kayttaja WHERE kayttajatunnus = :kayttajatunnus";

        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":kayttajatunnus", $param_kayttajatunnus, PDO::PARAM_STR);
            
            // Set parameters
            $param_kayttajatunnus = trim($_POST["kayttajatunnus"]); //$
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["kayttajaID"];
                        $kayttajatunnus = $row["kayttajatunnus"];
                        $hashed_salasana = $row["salasana"];
                        if(password_verify($salasana, $hashed_salasana)){

                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["kayttajaID"] = $id;
                            $_SESSION["kayttajatunnus"] = $kayttajatunnus;
                            header("location: index.php");
                        } else{
                            $salasanaError = "Salasana väärä";
                        }
                    }
                } else{
                    $kayttajatunnusError = "Käyttäjätunnus surkiasti";
                }
            } else{
                echo "Kirjaudu uudestaan";
            }   

            // Close statement
            unset($stmt);
        }
        // Close connection
        Database::disconnect();
    }    
}

?>

<div class="container mt-3">

    <h2>Tule sisään</h2>

    <p>Anna käyttäjätunnus ja salainen sana.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="form-group row <?php echo (!empty($kayttajatunnusError)) ? 'alert alert-info' : ''; ?>">
            <label class="col-sm-2 col-form-label">Käyttäjätunnus</label>
            <input type="text" name="kayttajatunnus" class="col-sm-10" value="<?php echo !empty($kayttajatunnus)?$kayttajatunnus:''; ?>">
            <?php if (!empty($kayttajatunnusError)): ?>
                <small class="text-muted"><?php echo $kayttajatunnusError;?></small>
            <?php endif; ?>
        </div>    

        <div class="form-group row <?php echo (!empty($salasanaError)) ? 'alert alert-info' : ''; ?>">
            <label class="col-sm-2 col-form-label">Salasana</label>
            <input type="password" name="salasana" class="col-sm-10">
            <?php if (!empty($salasanaError)): ?>
                <small class="text-muted"><?php echo $salasanaError;?></small>
            <?php endif; ?>
        </div>

        <div class="form-group row">
            <input type="submit" class="btn btn-primary" value="Kirjaudu">
        </div>
        <div class="form-group row">
            <a href="lisaa_kayttaja.php" class="btn btn-warning" role="button">Luo käyttäjä</a>
        </div>

    </form>
</div>

<?php
    include 'footer.php';
?>