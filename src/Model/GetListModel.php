<?php

namespace App\Model;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class GetListModel
{
    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManager();
    }

    public function getList(): array
    {
        $posts = $this->em
            ->getRepository(Post::class)
            ->findBy([], ['createdDate' => 'DESC']);

        return array_map(
            fn(Post $post) => [
                'id'          => $post->getId(),
                'text'        => $post->getText(),
                'createdDate' => $post->getCreatedDate()->format('d.m.Y H:i:s'),
            ],
            $posts
        );
    }
}