<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $position_id
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 *
 * @property Position $position
 * @property Collection|Order[] $bills
 * @property Collection|Cart[] $carts
 * @property Collection|Rating[] $ratings
 * @property Collection|Wishlist[] $wishlists
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasFactory;
	protected $table = 'users';

	protected $casts = [
		'position_id' => 'int',
		'create_at' => 'datetime',
		'update_at' => 'datetime'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
		'password',
        'phone',
		'position_id',
        'status',
		'create_at',
		'update_at'
	];

	public function position()
	{
		return $this->belongsTo(Position::class);
	}

	public function bills()
	{
		return $this->hasMany(Order::class, 'user_id');
	}

	public function cart()
	{
		return $this->hasMany(Cart::class, 'user_id');
	}

	public function ratings()
	{
		return $this->hasMany(Rating::class, 'user_id');
	}

	public function wishlists()
	{
		return $this->hasMany(Wishlist::class, 'user_id');
	}
}
