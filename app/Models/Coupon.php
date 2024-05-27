<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $fillable = [
        'name',
        'code',
        'type',
        'discount_value',
        'status',
        'created_at',
        'updated_at',
    ];

    public static function findByCode($code)
    {
        return self::where('code', $code)->where('status', 1)->first();
    }

    public function getDiscountText(){
        if ($this->type == 'percentage'){
            return $this->discount_value . '%';
        } elseif ($this->type == 'direct'){
            return $this->discount_value;
        } else {
            return 0;
        }
    }

    public function discount($total){
        if ($this->type == 'percentage'){
            return $total - (($this->discount_value / 100) * $total);
        } elseif ($this->type == 'direct'){
            return ($total - $this->discount_value);
        } else {
            return ($total);
        }
    }

    public function get_discount_value($total){
        if ($this->type == 'percentage'){
            return ($this->discount_value / 100) * $total;
        } elseif ($this->type == 'direct'){
            return $this->discount_value;
        } else {
            return 0;
        }
    }
}
