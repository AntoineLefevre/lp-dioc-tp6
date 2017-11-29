<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class ArticleStatsLogger
{
    public function __construct(Registry $doctrine, CountViewUpdater $counter, TokenStorage $token, RequestStack $request)
    {
        $this->user = $token->getToken()->getUser();
        $this->em = $doctrine->getManager();
        $this->counter = $counter;
        $this->clientIp = $request->getCurrentRequest()->getClientIp();
    }

    public function log($article, $action)
    {
        $articleStat = new ArticleStat($action, $article, new \DateTime(), $this->clientIp, $this->user);
        $this->em->persist($articleStat);
        $this->em->flush();
    }
}