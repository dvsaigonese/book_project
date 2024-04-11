<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Wishlist
 *
 * @property int $id
 * @property int $book_id
 * @property int $users_id
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 *
 * @property Book $book
 * @property User $user
 *
 * @package App\Models
 */
class Wishlist extends Model
{
    use HasFactory;
	protected $table = 'wishlists';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'book_id' => 'int',
		'users_id' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'book_id',
		'user_id',
		'created_at',
		'updated_at'
	];

	public function book()
	{
		return $this->belongsTo(Book::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
