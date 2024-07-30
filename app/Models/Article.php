<?php

    namespace App\Models;


    use EloquentFilter\Filterable;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Article extends Model
    {
        use HasFactory, Filterable;
        /**
        * The table associated with the model.
        *
        * @var string
        */
        protected $table = 'p_articles';

        /**
        * The attributes that are mass assignable.
        *
        * @var array<int, string>
        */
        protected $fillable = [
        ];

    }
