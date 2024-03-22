<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Rating
 *
 * @property int $book_id
 * @property int $users_id
 * @property int $score
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 *
 * @property Book $book
 * @property User $user
 *
 * @package App\Models
 */
class Rating extends Model
{
    use HasFactory;
	protected $table = 'rating';
	public $incrementing = false;

	protected $casts = [
		'book_id' => 'int',
		'users_id' => 'int',
		'score' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $fillable = [
		'score',
        'title',
        'description',
		'create_at',
		'update_at'
	];

	public function book()
	{
		return $this->belongsTo(Book::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}
}
