<?php

class RegistrationForm
{
    protected $user;

    function __construct(){
    }
    function checkUser()
    { $args = [
            'name' => ['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[A-Za-ząęłńśćźżó_-]{2,25}$/']],
            'surname' => ['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[A-Za-ząęłńśćźżó_-]{2,25}$/']],
            'email' => FILTER_VALIDATE_EMAIL,
            'telephone' => ['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/[0-9]{9}/']],
            'password' => ['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/']],
        ];

        $dane = filter_input_array(INPUT_POST, $args);
        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
                $errors .= $key . " ";
            }
        }

        if ($errors === "") {
        $this->user=new User($dane['name'], $dane['surname'],
            $dane['email'], $dane['telephone'], $dane['password']);
        } else {
        $this->user = NULL;
    }
    return $this->user;
    }
}
