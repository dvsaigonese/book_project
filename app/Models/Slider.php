<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
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
class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $fillable = [
        'title',
        'description',
        'status',
        'image',
        'created_at',
        'updated_at'
    ];
}
