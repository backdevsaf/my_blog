<?php

namespace App\Model;

use App\Entity\Post;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PostMessageModel
{

    public function __construct(
        private EntityManagerInterface $em,
        private ValidatorInterface $validator,

        ManagerRegistry $registry
    ) {
        $this->em = $registry->getManager();
    }

    public function beforeDecorator(array $data): array
    {
        return [
            'text' => $data['text'] ?? null,
        ];
    }

    public function validate(array $data): bool
    {
        return count($this->validator->validate($data, new Assert\Collection(['text' => new Assert\NotBlank()]))) === 0;
    }

    public function post(array $data): bool
    {
        $post = new Post();
        $post->setText($data['text']);
        $post->setCreatedDate(new DateTime());
        $this->em->persist($post);
        $this->em->flush();

        return true;
    }
}