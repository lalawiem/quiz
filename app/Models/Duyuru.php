<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;



class Duyuru extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['title', 'description','user_id', 'finished_at'];
    protected $dates=['finished_at'];
    

    public function getFinishedAtAttribute($date){
        return $date ? Carbon::parse($date) : null; 

    }
}