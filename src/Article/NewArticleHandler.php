<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\User;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class NewArticleHandler
{
    private $slug;
    private $user;
    private $token;

    public function __construct(Registry $doctrine,SlugGenerator $slugGenerator, User $user, TokenStorage $token)
    {
        $this->slug=$slugGenerator;
        $this->user=$user;
        $this->token=$token;
        $this->em = $doctrine->getManager();
    }

    public function handle(Article $article): void
    {
        // Slugify le titre et ajoute l'utilisateur courant comme auteur de l'article
        // Log également un article stat avec pour action create.


        $slug = $this->slug->generate($article->getTitle());

        $article->setSlug($slug);

        $article->setUpdatedAt(new DateTime());

        $article->setCreatedAt(new DateTime());

        $article->setAuthor($this->token->getToken()->getUser());

        $this->em->persist($article);

        $this->em->flush();

    }
}
