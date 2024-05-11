<?php
namespace app\traits;

use PDO;
use PDOException;

trait Read
{
    public function getUserByEmail($email) {

        try {
            $statement = $this->connection->prepare("
            SELECT usuario.pessoa_id_pessoa, pessoa.nome, pessoa.cpf, usuario.senha, 
                COUNT(administrador.pessoa_id_pessoa) AS admin,
                COUNT(aluno.pessoa_id_pessoa) AS aluno,
                COUNT(professor.pessoa_id_pessoa) AS professor,
                COUNT(coord.professor_pessoa_id_pessoa) AS coordenador_curso,
                COUNT(pessoa.id_pessoa) AS pessoa 
            FROM pessoa 
            LEFT JOIN usuario ON usuario.pessoa_id_pessoa = pessoa.id_pessoa 
            LEFT JOIN administrador ON administrador.pessoa_id_pessoa = pessoa.id_pessoa 
            LEFT JOIN aluno ON aluno.pessoa_id_pessoa = pessoa.id_pessoa 
            LEFT JOIN professor ON professor.pessoa_id_pessoa = pessoa.id_pessoa 
            LEFT JOIN coordenacao AS coord ON coord.professor_pessoa_id_pessoa = pessoa.id_pessoa
            WHERE pessoa.email = :email
            GROUP BY usuario.pessoa_id_pessoa, pessoa.nome, pessoa.cpf
        ");
        
        $statement->bindParam(':email', $email);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
        
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}