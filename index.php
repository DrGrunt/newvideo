<?php 
  include 'header.php';
  
  $hakusana = '';

  if(!empty($_POST)){
    $hakusana = $_POST['haku'];
  }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Album example · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">

    <!-- Bootstrap core CSS -->
<link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">


    
    <!-- Custom styles for this template -->
  </head>
  <body>

<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="text-secondary"Secondary link>OHI.FI</h1>
      <p class="lead text-muted">Moro</p>
      <p>
        <a href="lisaa_tuote.php" class="kakka">Listaa Myyntiin</a>
      </p>
      <form action="" method="post">
        <input type="text" name="haku" id="haku" placeholder="Hakusana" class="form-control mr-sm-2">
        <button type="submit" class="btn btn-outline-success">Hae</button>
      </form>
    </div>
  </section>


  <div class="album py-5 bg-light">
    <div class="container">


    <div class="container">
        <div class="row">
            <h1 style="font-size:500    %;font-family:helvetica;font-weight:bold;">MYYNNISSÄ</h1>
        </div>
            <div class="row">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                                <th>Kuva</th>
                                <th>Nimi/Hinta</th>
                                <th>Lisätiedot</th>
                                <th>OSTA</th>
                        </tr>
                        </thead>
                  <tbody>
                    <?php
                            include 'database.php';
                            $pdo = Database::connect();
                            $sql = 'SELECT * FROM tuote';
                            foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. "<img src='img/{$row['kuva']}' width='100' height='100'>" . '</td>';
                                echo '<td>';
                                echo '<h3>'. $row['tuotenimi'] .'</h3>';
                                echo '<h6>'. $row['hinta'] . "€" . '</h6>';
                                echo '</td>';
                                echo '<td>'. $row['lisatiedot'] . '</td>';
                                echo '<td>';
                                echo '<a class="btn btn-info" href="katso_tuote.php?id='.$row['tuoteID'].'">Katso lisää</a>';
                                echo '</td>';
                                 echo '</td>';
                                 echo '</tr>';
                            }
                            Database::disconnect();
                        ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
    
     </body>
</html>
    
                        
                            

  

<!--

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

-->
</main>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script></body>
</html>


  <?php 
	include 'footer.php'; 
?>
