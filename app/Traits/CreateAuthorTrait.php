<?php


namespace App\Traits;


use App\Models\Author;

trait CreateAuthorTrait
{
    public function createAuthor($author)
    {
        return Author::create([self::NAME => $author]);
    }
}
