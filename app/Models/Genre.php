<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Genre
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 *
 * @property Collection|Book[] $books
 *
 * @package App\Models
 */
class Genre extends Model
{
    use HasFactory;
    use Sluggable;
	protected $table = 'genres';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description',
        'status',
	];

	public function books()
	{
		return $this->belongsToMany(Book::class, 'book_has_genre');
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
