<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\db;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Comments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $comment;

    /**
     * @ORM\Column(type="integer")
     */
    private $itemId;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function setItemId(int $itemId): self
    {
        $this->itemId = $itemId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
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
