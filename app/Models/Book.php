<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $array)
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = ['book_house_id', 'name'];

    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function bookHouse(): belongsTo
    {
        return $this->belongsTo(BookHouse::class, 'book_house_id', 'id');
    }

}
