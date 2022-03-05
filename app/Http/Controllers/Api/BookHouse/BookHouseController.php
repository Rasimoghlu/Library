<?php

namespace App\Http\Controllers\Api\BookHouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookHouseStoreRequest;
use App\Http\Resources\BookHouseResource;
use App\Models\BookHouse;

class BookHouseController extends Controller
{
    public function index(BookHouse $bookHouse)
    {
        return new BookHouseResource($bookHouse->loadMissing('books'));
    }

    public function store(BookHouseStoreRequest $request)
    {
        $validated = $request->validated();

        $bookHouse = BookHouse::create(['name' => $validated['name'], 'user_id' => auth()->id()]);

        return new BookHouseResource($bookHouse->loadMissing('books'));
    }

}
