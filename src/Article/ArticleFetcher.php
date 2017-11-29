<?php

namespace App\Article;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ArticleFetcher
{
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    public function fetch()
    {
        $articles = $this->doctrine->getManager()->getRepository(Article::class)->findAll();
        return $articles;
    }
    public function fetchBySlug($slug)
    {
        $articles = $this->doctrine->getManager()->getRepository(Article::class)->findOneBy(['slug'=>$slug]);
        return $articles;
    }
}