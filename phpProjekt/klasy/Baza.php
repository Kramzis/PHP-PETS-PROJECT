<?php
class Baza {
    private $mysqli;

    public function __construct($serwer, $user, $pass, $baza) {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
        if ($this->mysqli->connect_errno) {
            printf("Nie udało sie połączyc z serwerem: %s\n", $this->mysqli->connect_error);
            exit();
        }
        if($this->mysqli->set_charset("utf8")) {
        }
    }

    function __destruct() {
        $this->mysqli->close();
    }

    public function select($sql, $pola) {
        if ($result = $this->mysqli->query($sql)) {
            $tresc = array();
            $ilepol = count($pola);
            while ($row = $result->fetch_object()) {
                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    $tresc[$p]=$row->$p;
                }
            }
            $result->close();
        }
        return $tresc;
    }

    public function delete($sql) {
        if($this->mysqli->query($sql)) return true; else return false;
    }

    public function insert($sql) {
        if($this->mysqli->query($sql)) return true; else return false;
    }
    public function runsql($sql) {

        return $this->mysqli->query($sql);
    }

    public function getMysqli() {
        return $this->mysqli;
    }

    public function update($sql){
        if($this->mysqli->query($sql)) return true; else return false;
    }
    public function selectUser($login, $password, $tabela) {
        $id = -1;
        $sql = "SELECT * FROM $tabela WHERE email='$login'";
        if ($result = $this->mysqli->query($sql)) {
            $ile = $result->num_rows;
            if ($ile == 1) {
                $row = $result->fetch_object();
                $hash = $row->password;
                if (password_verify($password, $hash))
                    $id = $row->id;
            }
        }
        return $id;
    }
    public function reservationsTable($sql, $pola) {
        $tresc="";
        if ($result = $this->mysqli->query($sql)) {
            $ilepol = count($pola);
            $ile = $result->num_rows;
            if($ile==0){
                $tresc= "<h3 class='text-center py-4'>Brak rezerwacji</h3>";
                return $tresc;
            }
            $tresc.="<table class='table'><tbody>
            <tr><th>ID REZERWACJI</th>
            <th>GATUNEK</th>
            <th>PŁEĆ</th>
            <th>WIELKOŚĆ</th>
            <th>WIEK</th>
            <th>USPOSOBIENIE</th>
            <th>TYP SIERŚCI</th>
            <th>STATUS REZERWACJI</th></tr>";
            while ($row = $result->fetch_object()) {
                $tresc.="<tr>";
                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    $tresc.="<td>" . $row->$p . "</td>";
                }
                $tresc.="</tr>";
            }
            $tresc.="</table></tbody>";
            $tresc.="<form class='container' method='post' action='myReservations.php'>
            <label class='form-label' for='chosenRecord'>Wybierz rezerwację do usunięcia:</label>
            </br>
            <input name='chosenRecord' id='chosenRecord' width='1%' class='small' required/></br>
            <div class='py-2'>
            <input name='delete' type='submit' class='btn btn-group-sm btn-sm border-dark' value='Usuń rezerwację'>
            </div>
            </form>";
            $result->close();
        }
        return $tresc;

    }
}
