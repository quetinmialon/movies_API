<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $table = 'directors';
    protected $primaryKey = 'num_director';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'num_director',
        'name',
    ];
    use HasFactory;
}
