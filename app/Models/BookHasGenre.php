<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BookHasGenre
 *
 * @property int $book_id
 * @property int $genre_id
 *
 * @property Book $book
 * @property Genre $genre
 *
 * @package App\Models
 */
class BookHasGenre extends Model
{
    use HasFactory;
	protected $table = 'book_has_genres';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'book_id' => 'int',
		'genre_id' => 'int'
	];

    protected $fillable = [
        'book_id',
        'genre_id'
    ];


    public function book()
	{
		return $this->belongsTo(Book::class);
	}

	public function genre()
	{
		return $this->belongsTo(Genre::class);
	}
}
