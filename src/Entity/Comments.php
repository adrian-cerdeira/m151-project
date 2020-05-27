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

    public function getCommentsByItemId(int $itemId)
    {
        $connection = $this->connection();
        $statement = $connection->prepare('SELECT id, comment, itemId, userId FROM ac_comments WHERE itemId = ?');
        $statement->bind_param('i', $itemId);

        mysqli_stmt_execute($statement);

        return $statement->get_result();
    }

    public function create(): void
    {
        $connection = $this->connection();
        $statement = $connection->prepare('INSERT INTO ac_comments (comment, itemId, userId) VALUES (?, ?, ?)');
        $comment = $this->getComment();
        $itemId = $this->getItemId();
        $userId = $this->getUserId();
        $statement->bind_param('sii', $comment, $itemId, $userId);

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
