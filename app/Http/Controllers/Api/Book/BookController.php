<?php

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Interfaces\Book\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    private BookRepositoryInterface $bookRepository;

    protected const CAN_UPDATE = 'canUpdate';
    protected const CAN_DELETE = 'canDelete';

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->bookRepository->booksList();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookStoreRequest $request
     */
    public function store(BookStoreRequest $request)
    {
        return $this->bookRepository->store($request->validated());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookUpdateRequest $request
     * @param Book $book
     * @return Response
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $this->authorize(self::CAN_UPDATE, $book);

        return $this->bookRepository->update($request->validated(), $book, $request->method());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book $book
     * @return Response
     */
    public function destroy(Book $book)
    {
        $this->authorize(self::CAN_DELETE, $book);

        return $this->bookRepository->destroy($book);
    }
}
