<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    
    protected $fillable = [
        'num_movie',
        'name',
        'duration',
        'release',
        'synopsis',
        'num_director'
    ];
    protected $primaryKey = 'num_movie';
    protected $keyType = 'string';
    public $incrementing = false;

    public function directors(){
        return $this->belongsTo(Director::class, 'num_director', 'num_director');
    }

    public function actors(){
        return $this->belongsToMany(Actor::class, 'actor_movie', 'num_movie', 'num_actor');
    }

    use HasFactory;

}
