<?php

class User
{
    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;
    private $name;
    private $surname;
    private $email;
    private $telephone;
    private $password;
    private $date;

    function __construct($name, $surname, $email, $telephone, $password){
        $this->status=User::STATUS_USER;
        $this->name=$name;
        $this->surname=$surname;
        $this->email=$email;
        $this->telephone=$telephone;
        $this->date=(new DateTime())->format("Y-m-d");
        $this->password=password_hash($password, PASSWORD_DEFAULT);
    }

    public function show() {
        echo("Dane uzytkownika: <br />
        Imie: $this->name <br />
        Nazwisko: $this->surname <br />
        E-mail: $this->email <br/>
        Nr telefonu: $this->telephone <br />
        Status: $this->status <br />
        Data utworzenia: $this->date <br />");
    }

    function toArray(){
        $arr=[
            "name" => $this->name,
            "surname" => $this->surname,
            "email" => $this->email,
            "telephone" => $this->telephone,
            "password" => $this->password,
            "status" => $this->status,
            "date" => $this->date,
        ];
        return $arr;
    }

    function saveDB($bd){
        $name = $this->name;
        $surname = $this->surname;
        $email = $this->email;
        $telephone = $this->telephone;
        $password = $this->password;
        $status = $this->status;
        $date = $this->date;
        $sql = "INSERT INTO users VALUES (NULL,'$name','$surname', '$email', '$telephone', '$password', '$status', '$date');";
        $bd->insert($sql);
    }

    static function getAllUsersFromDB($bd){
    $pola = ['id', 'name', 'surname', 'email', 'telephone', 'password', 'status', 'date'];
    echo $bd->select("SELECT * FROM users", $pola);
    }
}