<?php

namespace App\Models;


use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, Filterable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'p_services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference',
        'entitled',
        'description',
        'type',
        'state',
        'color',
        'icon',
    ];
    protected $primaryKey = 'reference';
}
