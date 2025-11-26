# Laravel Blog API

This is a RESTful API for a blog application built with Laravel. It supports user authentication, blog posts, and comments.

## Project Setup

1. **Clone the repository**
2. **Install dependencies**
    ```sh
    composer install
    ```
3. **Copy and configure your environment file**
    ```sh
    cp .env.example .env
    # Edit .env as needed (DB, mail, etc.)
    ```
4. **Generate application key**
    ```sh
    php artisan key:generate
    ```
5. **Run migrations and seeders**
    ```sh
    php artisan migrate --seed
    ```
6. **(Optional) Run the development server**
    ```sh
    php artisan serve
    # or
    php -S localhost:8001 -t public/
    ```

## API Endpoints

### Category Endpoints

| Method | Endpoint        | Description         |
| ------ | --------------- | ------------------- |
| POST   | /api/categories | Store new category  |
| GET    | /api/categories | List all categories |

### Author Endpoints

| Method | Endpoint     | Description      |
| ------ | ------------ | ---------------- |
| POST   | /api/authors | Store new author |
| GET    | /api/authors | List all authors |

### Book Endpoints

| Method | Endpoint          | Description          |
| ------ | ----------------- | -------------------- |
| POST   | /api/books        | Store new book       |
| GET    | /api/books        | List all books       |
| GET    | /api/books/search | Search between books |
| GET    | /api/books/{book} | Show specific books  |

### Statistic Endpoints

| Method | Endpoint                           | Description                                                                |
| ------ | ---------------------------------- | -------------------------------------------------------------------------- |
| GET    | /api/statistics/expensive-books    | List books that has a price above average                                  |
| GET    | /statistics/popular-categories     | List the 3 most popular categories                                         |
| GET    | /statistics/top-fantasy-and-sci-fi | List the most expensive books with Science Finction or Fantasy as category |

## Example usage

###store category

**POST /api/categories**
**Request Body:**

```
name: string (required)
```

**Example:**

```json
{
    "name": "Fantasy"
}
```

**Response:**

```json
{
    "data": {
        "id": 14,
        "attributes": {
            "name": "Fantasy",
            "created_at": "2025-11-26T15:53:06.000000Z",
            "updated_at": "2025-11-26T15:53:06.000000Z"
        }
    }
}
```

###index category

**Get /api/categories**

**Example:**

**Response:**

```json
{
    "data": [
        {
            "id": 1,
            "attributes": {
                "name": "excepturi",
                "created_at": "2025-11-26T14:57:15.000000Z",
                "updated_at": "2025-11-26T14:57:15.000000Z"
            }
        },
        {
            "id": 2,
            "attributes": {
                "name": "qui",
                "created_at": "2025-11-26T14:57:15.000000Z",
                "updated_at": "2025-11-26T14:57:15.000000Z"
            }
        },
        {
            "id": 3,
            "attributes": {
                "name": "quod",
                "created_at": "2025-11-26T14:57:15.000000Z",
                "updated_at": "2025-11-26T14:57:15.000000Z"
            }
        }
    ]
}
```

###store author

**POST /api/authors**
**Request Body:**

```
name: string (required)
```

**Example:**

```json
{
    "name": "Alan Wake"
}
```

**Response:**

```json
{
    "data": {
        "id": 14,
        "attributes": {
            "name": "Alan Wake",
            "created_at": "2025-11-26T15:53:06.000000Z",
            "updated_at": "2025-11-26T15:53:06.000000Z"
        }
    }
}
```

###index author

**Get /api/authors**

**Example:**

**Response:**

```json
{
    "data": [
        {
            "id": 1,
            "attributes": {
                "name": "Naomie Wunsch",
                "created_at": "2025-11-26T14:57:15.000000Z",
                "updated_at": "2025-11-26T14:57:15.000000Z"
            }
        },
        {
            "id": 2,
            "attributes": {
                "name": "Ms. Calista Bayer",
                "created_at": "2025-11-26T14:57:15.000000Z",
                "updated_at": "2025-11-26T14:57:15.000000Z"
            }
        },
        {
            "id": 3,
            "attributes": {
                "name": "Newton Kris",
                "created_at": "2025-11-26T14:57:15.000000Z",
                "updated_at": "2025-11-26T14:57:15.000000Z"
            }
        }
    ]
}
```

###store book

**POST /api/books**
**Request Body:**

```
title: string (required)
author_id: integer (required)
category_id: integer (required)
release_date: date (required)
price_huf: integer (required)
```

**Example:**

```json
{
    "title": "Departure",
    "author_id": 1,
    "category_id": 1,
    "release_date": "2024-05-17",
    "price_huf": "3000"
}
```

**Response:**

```json
{
    "data": {
        "id": 52,
        "attributes": {
            "title": "Departure",
            "release_date": "2024-05-17",
            "price_huf": "3000",
            "price_eur": 7.86,
            "created_at": "2025-11-26T16:00:09.000000Z",
            "updated_at": "2025-11-26T16:00:09.000000Z"
        },
        "relationships": {
            "author": {
                "id": 1,
                "name": "Alan Wake"
            },
            "category": {
                "id": 1,
                "name": "horror"
            }
        }
    }
}
```

###index books

**Get /api/books**

**Example:**

**Response:**

```json
{
    "data": [
        {
            "id": 1,
            "attributes": {
                "title": "Rerum id et voluptatem.",
                "release_date": "1982-01-01",
                "price_huf": "15694.00",
                "price_eur": 41.12,
                "created_at": "2025-11-26T14:57:15.000000Z",
                "updated_at": "2025-11-26T14:57:15.000000Z"
            },
            "relationships": {
                "author": {
                    "id": 14,
                    "name": "Amanda Upton"
                },
                "category": {
                    "id": 11,
                    "name": "Science Fiction"
                }
            }
        },
        {
            "id": 2,
            "attributes": {
                "title": "Dicta quas similique necessitatibus.",
                "release_date": "2023-07-17",
                "price_huf": "5917.00",
                "price_eur": 15.5,
                "created_at": "2025-11-26T14:57:15.000000Z",
                "updated_at": "2025-11-26T14:57:15.000000Z"
            },
            "relationships": {
                "author": {
                    "id": 12,
                    "name": "Rusty Considine"
                },
                "category": {
                    "id": 10,
                    "name": "repellat"
                }
            }
        }
    ]
}
```

###show books

**Get /api/books/{book}**

**Example:**

**Response:**

```json
{
    "data": {
        "id": 52,
        "attributes": {
            "title": "departure",
            "release_date": "2024-05-17",
            "price_huf": "3000",
            "price_eur": 7.86,
            "created_at": "2025-11-26T16:00:09.000000Z",
            "updated_at": "2025-11-26T16:00:09.000000Z"
        },
        "relationships": {
            "author": {
                "id": 1,
                "name": "Alan Wake"
            },
            "category": {
                "id": 1,
                "name": "horror"
            }
        }
    }
}
```

###search book

**POST /api/books/search**
**Request Body:**

```
search_category: string (required) ["title", "author", "category"]
search_input: string (required)
```

**Example:**

```json
{
    "search_category": "title",
    "search_input": "dep"
}
```

**Response:**

```json
{
    "data": {
        "id": 52,
        "attributes": {
            "title": "Departure",
            "release_date": "2024-05-17",
            "price_huf": "3000",
            "price_eur": 7.86,
            "created_at": "2025-11-26T16:00:09.000000Z",
            "updated_at": "2025-11-26T16:00:09.000000Z"
        },
        "relationships": {
            "author": {
                "id": 1,
                "name": "Alan Wake"
            },
            "category": {
                "id": 1,
                "name": "horror"
            }
        }
    }
}
```

###expensive books

shows books that has an above average price

**POST /statistics/expensive-books**

**Example:**

**Response:**

```json
{
    "data": [
        {
            "id": 1,
            "attributes": {
                "title": "Rerum id et voluptatem.",
                "release_date": "1982-01-01",
                "price_huf": "15694.00",
                "price_eur": 0,
                "created_at": "2025-11-26T14:57:15.000000Z",
                "updated_at": "2025-11-26T14:57:15.000000Z"
            },
            "relationships": {
                "author": {
                    "id": 14,
                    "name": "Amanda Upton"
                },
                "category": {
                    "id": 11,
                    "name": "Science Fiction"
                }
            }
        },
        {
            "id": 5,
            "attributes": {
                "title": "Ut aliquid accusantium neque.",
                "release_date": "1991-11-16",
                "price_huf": "19895.00",
                "price_eur": 1,
                "created_at": "2025-11-26T14:57:15.000000Z",
                "updated_at": "2025-11-26T14:57:15.000000Z"
            },
            "relationships": {
                "author": {
                    "id": 15,
                    "name": "Agnes Johnson"
                },
                "category": {
                    "id": 1,
                    "name": "excepturi"
                }
            }
        },
        {
            "id": 6,
            "attributes": {
                "title": "Reiciendis totam libero.",
                "release_date": "1986-12-24",
                "price_huf": "17946.00",
                "price_eur": 2,
                "created_at": "2025-11-26T14:57:15.000000Z",
                "updated_at": "2025-11-26T14:57:15.000000Z"
            },
            "relationships": {
                "author": {
                    "id": 5,
                    "name": "Mariela Mitchell IV"
                },
                "category": {
                    "id": 6,
                    "name": "aperiam"
                }
            }
        }
    ]
}
```

###expensive books

List the top 3 most expensive books that have either Fantasy or Science fiction as a category

**POST /statistics/top-fantasy-and-sci-fi**

**Example:**

**Response:**

```json
{
    "data": [
        {
            "id": 36,
            "attributes": {
                "title": "Nemo dolores consequatur est.",
                "release_date": "2005-07-18",
                "price_huf": "19482.00",
                "price_eur": 0,
                "created_at": "2025-11-26T14:57:16.000000Z",
                "updated_at": "2025-11-26T14:57:16.000000Z"
            },
            "relationships": {
                "author": {
                    "id": 13,
                    "name": "Dr. Lesley Rohan"
                },
                "category": {
                    "id": 11,
                    "name": "Science Fiction"
                }
            }
        },
        {
            "id": 48,
            "attributes": {
                "title": "Praesentium et.",
                "release_date": "1974-12-29",
                "price_huf": "19143.00",
                "price_eur": 1,
                "created_at": "2025-11-26T14:57:16.000000Z",
                "updated_at": "2025-11-26T14:57:16.000000Z"
            },
            "relationships": {
                "author": {
                    "id": 2,
                    "name": "Ms. Calista Bayer"
                },
                "category": {
                    "id": 11,
                    "name": "Science Fiction"
                }
            }
        },
        {
            "id": 8,
            "attributes": {
                "title": "Suscipit magnam sed.",
                "release_date": "2000-05-10",
                "price_huf": "18868.00",
                "price_eur": 2,
                "created_at": "2025-11-26T14:57:15.000000Z",
                "updated_at": "2025-11-26T14:57:15.000000Z"
            },
            "relationships": {
                "author": {
                    "id": 8,
                    "name": "Reid Jacobi"
                },
                "category": {
                    "id": 11,
                    "name": "Science Fiction"
                }
            }
        }
    ]
}
```

###popular categories

list the top 3 most popular categories with count, and average price

**POST /statistics/popular-categories**

**Example:**

**Response:**

```json
[
    {
        "id": 1,
        "name": "excepturi",
        "book_count": 8,
        "average_price": "10440.500000"
    },
    {
        "id": 6,
        "name": "aperiam",
        "book_count": 8,
        "average_price": "9234.375000"
    },
    {
        "id": 7,
        "name": "et",
        "book_count": 7,
        "average_price": "9220.142857"
    }
]
```
