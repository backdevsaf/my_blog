<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: "App\Repository\PostRepository")]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(
        name: 'id',
        type: Types::INTEGER,
        options: [
            'unsigned' => true,
            'comment'  => 'Уникальный идентификатор',
        ]
    )]
    private int $id;

    #[ORM\Column(
        name: 'text',
        type: Types::STRING,
        length: 512,
        nullable: false,
        options: [
            'comment' => 'Текст',
        ]
    )]
    private string $text;

    #[ORM\Column(
        name: 'created_date',
        type: Types::DATETIME_MUTABLE,
        nullable: false,
        options: [
            'comment' => 'Дата создания',
        ]
    )]
    private DateTimeInterface $createdDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): static
    {
        $this->createdDate = $createdDate;

        return $this;
    }
}