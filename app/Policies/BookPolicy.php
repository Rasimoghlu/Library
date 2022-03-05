<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * It would be possible to use the same methods here, but in the future I will write separately for the end. (google translation :D )
     */

    /**
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function canUpdate(User $user, Book $book): bool
    {
        return optional($user->bookHouse)->id === $book->book_house_id;
    }

    /**
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function canDelete(User $user, Book $book): bool
    {
        return optional($user->bookHouse)->id === $book->book_house_id;
    }
}
