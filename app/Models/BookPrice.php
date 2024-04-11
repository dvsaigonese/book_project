<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BookPrice
 *
 * @property int $id
 * @property int $book_price
 * @property bool $status
 * @property Carbon|null $end_at
 * @property int $book_id
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 *
 * @property Book $book
 *
 * @package App\Models
 */
class BookPrice extends Model
{
    use HasFactory;
	protected $table = 'book_price';

	protected $casts = [
		'book_price' => 'int',
		'status' => 'bool',
		'end_at' => 'datetime',
		'book_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'book_price',
		'status',
		'end_at',
		'created_at',
		'updated_at',
        'book_id',
	];

	public function book()
	{
		return $this->belongsTo(Book::class);
	}
}
