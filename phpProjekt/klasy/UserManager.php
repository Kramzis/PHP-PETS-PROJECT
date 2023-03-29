<?php
class UserManager
{
    function loginForm() {
    }
    function login($db) {
        $args = [
            'login' => FILTER_SANITIZE_ADD_SLASHES,
            'password' => FILTER_SANITIZE_ADD_SLASHES
        ];
        $dane = filter_input_array(INPUT_POST, $args);
        $login = $dane["login"];
        $password = $dane["password"];
        $userId = $db->selectUser($login, $password, "users");
        if($userId >= 0){
            session_start();
            $date = (new DateTime())->format("Y-m-d");
            $db->delete("DELETE FROM logged_in_users WHERE userId = $userId");
            $session_id = session_id();
            $sql = "INSERT INTO logged_in_users "
                . "(sessionId, userId, lastUpdate) "
                . "VALUES ('$session_id', '$userId', '$date')";
            if($db->insert($sql))
                return $userId;
        }
            else {
            return -1;
            }
    }
    function logout($db) {
        session_start();
        $session_id = session_id();
        $_SESSION = [];
        if (filter_input(INPUT_COOKIE,session_name())){
            setcookie(session_name(), '', time() - 42000, '/');
        }
        $sql = "DELETE FROM logged_in_users WHERE sessionId = '$session_id'";
        if($db->delete($sql)) {
            return true;
        }
        else {
            return false;
        }
        session_destroy();
    }
    function getLoggedInUser($db, $sessionId) {
        $id = -1;
        $sql = "SELECT userId FROM logged_in_users WHERE sessionId = '";
        if($result = $db->getmysqli()->query($sql . $sessionId . "'") ) {
            if($data = $result->fetch_object()){
                $id = $data->userId;
            }
        }
        return $id;
    }

    function editData($db, $userId)
    {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];

        if($db->update("UPDATE users SET name='$name', surname='$surname', email='$email', telephone='$telephone' WHERE id = '$userId';")){
            return true;
        } else {
            return false;
        }
    }

    function deleteUser($db, $userId)
    {
        $password = $_POST['password'];
        $sql = "SELECT password FROM users WHERE id='$userId';";
        if ($result = $db->runsql($sql)) {
            $ile = $result->num_rows;
            if ($ile == 1) {
                $row = $result->fetch_object();
                $hash = $row->password;
                if (password_verify($password, $hash))
                    if($db->delete("DELETE FROM reservations WHERE userId='$userId';") and $db->delete("DELETE FROM users WHERE id='$userId';")){
                        return true;
                    } else {
                        return false;
                    }
            }
        }
    }
}
