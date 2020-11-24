<?php
  require 'config.php';
  // Initialize the session
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>OHI</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/carousel/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <!-- Favicons -->


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
    </style>
    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
    <link href="open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
  </head>
  <body style="background-color:#90gff8;">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <img src="img/stoir.png" alt="Smiley face" height="42" width="42">
            <a class="navbar-brand" href="index.php"><?php echo SITENAME; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                <?php if( isset($_SESSION["loggedin"])&& ($_SESSION["loggedin"]) == 1 && $_SESSION["loggedin"] === true ): ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="asiakas.php">Asiakas <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="tuotelista.php">Tuotteita <span class="sr-only"></span></a>
                    </li>
                <?php endif; ?>
                </ul>
                <form class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Eti</button>
                </form>

                <?php if( isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true ): ?>
                  <a class="nav-link" href="ulos.php">Ulos <span class="oi oi-account-logout"></span></a>
                <?php else: ?>
                  <a class="nav-link" href="sisaan.php">Kirjaudu <span class="oi oi-account-login"></span></a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <h3></h3>