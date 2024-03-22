<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BookHasAuthor
 *
 * @property int $book_id
 * @property int $author_id
 *
 * @property Author $author
 * @property Book $book
 *
 * @package App\Models
 */
class BookHasAuthor extends Model
{
    use HasFactory;
	protected $table = 'book_has_author';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'book_id' => 'int',
		'author_id' => 'int'
	];

    protected $fillable = [
        'book_id',
        'author_id'
    ];

	public function author()
	{
		return $this->belongsTo(Author::class);
	}

	public function book()
	{
		return $this->belongsTo(Book::class);
	}
}
