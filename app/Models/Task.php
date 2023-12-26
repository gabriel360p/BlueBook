<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'title',
        'task',
        'description',
        'conclued',
        'exclued',
        'visualized',
        'date_finish',
        'hour_finish',
    ];
}



