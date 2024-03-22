<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Book
 *
 * @property int $id
 * @property string $name
 * @property int $quantity
 * @property string|null $description
 * @property Carbon|null $publish_year
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 *
 * @property Collection|OrderDetail[] $bill_details
 * @property Collection|Author[] $authors
 * @property Collection|Genre[] $genres
 * @property Collection|BookPrice[] $book_prices
 * @property Collection|Cart[] $carts
 * @property Collection|Rating[] $ratings
 * @property Collection|Wishlist[] $wishlists
 *
 * @package App\Models
 */
class Book extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'books';

    protected $casts = [
        'quantity' => 'int',
        'publish_year' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $fillable = [
        'name',
        'quantity',
        'publisher',
        'description',
        'publish_year',
        'status',
        'image',
        'weight',
        'created_at',
        'updated_at'
    ];

    public function bill_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_has_author');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_has_genre');
    }

    public function book_prices()
    {
        return $this->hasMany(BookPrice::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
