<?php
    include 'header.php';
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) 
      {
        $id = $_REQUEST['id'];
        
      }

      if ( !empty($_POST) ) 
      {
        $id = $_POST['id'];

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tuote  WHERE tuoteID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: index.php");

        
      } 
        else 
      {
        // delete data
        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tuote where tuoteID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
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

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>OHI</title>
  </head>
  <body style="background-color:#90fff8;">
    <h1>Poista tuote</h1>
    
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                    </div>
                     
                    <form class="form-horizontal" action="poista_tuote.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Haluatko poistaa tuotteen <?php echo $data['tuotenimi']?>?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Kyllä</button>
                          <a class="btn btn-outline-black" href="kayttaja.php?id=<?php echo $data['kayttajaID']?>">En</a>
                        </div>
                    </form>
                </div>
                 
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>