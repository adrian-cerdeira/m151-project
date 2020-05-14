<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\db;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function register()
    {
        $salt = 'q%qAe"jyeE=vN{^';
        $connection = $this->connection();
        $statement = $connection->prepare("INSERT INTO ac_users (userName, password) VALUES (?, ?)");

        $userName = $this->getUserName();
        $password = md5($salt . $this->getPassword());
        $statement->bind_param('ss', $userName, $password);

        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
        mysqli_close($connection);
    }

    public function connection()
    {
        $environment = new db();
        $dbhost = $environment->getHost();
        $dbuser = $environment->getUser();
        $dbpass = $environment->getPass();
        $db = $environment->getDb();
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

        return $conn;
    }
}
