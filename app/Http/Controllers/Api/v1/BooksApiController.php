<?php

namespace App\Http\Controllers\Api\v1;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\master\BooksMasterController;
use App\Http\Resources\BookResource;
use App\Http\Requests\StoreBookRequest;

class BooksApiController extends Controller
{

    private $bookMasterController;
    public function __construct(BooksMasterController $bookMasterController)
    {
        $this->bookMasterController = $bookMasterController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return BookResource::collection($this->bookMasterController->index($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new BookResource($this->bookMasterController->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource(($this->bookMasterController->show($book)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        return new BookResource($this->bookMasterController->update($request, $book));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        return new BookResource($this->bookMasterController->destroy($book));
    }
}
