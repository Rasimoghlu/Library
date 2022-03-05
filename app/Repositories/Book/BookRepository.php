<?php


namespace App\Repositories\Book;

use App\Http\Resources\BookResource;
use App\Interfaces\Book\BookRepositoryInterface;
use App\Models\Book;
use App\Traits\CreateAuthorTrait;
use App\Traits\UpdateAuthorTrait;
use Illuminate\Http\JsonResponse;

class BookRepository implements BookRepositoryInterface
{
    protected const AUTHORS = 'authors';
    protected const BOOK_HOUSE = 'bookHouse';
    protected const NAME = 'name';
    protected const AUTHOR_NAME = 'author_name';
    protected const BOOK_HOUSE_ID = 'book_house_id';
    protected const CREATE_AUTHOR = 'createAuthor';
    protected const UPDATE_AUTHOR = 'updateAuthor';
    protected const PUT = 'PUT';

    use CreateAuthorTrait, UpdateAuthorTrait;

    /**
     * @return JsonResponse
     */
    public function booksList(): JsonResponse
    {
        return BookResource::collection(Book::with([self::AUTHORS, self::BOOK_HOUSE])->paginate(20))->response();
    }

    /**
     * @param $request
     * @return BookResource
     */
    public function store($request): BookResource
    {
        $book = Book::create([self::NAME => $request[self::NAME], self::BOOK_HOUSE_ID => auth()->user()->bookHouse->id]);

        $this->storeOrUpdateMultipleAuthors($book, $request[self::AUTHORS], self::CREATE_AUTHOR);

        return new BookResource($book->loadMissing([self::AUTHORS, self::BOOK_HOUSE]));
    }

    /**
     * @param $request
     * @param $book
     * @param $requestMethod
     * @return BookResource
     */
    public function update($request, $book, $requestMethod): BookResource
    {
        $book->update([self::NAME => $request[self::NAME]]);

        $this->storeOrUpdateMultipleAuthors($book, $request[self::AUTHORS], self::UPDATE_AUTHOR, $requestMethod);

        return new BookResource($book->loadMissing([self::AUTHORS, self::BOOK_HOUSE]));
    }

    /**
     * @param $book
     * @return mixed|void
     */
    public function destroy($book)
    {
        $book->delete();

        return ['success' => 'The book deleted successfully'];
    }

    /**
     * @param $book
     * @param $authors
     * @param $method
     * @param $requestMethod
     */
    public function storeOrUpdateMultipleAuthors($book, $authors, $method, $requestMethod = null): void
    {
        $collectAuthors = collect();

        if ($requestMethod !== self::PUT) {
            foreach ($authors as $author) {
                $collectAuthors->put($author[self::AUTHOR_NAME], $this->$method($author[self::AUTHOR_NAME]));
            }

            $this->storeAuthorBook($book, $collectAuthors->pluck('id')->toArray());
        }

        $this->$method($book, $authors);
    }

    /**
     * @param $book
     * @param $authorIds
     * @return void
     */
    public function storeAuthorBook($book, $authorIds): void
    {
        $book->authors()->sync($authorIds);
    }

}
