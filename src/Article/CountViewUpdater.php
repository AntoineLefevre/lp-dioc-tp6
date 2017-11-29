<?php

namespace App\Article;

use App\Entity\Article;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CountViewUpdater
{
    public function __construct(TokenStorage $token)
    {
        $this->user = $token->getToken()->getUser();
    }
    public function update(Article $article)
    {
        if($article->getAuthor() != $this->user){
            $article->setCountView($article->getCountView()+1);
        }
        return $article;
    }
}
