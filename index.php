<?php 
	include 'header.php'; 
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


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .kakka {
        width: 100%;
        height: 100%;
        border: none;
        background-color: #4CAF50;
        color: white;
        padding: 14px 28px;
        font-size: 32px;
        cursor: pointer;
        text-align: center;
      }
      .pissa {
        width: 100%;
        height: 100%;
        border: none;
        background-color: #800000;
        color: white;
        padding: 14px 28px;
        font-size: 32px;
        cursor: pointer;
        text-align: center;
      }
      
    </style>
    <!-- Custom styles for this template -->
  </head>
  <body>
    
<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1>Album example</h1>
      <p class="lead text-muted">PYLLY</p>
      <p>
        <a href="lisaa_tuote.php" class="kakka">Myy/Sell</a>
        <a href="tuotelista.php" class="pissa">Osta/Buy</a>
      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

    
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="img/321921542060201.gif" class="rounded" height="300"  widh="300">    </img> 
            <div class="card-body">
              <p class="card-text">"TÄHÄ LISÄTIEDOT" </p>
              <a href="tuotelista.php" class="btn btn-secondary" >Osta</a>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div>

              </div>
            </div>
          </div>
        </div>
        


      </div>
    </div>
  </div>

</main>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script></body>
</html>


  <?php 
	include 'footer.php'; 
?>
