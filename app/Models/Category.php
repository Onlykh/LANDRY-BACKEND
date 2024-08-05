<?php

namespace App\Models;


use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Filterable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'p_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category',
        'entitled',
        'description',
        'icon',
    ];

    protected $primaryKey = 'category';
}
