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
            <li class="nav-item active">
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
            </li>
        </ul>
    </div>
</nav>

<!-- Rejestracja-->
<section class="page-section" id="rejestracja">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Rejestracja</h2>
            <h3 class="section-subheading">Korzystając z formularza poniżej, możesz się zarejestrować! <br> Znajdź pupila dla siebie już dzisiaj!</h3>
        </div>

        <form id="vol_form" method="post" action="registration.php">
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input name="name" type="text" id="name" required pattern="[A-Za-ząćęłńóśźżĄĘŁŃÓŚŹŻ ]{3,}[^a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]{0,}" placeholder="Podaj swoje imię" class="form-control" />
                        <label class="form-label" for="name">Imię</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-outline">
                        <input name="surname" type="text" id="surname" required pattern="[A-Za-ząćęłńóśźżĄĘŁŃÓŚŹŻ]{3,}" placeholder="Podaj swoje nazwisko" class="form-control" />
                        <label class="form-label" for="surname">Nazwisko</label>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input name="email" type="email" id="mail" class="form-control" required placeholder="Podaj swój adres e-mail"/>
                        <label class="form-label" for="mail">E-mail</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-outline">
                        <input name="telephone" type="tel" id="phone" required pattern="[0-9]{9}" placeholder="XXXXXXXXX" class="form-control" />
                        <label class="form-label" for="phone">Numer telefonu</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input name="password" type="password" id="password" class="form-control" required placeholder="Stwórz hasło"/>
                        <label class="form-label" for="password">Hasło</label>

                    </div>
                </div>
            </div>
            <input name="submit" value ="Zarejestruj się" id="form_submit" type="submit" class="btn btn-primary text-dark btn-block mb-4">
        </form>


<!--SKRYPT REJESTRACJI-->
<?php
include 'klasy/User.php';
include 'klasy/Baza.php';
include 'klasy/RegistrationForm.php';


$rf = new RegistrationForm();
$bd = new Baza("localhost", "root", "", "clients");

if (filter_input(INPUT_POST, 'submit',FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    $user = $rf->checkUser();
    if ($user === NULL)
        echo '<div class="alert alert-danger" role="alert">Próba rejestracji zakończona niepowodzeniem! Sprawdź poprawność wprowadzonych danych.</div>';
    else {
        $user->saveDB($bd);
        echo '<div class="alert alert-success" role="alert">Udało Ci się zarejestrować! Prosimy o pierwsze zalogowanie się.</div>';
    }
}
?>
    </div>
</section>

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

