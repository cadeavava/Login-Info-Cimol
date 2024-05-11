<?php
namespace app\classes;

use app\database\models\User;


class Login {

    public function login($email, $senha)
    {
        $user = new User;

        $userFound = $user->getUserByEmail($email);

        if (!$userFound)
        {
            return false;
        }

        if(password_verify($senha, $userFound['senha'])) {
            $_SESSION['user_logged_data'] = [
                'email' => $email,
                'nome' => $userFound['nome']
            ];
            $_SESSION['is_logged_in'] = true;
            return true;
        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['user_logged_data'], $_SESSION['is_logged_in']);
        session_destroy();
    }
}