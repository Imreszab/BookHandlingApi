<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Models\Category;

class StatisticController extends Controller
{
    public function aboveAverage()
    {
          $books = Book::with(['author', 'category'])
        ->where('price_huf', '>', function($query) {
            $query->selectRaw('AVG(price_huf)')
                  ->from('books');
        })
        ->get();
    
        return BookResource::collection($books);
    }

    public function popularCategories()
    {
        $popularCategories = Category::select('categories.id', 'categories.name')
            ->selectRaw('COUNT(books.id) as book_count')
            ->selectRaw('AVG(books.price_huf) as average_price')
            ->join('books', 'categories.id', '=', 'books.category_id')
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('book_count', 'desc')
            ->limit(3)
            ->get();
        return response()->json($popularCategories);
    }

    public function mostExpensive()
    {
        $categoryIds = Category::whereIn('name', ['Science Fiction', 'Fantasy'])->pluck('id')->toArray();
        $books = Book::with(['author', 'category'])
            ->whereIn('category_id', $categoryIds) // Replace with actual IDs for Science Fiction and Fantasy
            ->orderBy('price_huf', 'desc')
            ->limit(3)
            ->get();

        return BookResource::collection($books);
    }
}
