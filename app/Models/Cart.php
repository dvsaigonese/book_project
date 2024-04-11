<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Cart
 *
 * @property int $id
 * @property int $users_id
 * @property int $book_id
 * @property int $quantity
 * @property int $price
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 *
 * @property Book $book
 * @property User $user
 *
 * @package App\Models
 */
class Cart extends Model
{
    use HasFactory;
	protected $table = 'carts';
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int',
		'book_id' => 'int',
		'quantity' => 'int',
		'price' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'book_id',
		'quantity',
		'price',
		'created_at',
		'updated_at'
	];

	public function book()
	{
		return $this->belongsTo(Book::class, 'book_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
