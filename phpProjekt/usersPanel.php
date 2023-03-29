<?php
include_once 'klasy/Baza.php';
include_once 'klasy/User.php';
include_once 'klasy/UserManager.php';

$db = new Baza("localhost", "root", "", "clients");
$um = new UserManager();
session_start();
$session_id = session_id();
$id = $um->getLoggedInUser($db, $session_id);
$message=false;
if ($id > 0) {
    $pola = ['name', 'surname', 'email', 'telephone', 'date'];
    $dane = $db->select("SELECT name, surname, email, telephone, date FROM users WHERE id = '$id';", $pola);
    if (filter_input(INPUT_POST, 'deleteUser', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
            if($um->deleteUser($db,$id)) {
                header("location:loginProcess.php?akcja=wyloguj");
             }
              else {
                  $message=true;
              }
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
            </li>
        </ul>
    </div>
</nav>

<div>
    <h1 class="text-center py-5">Witamy!</h1>
    <div class="container">
        <div class="row py-4 align-items-start gx-4 text-center">
            <div class="col-lg mb-5 text-center">
                <img src="assets/usersPanelDog.jpg" class="w-100 card shadow-lg border-dark" alt = "...">
            </div>
            <div class="col-lg mb-5 py-5">
                <div class="card-header bg-light text-center text-dark">
                    <h3>Twoje dane</h3>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    echo'<tr>
                        <th scope="row">1</th>
                        <td>Imię: </td>
                        <td>' . $dane['name'] . '</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Nazwisko: </td>
                        <td>' . $dane['surname'] . '</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>E-mail: </td>
                        <td>' . $dane['email'] . '</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Telefon: </td>
                        <td>' . $dane['telephone'] . '</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Data rejestracji: </td>
                        <td>' . $dane['date'] . '</td>
                    </tr>';
                    ?>
                    </tbody>
                </table>

                <div class="modal" tabindex="-1" id="editData">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">EDYTUJ DANE</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="usersPanel.php">
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-outline">
                                            <input name="name" type="text" id="name" required pattern="[A-Za-ząćęłńóśźżĄĘŁŃÓŚŹŻ ]{3,}[^a-zA-ZąćęłńóśźżĄĘŁŃÓŚŹŻ]{0,}" value=<?php echo $dane['name']; ?> class="form-control" />
                                            <label class="form-label" for="name">Imię</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-outline">
                                            <input name="surname" type="text" id="surname" required pattern="[A-Za-ząćęłńóśźżĄĘŁŃÓŚŹŻ]{3,}" value=<?php echo $dane['surname']; ?> class="form-control" />
                                            <label class="form-label" for="surname">Nazwisko</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-outline">
                                            <input name="email" type="email" id="mail" class="form-control"  value=<?php echo $dane['email']; ?> required />
                                            <label class="form-label" for="mail">E-mail</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-outline">
                                            <input name="telephone" type="tel" id="phone" required pattern="[0-9]{9}" value=<?php echo $dane['telephone']; ?> class="form-control" />
                                            <label class="form-label" for="phone">Numer telefonu</label>
                                        </div>
                                    </div>
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                        <input name="editData" type="submit" class="btn btn-primary" value="Zapisz zmiany"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal" tabindex="-1" id="deleteUser">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">USUŃ KONTO</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="usersPanel.php">
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-outline">
                                                <label class="form-label" for="password">Wpisz aktualne hasło:</label>
                                                <input name="password" type="password" id="password" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                                        <input name="deleteUser" type="submit" class="btn btn-primary" value="Zatwierdź"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if (filter_input(INPUT_POST, 'editData', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {

                    if ($um->editData($db,$id)) {
                        echo '<div class="alert alert-success" role="alert">Zmiany zostały zapisane!</div>';
                    }
                    else {
                        echo '<div class="alert alert-danger" role="alert">Próba edycji nie powiodła się!</div>';
                    }
                }
                if($message){
                    echo '<div class="alert alert-danger" role="alert">Usunięcie konta nie powiodło się!</div>';
                }
                ?>
                <div class="row py-4">
                    <div class="col mb-5 text-center">
                        <button type="button" class="btn btn-group-sm btn-lg border-dark" data-bs-toggle="modal" data-bs-target="#editData">Edytuj dane</button>
                    </div>
                    <div class="col mb-5 text-center">
                        <button type="button" class="btn btn-group-sm btn-lg border-dark" data-bs-toggle="modal" data-bs-target="#deleteUser">Usuń konto</button>
                    </div>
                </div>
                <div class="col-lg mb-5 text-right">
                    <img src="assets/pawprint.png" class="w-50" alt = "...">
                </div>
            </div>
        </div>
    </div>
</div>

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
<?php
} else {
    header("location:loginProcess.php");
}
?>
