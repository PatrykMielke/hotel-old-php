<?php session_start();
if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
{
  if($_SESSION['admin']>0)
          {
            header('Location:paneladmin.php');
            exit();
          }
          else
          {
            header('Location:panel.php');
            exit();
          }
}
 ?>
<!doctype html>
<html lang="pl">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
    <link rel="stylesheet" href="style.css">

    <title>Galeria</title>
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php"><img class="logom" src="img/logom.png">Hotel Victoria</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Strona Główna
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="galeria.php">Galeria</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="kontakt.php">Kontakt</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="oferta.php">Oferta</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logowanie.php">Zaloguj</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <section class="gallery-block compact-gallery">
    	<div class="container">
    		<div class="heading">
    			<h2 class="napis2">Hotel Victoria Galeria</h2>
    		</div>

    		<div class="row no-gutters">
    			<div class="col-md-6 col-lg-4 item zoom-on-hover">
    				<a class="lightbox" href="img/F1.jpg">
    					<img class="img-fluid image" src="img/F1.jpg">
    					<span class="description">
    						<span class="description-heading">Nagłowek</span>
    						<span class="description-body">Opis zdjecia</span>
    					</span>
    				</a>
    			</div>


    			<div class="col-md-6 col-lg-4 item zoom-on-hover">
    				<a class="lightbox" href="img/F2.jpg">
    					<img class="img-fluid image" src="img/F2.jpg">
    					<span class="description">
    						<span class="description-heading">Nagłowek</span>
    						<span class="description-body">Opis zdjecia</span>
    					</span>
    				</a>
    			</div>


    			<div class="col-md-6 col-lg-4 item zoom-on-hover">
    				<a class="lightbox" href="img/F3.jpg">
    					<img class="img-fluid image" src="img/F3.jpg">
    					<span class="description">
    						<span class="description-heading">Nagłowek</span>
    						<span class="description-body">Opis zdjecia</span>
    					</span>
    				</a>
    			</div>

    			<div class="col-md-6 col-lg-4 item zoom-on-hover">
    				<a class="lightbox" href="img/F4.jpg">
    					<img class="img-fluid image" src="img/F4.jpg">
    					<span class="description">
    						<span class="description-heading">Nagłowek</span>
    						<span class="description-body">Opis zdjecia</span>
    					</span>
    				</a>
    			</div>


    			<div class="col-md-6 col-lg-4 item zoom-on-hover">
    				<a class="lightbox" href="img/F5.jpg">
    					<img class="img-fluid image" src="img/F5.jpg">
    					<span class="description">
    						<span class="description-heading">Nagłowek</span>
    						<span class="description-body">Opis zdjecia</span>
    					</span>
    				</a>
    			</div>


    			<div class="col-md-6 col-lg-4 item zoom-on-hover">
    				<a class="lightbox" href="img/F6.jpg">
    					<img class="img-fluid image" src="img/F6.jpg">
    					<span class="description">
    						<span class="description-heading">Nagłowek</span>
    						<span class="description-body">Opis zdjecia</span>
    					</span>
    				</a>
    			</div>

    			<div class="col-md-6 col-lg-4 item zoom-on-hover">
    				<a class="lightbox" href="img/F7.jpg">
    					<img class="img-fluid image" src="img/F7.jpg">
    					<span class="description">
    						<span class="description-heading">Nagłowek</span>
    						<span class="description-body">Opis zdjecia</span>
    					</span>
    				</a>
    			</div>

    			<div class="col-md-6 col-lg-4 item zoom-on-hover">
    				<a class="lightbox" href="img/F8.jpg">
    					<img class="img-fluid image" src="img/F8.jpg">
    					<span class="description">
    						<span class="description-heading">Nagłowek</span>
    						<span class="description-body">Opis zdjecia</span>
    					</span>
    				</a>
    			</div>

    			<div class="col-md-6 col-lg-4 item zoom-on-hover">
    				<a class="lightbox" href="img/F9.jpg">
    					<img class="img-fluid image" src="img/F9.jpg">
    					<span class="description">
    						<span class="description-heading">Nagłowek</span>
    						<span class="description-body">Opis zdjecia</span>
    					</span>
    				</a>
    			</div>
    		</div>
    	</div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
	      baguetteBox.run('.compact-gallery',{animation:'slideIn'});
	  </script>

  </body>
</html>
