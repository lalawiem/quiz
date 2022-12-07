<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duyuru extends Model
{
    use HasFactory;
    protected $fillable=['title', 'user_id', 'finished_at'];
    protected $dates=['finished_at'];
}