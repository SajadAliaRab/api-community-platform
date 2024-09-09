<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isExpert();
    }

    public function view(User $user, Article $article)
    {
        return $user->isAdmin() || $article->author_id === $user->id ;
    }

    public function create(User $user)
    {
        return $user->isAdmin() || $user->isExpert();
    }

    public function update(User $user, Article $article)
    {
        return $user->isAdmin() || $article->author_id === $user->id ;
    }

    public function delete(User $user, Article $article)
    {
        return $user->isAdmin() || $article->author_id === $user->id ;
    }

    public function __construct()
    {
        //
    }
}
