<?php
namespace app\classes;

class Validate
{
    private $errors = [];

    public function exists($email, $senha)
    {
        if(empty($email))
        {
            $this->errors['email'] = "O campo de e-mail é obrigatório";
        }
        
        if(empty($senha))
        {
            $this->errors['senha'] = "O campo de senha é obrigatório";
        }
        return $this;
    }

    public function emailCadastrado($model, $email)
    {
        $field = 'email';
        $user = $model->getUserByEmail($email);

        if(!$user)
        {
            $this->errors[$field] = "Email não cadastrado";
        }
        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}