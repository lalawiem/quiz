<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Quiz extends Model
{
    use HasFactory;
    use Sluggable;


    protected $fillable=['title', 'description', 'status', 'finished_at','slug'];

    protected $dates=['finished_at'];
    public function getFinishedAtAttribute($date){
        return $date ? Carbon::parse($date) : null;

    }

    public function questions(){
        return $this->hasMany('App\Models\Question');       
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
