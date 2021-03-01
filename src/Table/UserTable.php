<?php

namespace App\Table;

use App\Model\User;
use \PDO;
use App\Table\Exception\NotFoundException;

final class UserTable extends Table
{
    protected $table = "user";
    protected $class = User::class;

    public function findByUsername(string $username)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE username=:username OR email=:username');
        $query->execute(['username' => $username]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if ($result === false) {
            throw new NotFoundException($this->table, $username);
        }
        return $result;
    }
    public function allUsers(): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_user!=1";
        return  $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }

    public function deleteUser(int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id_user= ?");
        $ok = $query->execute([$id]);
        if ($ok === false) {
            throw new \Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table} ");
        }
    }

    function  str_random($length)
    {
        $alphabet = "0123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn";
        return substr(str_shuffle(str_repeat($alphabet,$length)),0,$length);
    }
   
}
