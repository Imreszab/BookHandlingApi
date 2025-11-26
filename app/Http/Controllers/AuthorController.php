<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
      public function store(AuthorRequest $request)
    {
        $request->validated();
        $author = Author::create([
           'name' => $request->name,
       ]);

       return new AuthorResource($author);
    }
      public function index() {
        return AuthorResource::collection(
            Author::all()
        );
    }
}
