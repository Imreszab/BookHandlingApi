<?php

namespace App\Services;

use App\Models\Book;

class BookSearchService
{
    /**
     * Search for books by category (author, title, category) and input.
     *
     * @param string|null $searchCategory
     * @param string|null $searchInput
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search(string $searchCategory, string $searchInput)
    {
        $query = Book::query();

        $allowed = ['author', 'title', 'category'];
        if ($searchCategory && $searchInput) {
            if (!in_array(strtolower($searchCategory), $allowed)) {
                // Return empty collection for invalid category
                return collect([]);
            }
            switch (strtolower($searchCategory)) {
                case 'author':
                    $query->whereHas('author', function ($q) use ($searchInput) {
                        $q->where('name', 'like', '%' . $searchInput . '%');
                    });
                    break;
                case 'title':
                    $query->where('title', 'like', '%' . $searchInput . '%');
                    break;
                case 'category':
                    $query->whereHas('category', function ($q) use ($searchInput) {
                        $q->where('name', 'like', '%' . $searchInput . '%');
                    });
                    break;
            }
        }

        return $query->with(['author', 'category'])->get();
    }
}
