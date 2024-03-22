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

class News extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'news';

    protected $casts = [
        'create_at' => 'datetime',
        'update_at' => 'datetime'
    ];

    protected $fillable = [
        'title',
        'content',
        'image',
        'author',
        'status',
        'create_at',
        'update_at'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
