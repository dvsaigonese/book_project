<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Order
 *
 * @property int $id
 * @property int $total_price
 * @property int $users_id
 * @property Carbon|null $create_at
 * @property Carbon|null $update_at
 *
 * @property User $user
 * @property Collection|OrderDetail[] $bill_details
 *
 * @package App\Models
 */
class Order extends Model
{
    use HasFactory;
	protected $table = 'orders';

	protected $casts = [
		'total_price' => 'int',
		'users_id' => 'int',
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected $fillable = [
		'total_price',
        'shipping_fee',
        'subtotal_price',
		'user_id',
        'order_name',
        'order_phone',
        'order_address',
        'order_status',
        'payment_status',
		'created_at',
		'updated_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function order_details()
	{
		return $this->hasMany(OrderDetail::class);
	}

    public static function codes()
    {
        return collect(
            [
                ['payment_status' => 0,  'label' => 'Unpaid'],
                ['payment_status' => 1,  'label' => 'Paid'],
            ]
        );
    }
}
