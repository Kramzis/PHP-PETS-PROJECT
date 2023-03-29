<?php
include_once 'klasy/Baza.php';
include_once 'klasy/User.php';
include_once 'klasy/UserManager.php';

$db = new Baza("localhost", "root", "", "clients");
$um = new UserManager();
session_start();
$session_id = session_id();
$id = $um->getLoggedInUser($db, $session_id);
if($id>0) {
    $beforeLoggingNAV='
            <li class="nav-item active">
            <a class="nav-link" href="index.php#o_nas">O nas<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
             <a class="nav-link" href="index.php#galeria">Nasi Przyjaciele</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="usersPanel.php">Moje Konto</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="reservation.php">Rezerwacje</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="myReservations.php">Moje Rezerwacje</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="loginProcess.php?akcja=wyloguj">Wyloguj się</a>
            </li>';
} else {
    $afterLoggingNav='<li class="nav-item active">
                <a class="nav-link" href="index.php#o_nas">O nas<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php#galeria">Nasi Przyjaciele</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registration.php">Rejestracja</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="loginProcess.php">Zaloguj się</a>
            </li>';
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes" />
    <meta name="description" content="Projekt końcowy z Podstaw Aplikacji Internetowych, 2022" />
    <meta name="author" content="Magdalena Kramek" />
    <title>Schronisko „Pod Łapą”</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body id="page-top">

<!-- Nawigacja-->
<nav class="navbar navbar-expand-lg navbar-light bg-dark " id = "mainNav">
    <a class="navbar-brand" href="#szczyt"><h5>Schronisko „Pod Łapą”</h5></a>
    <button class="navbar-toggler bg-gradient" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php
            if($id>0) {
              echo $beforeLoggingNAV;
            } else {
               echo $afterLoggingNav;
            }
            ?>
        </ul>
    </div>
</nav>

<!-- Szczyt strony-->
<header>
    <div class="mx-auto py-4" style="width: 65%;">
        <div class="container text-center">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner text-center">
                    <div class="carousel-item active">
                        <img src="assets/img1.jpg" class="w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img2.jpg" class="w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img3.jpg" class="w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="py-4">
            <a class="btn btn-primary btn-xl text-uppercase text-dark" href="#o_nas">Dowiedz się więcej</a>
            </div>
        </div>
    </div>
</header>


<!--O nas-->
<section class="page-section" id="o_nas">
    <div class="container">

        <div class="text-center">
            <h2 class="section-heading text-uppercase">Nasze schronisko</h2>
            <h3 class="section-subheading">Poznaj naszą działalność</h3>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-square fa-stack-2x text-primary"></i>
                            <i class="fas fa-bed fa-stack-1x"></i>
                        </span>
                <h4 class="my-1">Przygarniamy bezdomne zwierzęta</h4>
                <p> Każde zwierzę potrzebujące domu znajdzie u nas opiekę i schronienie. Upewniamy się, że nasi podopieczni mają wszystko, czego potrzebują.  </p>
            </div>
            <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-square fa-stack-2x text-primary"></i>
                            <i class="fas fa-child fa-stack-1x"></i>
                        </span>
                <h4 class="my-2">Zajmujemy się adopcją</h4>
                <p>Nasi pracownicy oraz wolontariusze pracują niezwykle skrupulatnie podczas procesów adopcyjnych, aby zapewnić pupilom jak najlepsze rodziny.</p>
            </div>
            <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-square fa-stack-2x text-primary"></i>
                            <i class="fas fa-home fa-stack-1x"></i>
                        </span>
                <h4 class="my-3">Stajemy się ich rodziną</h4>
                <p>Zwierzętom, którym nie jesteśmy w stanie znaleźć nowego domu, poświęcamy szczególną uwagę. Nasi stali mieszkańcy
                    otrzymują opiekę i wsparcie, na jakie zasługują.</p>
            </div>
        </div>
    </div>
</section>

<!--Galeria-->
<section class="page-section bg-light" id="galeria">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Zwierzęta do adopcji</h2>
            <h3 class="section-subheading">Adoptuj, nie kupuj!<br> Poszczególni pupile dostępni są do adopcji. Może to właśnie Ty staniesz się czyimś całym światem!</h3>
            <div id="zawartosc_galerii"></div>
        </div>
    </div>
</section>

<!-- zdjęcia piesków z podglądem-->
<div id="modals"></div>


<!-- SKRYPTY DO BOOTSTRAPA -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>



<!-- Stopka-->
<footer class="footer py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-start">Copyright &copy; Schronisko „Pod Łapą”</div>

            <div class="col-lg-4 my-3 my-lg-0">
                <p>ul.Gliniana 23 <br>Lublin 20-618</p>
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i></a>
            </div>

            <div class="col-lg-4 text-lg-end">
                <a class="link-dark text-decoration-none me-3" href="#">Privacy Policy</a>
                <a class="link-dark text-decoration-none" href="#">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
