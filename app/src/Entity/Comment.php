<?php

/**
 * Comment entity.
 */

namespace App\Entity;

use DateTimeInterface;
use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 *
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 * @ORM\Table (name="comments")
 */
class Comment
{
    /**
     * Primary key.
     *
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Created at.
     *
     * @var \DateTimeInterface
     *
     * @ORM\Column(type="datetime")
     *
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * Content.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * Author.
     *
     * @ORM\Column (type="string", length=15)
     */
    private $author;

    /**
     * Email.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    /**
     * Getter for id.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for created at.
     *
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Setter for created at.
     *
     * @param DateTimeInterface $createdAt
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Getter for content.
     *
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Setter for content.
     *
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Getter for Author.
     *
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * Setter for Author.
     *
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * Getter for Email
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Setter for email
     *
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Getter for recipe
     *
     * @return Recipe|null
     */
    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    /**
     * Setter for recipe
     *
     * @param Recipe|null $recipe
     */
    public function setRecipe(?Recipe $recipe): void
    {
        $this->recipe = $recipe;
    }
}
