<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Http;
use App\Services\BookSearchService;

class BookController extends Controller
{
    public function index() {
        $books = Book::with(['author', 'category'])->get();
        $eurRate = $this->exchangeRate();
        return $books->map(fn($book) => new BookResource($book, $book->getPriceEur($eurRate)));
    }

    public function store(BookRequest $request)
    {
        $request->validated();
        $book = Book::create([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'release_date' => $request->release_date,
            'price_huf' => $request->price_huf,
        ]);
        $book->load(['author', 'category']);
        $eurRate = $this->exchangeRate();
        return new BookResource($book, $book->getPriceEur($eurRate));
    }

    public function show(Book $book)
    {
        $book->load(['author', 'category']);
        $eurRate = $this->exchangeRate();
        return new BookResource($book, $book->getPriceEur($eurRate));
    }

    public function search(SearchRequest $request, BookSearchService $bookSearchService)
    {
    $request->validated();
    $searchCategory = $request->input('search_category');
    $searchInput = $request->input('search_input');
    $books = $bookSearchService->search($searchCategory, $searchInput);
    $eurRate = $this->exchangeRate();
    return $books->map(fn($book) => new BookResource($book, $book->getPriceEur($eurRate)));
    }

    /**
     * Get the current EUR exchange rate for HUF.
     */
    public function exchangeRate()
    {
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/HUF');
        $jsonData = $response->json();
        return $jsonData['rates']['EUR'] ?? null;
    }
}
