<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable=[
        'book_id',
        'user_id',
        'user_name',
        'title',
        'subtitle',
        'visualized',
        'text',
        'pagNumber',
        'archived',
        'exclued',
        'marked',
        'vault',
        'open',
    ];
}