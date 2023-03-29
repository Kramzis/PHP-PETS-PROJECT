<?php
include_once 'klasy/Baza.php';
include_once 'klasy/User.php';
include_once 'klasy/UserManager.php';

$db = new Baza("localhost", "root", "", "clients");
$um = new UserManager();
session_start();
$session_id = session_id();
$id = $um->getLoggedInUser($db, $session_id);
if ($id > 0) {
$pola = ['name', 'surname', 'email', 'telephone', 'date'];
$dane = $db->select("SELECT name, surname, email, telephone, date FROM users WHERE id = '$id';", $pola);
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
                <<a class="nav-link" href="loginProcess.php?akcja=wyloguj">Wyloguj się</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Rezerwacja-->
<section class="page-section" id="rejestracja">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Formularz rezerwacji</h2>
            <h3 class="section-subheading">Korzystając z formularza poniżej, możesz zapisać swoje preferencje, by pierwszy taki zwierzak trafił właśnie do Ciebie! <br>Odnajdź swoją bratnią duszę!</h3>
        </div>

        <form id="vol_form" method="post" action="reservation.php">
            <div class="col-lg mb-5 py-0">
                <div class="card-header bg-light text-center text-dark">
                    <h3>Preferencje</h3>
                </div>
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    echo'
                    <tr>
                        <th scope="row"></th>
                        <td>Wybierz gatunek: </td>
                        <td><input type="radio" id="specie1" name="species" value="pies" checked/>
                        <label for="specie1">pies</label>

                        <input type="radio" id="specie2" name="species" value="kot" />
                        <label for="specie2">kot</label></td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>Wybierz płeć: </td>
                        <td><input type="radio" id="animalSex1" name="animalSex" value="męska" checked/>
                        <label for="animalSex1">męska</label>

                        <input type="radio" id="animalSex2" name="animalSex" value="żeńska" />
                        <label for="animalSex2">żeńska</label></td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>Wybierz wielkość: </td>
                        <td>
                        <input type="radio" id="animalSize3" name="animalSize" value="mały" checked/>
                        <label for="animalSize3">mały/a</label>
                        <input type="radio" id="animalSize2" name="animalSize" value="średni" />
                        <label for="animalSize2">średni/a</label>
                        <input type="radio" id="animalSize1" name="animalSize" value="duży" />
                        <label for="animalSize1">duży/a</label>
                     </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>Wybierz preferowany wiek: </td>
                        <td><input type="radio" id="animalAge1" name="animalAge" value="młody" checked/>
                        <label for="animalSize1">młody/a</label>

                        <input type="radio" id="animalAge2" name="animalAge" value="dorosły" />
                        <label for="animalSize2">dorosły/a</label>
                        
                        <input type="radio" id="animalAge3" name="animalAge" value="staruszek" />
                        <label for="animalSize3">senior/ka</label></td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>Określ usposobienie: </br>
                        (Wybierz w każdej parze jedną z opcji)</td>
                        <td>
                        <div>
                        <input type="radio" id="animalTrait1" name="animalTrait1" value="spokojny" checked/>
                        <label for="animalTrait1">spokojny/a</label>
                        <input type="radio" id="animalTrait2" name="animalTrait1" value="energetyczny" />
                        <label for="animalTrait2">energetyczny/a</label>                  
                        </div>
                    
                        <div>
                        <input type="radio" id="animalTrait3" name="animalTrait2" value="przyjacielski" checked/>
                        <label for="animalTrait3">przyjacielski/a</label>
                        <input type="radio" id="animalTrait4" name="animalTrait2" value="samotnik" />
                        <label for="animalTrait4">samotnik/czka</label>   
                        </div>
                        
                        <div>
                        <input type="radio" id="animalTrait5" name="animalTrait3" value="leniuszek" checked/>
                        <label for="animalTrait5">leniuszek</label>
                        <input type="radio" id="animalTrait6" name="animalTrait3" value="aktywny" />
                        <label for="animalTrait6">aktywny/a</label> 
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>Typ sierści: </td>
                        <td><input type="radio" id="animalCoat1" name="animalCoat" value="sierść" checked>
                        <label for="animalCoat1">sierść</label>

                        <input type="radio" id="animalCoat2" name="animalCoat" value="włosy" />
                        <label for="animalCoat2">włosy</label></td>
                    </tr>';
                    ?>
                    </tbody>
                </table>
            <div class="container text-center">
            <input name="submit" value ="Zarezerwuj" id="form_submit" type="submit" class="btn btn-primary text-dark btn-block mb-4 text-center">
            </div>
        </form>


        <!--SKRYPT REJESTRACJI-->
        <?php
        include 'klasy/Reservation.php';

        $rn = new Reservation();

        if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
            if ($rn->saveToDB($db,$id)) {
                echo '<div class="alert alert-success" role="alert">
                 Rezerwacja przebiegła pomyślnie!</div>';
            }
            else {
                echo '<div class="alert alert-danger" role="alert">
                Próba rezerwacji nie powiodła się!</div>';
            }
        }
        ?>
    </div>
</section>

<!-- SKRYPTY DO BOOSTRAPA -->
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
    <?php
} else {
    header("location:loginProcess.php");
}
?>
