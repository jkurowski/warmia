<?php

namespace App\Http\Controllers\Front\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;
use App\Repositories\ArticleRepository;

class IndexController extends Controller
{
    private $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view(('front.client.index'), [
            'page' => Page::find(6),
            'list' => $this->repository->idDesc()
        ]);
    }

    public function show($lang, $slug)
    {
        $article = Article::whereSlug($slug)->firstOrFail();
        return view(('front.client.show'), [
            'page' => Page::find(6),
            'article' => $article
        ]);
    }
}
