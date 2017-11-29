<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Registry;

class UpdateArticleHandler
{
    private $slug;

    public function __construct(Registry $doctrine,SlugGenerator $slugGenerator)
    {
        $this->slug=$slugGenerator;
        $this->em = $doctrine->getManager();
    }

    public function handle(Article $article)
    {
        // Slugify le titre et met à jour la date de mise à jour de l'article
        // Log également un article stat avec pour action update.

        $slug = $this->slug->generate($article->getTitle());

        $article->setSlug($slug);

        $article->setUpdatedAt(new DateTime());

        $this->em->persist($article);

        $this->em->flush();


    }
}
