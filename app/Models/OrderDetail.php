<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class OrderDetail
 *
 * @property int $id
 * @property int $bill_id
 * @property int $book_id
 * @property int $quantity
 * @property int $price
 *
 * @property Order $bill
 * @property Book $book
 *
 * @package App\Models
 */
class OrderDetail extends Model
{
    use HasFactory;
	protected $table = 'order_details';
	public $timestamps = false;

	protected $casts = [
		'order_id' => 'int',
		'book_id' => 'int',
		'quantity' => 'int',
		'price' => 'int'
	];

	protected $fillable = [
		'order_id',
		'book_id',
		'quantity',
		'price'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function book()
	{
		return $this->belongsTo(Book::class);
	}
}
