<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
        return $this->connection()->query("SELECT id, name, amount FROM ac_items");
    }

    public function create(Items $item): void
    {
        $connection = $this->connection();
        $connection->query("INSERT INTO ac_items (name, amount) VALUES  (" . $item->getName() . "," . $item->getAmount() . ")");
        $connection->close();
    }

    public function connection()
    {
        $dbhost = "login-67.hoststar.ch";
        $dbuser = "inf17d";
        $dbpass = "j5TQh!zmMtqsjY3";
        $db = "inf17d";
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

        return $conn;
    }
}
