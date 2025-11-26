<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
     public function store(CategoryRequest $request)
    {
        $request->validated();
        $category = Category::create([
           'name' => $request->name,
       ]);

       return new CategoryResource($category);
    }
      public function index() {
        return CategoryResource::collection(
            Category::all()
        );
    }
}
