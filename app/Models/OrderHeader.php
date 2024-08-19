<?php

namespace App\Models;

use App\Enums\OrderStateEnum;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHeader extends Model
{
    use HasFactory, Filterable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'd_order_headers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference',
        'state',
        'client_id',
        'ref_service',
        'phone_number',
        'order_date',
        'pick_up_date',
        'delivery_date',
        'pick_up_address',
        'delivery_address',
        'total_ht',
        'total_tva',
        'total_ttc',
        'total_discount',
        'delivery_cost',
        'net_to_pay',
        'note',
    ];

    protected $casts = [
        'pick_up_address' => 'array',
        'delivery_address' => 'array',
        'state' => OrderStateEnum::class,
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class, 'd_order_header_id', 'id');
    }
}
