<?php

namespace App\Http\Controllers\Api\v1;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Master\ArticleMasterController;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Requests\DestroyArticleRequest;

class ArticleApiController extends Controller
{

    private $articleMasterController;
    public function __construct(ArticleMasterController $articleMasterController)
    {
        $this->articleMasterController = $articleMasterController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ArticleResource::collection($this->articleMasterController->index($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        return new ArticleResource($this->articleMasterController->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return new ArticleResource($this->articleMasterController->show($article));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        return new ArticleResource($this->articleMasterController->update($request, $article));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        return new ArticleResource($this->articleMasterController->destroy($article));
    }
}
