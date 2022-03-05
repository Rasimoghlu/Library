<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 */
class BookHouse extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name'];

    protected $hidden = ['created_at', 'updated_at'];

    public function books(): hasMany
    {
        return $this->hasMany(Book::class, 'book_house_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
