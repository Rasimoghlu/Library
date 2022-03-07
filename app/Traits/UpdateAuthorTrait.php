<?php


namespace App\Traits;

use App\Models\Author;

trait UpdateAuthorTrait
{
    public function updateAuthor($book, $authors)
    {
        $book->loadMissing('authors');

        $bookAuthors = $book->authors->getIterator();

        foreach ($authors as $author) {
            $current = $bookAuthors->current();

            $current->update([self::NAME => $author[self::AUTHOR_NAME]]);

            $bookAuthors->next();

        }
    }

}
