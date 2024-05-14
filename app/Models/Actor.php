<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $table = 'actors';
    protected $primaryKey = 'num_actor';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'num_actor',
        'name',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'actor_movie', 'num_actor', 'num_movie');
    }
    
    use HasFactory;
}
