<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Position
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Position extends Model
{
    use HasFactory;
	protected $table = 'position';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}

    public static function codes()
    {
        return collect(
            [
                ['id' => 1,  'name' => 'Admin'],
                ['id' => 2,  'name' => 'User'],
            ]
        );
    }
}
