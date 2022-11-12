<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Request\QuestionCreateRequest;

class Question extends Model
{
    protected $fillable =['question', 'answer1', 'answer2', 'answer3', 'answer4', 'correct_answer','image'];


    use HasFactory;
}