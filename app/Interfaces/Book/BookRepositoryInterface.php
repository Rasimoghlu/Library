<?php


namespace App\Interfaces\Book;


use Illuminate\Http\JsonResponse;

interface BookRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function booksList(): JsonResponse;

    /**
     * @param $request
     * @return mixed
     */
    public function store($request);

    /**
     * @param $request
     * @param $book
     * @param $requestMethod
     * @return mixed
     */
    public function update($request, $book, $requestMethod);

    /**
     * @param $book
     * @return mixed
     */
    public function destroy($book);

    /**
     * @param $book
     * @param $authorIds
     * @return void
     */
    public function storeAuthorBook($book, $authorIds): void;

    /**
     * @param $book
     * @param $authors
     * @param $method
     * @param $request
     * @return void
     */
    public function storeOrUpdateMultipleAuthors($book, $authors, $method, $requestMethod = null): void;

}
