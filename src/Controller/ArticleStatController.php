<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleStat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/stats")
 */
class ArticleStatController extends Controller
{
    /**
     * @Route(path="/", name="stats")
     */
    public function showAction()
    {
        // Seul les auteurs doivent avoir access.

    }
}
