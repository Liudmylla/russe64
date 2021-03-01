<?php
namespace App\Model;

class User {
    private $id_user;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;

    private $email;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of username
     *
     * @return  string
     */ 
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  string  $username
     *
     * @return  self
     */ 
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }
    public function all(): array
    {
        $sql = "SELECT * FROM user";
        return  $this->pdo->query($sql, \PDO::FETCH_CLASS, $this->class)->fetchAll();
    }
}