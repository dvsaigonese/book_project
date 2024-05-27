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
use Spatie\Permission\Traits\HasRoles;

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
 * @property Role $position
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
    use HasRoles;
	protected $table = 'users';

	protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
		'password',
        'status',
		'created_at',
		'updated_at'
	];

	public function role()
	{
		return $this->belongsToMany(Role::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class, 'user_id');
	}

	public function cart()
	{
		return $this->hasMany(Cart::class, 'user_id');
	}

	public function rating()
	{
		return $this->hasMany(Rating::class, 'user_id');
	}

	public function wishlist()
	{
		return $this->hasMany(Wishlist::class, 'user_id');
	}
}
