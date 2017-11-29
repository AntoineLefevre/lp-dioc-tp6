<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ViewArticleHandler
{
    public function __construct(Registry $doctrine, CountViewUpdater $counter, ArticleStatsLogger $articleLog)
    {
        $this->articleLog = $articleLog;
        $this->em = $doctrine->getManager();
        $this->counter = $counter;
    }
    public function handle(Article $article)
    {
        $article = $this->counter->update($article);

        $this->em->persist($article);
        $this->em->flush();

        $this->articleLog->log($article, ArticleStat::VIEW);
    }
}
