<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Author
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 *
 * @property Collection|Book[] $books
 *
 * @package App\Models
 */
class Author extends Model
{
    use HasFactory;
    use Sluggable;

	protected $table = 'authors';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description',
        'status',
	];

	public function books()
	{
		return $this->belongsToMany(Book::class, 'book_has_author');
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
