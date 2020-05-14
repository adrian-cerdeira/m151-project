<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\db;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemsRepository")
 */
class Items
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $amount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAll()
    {
        return $this->connection()->query('SELECT id, name, amount FROM ac_items');
    }

    public function getById(int $id)
    {
        $item = new Items();
        $connection = $this->connection();
        $statement = $connection->prepare('SELECT * FROM ac_items WHERE id = ?');
        $statement->bind_param('i', $id);

        mysqli_stmt_execute($statement);

        $statement->bind_result($id, $name, $amount);
        $statement->fetch();

        $item->setName($name);
        $item->setAmount($amount);

        mysqli_stmt_close($statement);
        mysqli_close($connection);

        return $item;
    }

    public function create(): void
    {
        $connection = $this->connection();
        $statement = $connection->prepare('INSERT INTO ac_items (name, amount) VALUES (?, ?)');
        $name = $this->getName();
        $amount = $this->getAmount();
        $statement->bind_param('si', $name, $amount);

        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
        mysqli_close($connection);
    }

    public function update(int $id): void
    {
        $connection = $this->connection();
        $statement = $connection->prepare('UPDATE ac_items SET name=?, amount=? WHERE id=?');

        $name = $this->getName();
        $amount = $this->getAmount();
        $statement->bind_param('sii', $name, $amount, $id);

        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
        mysqli_close($connection);
    }

    public function delete(int $id): void
    {
        $connection = $this->connection();
        $statement = $connection->prepare('DELETE FROM ac_items WHERE id = ?');
        $statement->bind_param('i', $id);

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
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die('Connect failed: %s\n' . $conn->error);

        return $conn;
    }
}
