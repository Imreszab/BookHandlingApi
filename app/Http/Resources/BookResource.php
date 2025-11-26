<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    protected $priceEur;

    public function __construct($resource, $priceEur = null)
    {
        parent::__construct($resource);
        $this->priceEur = $priceEur;
    }

    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            'attributes' => [
                'title' => $this->title,
                'release_date' => $this->release_date,
                'price_huf' => $this->price_huf,
                'price_eur' => $this->priceEur,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'author' => [
                    'id'=> $this->author_id,
                    'name'=> $this->author->name
                ],
                'category' => [
                    'id'=> $this->category_id,
                    'name'=> $this->category->name
                ]
            ]
        ];
    }
}
