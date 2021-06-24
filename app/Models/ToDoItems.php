<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoItems extends Model
{
    use HasFactory;
    public $table = 'todoitems';
    protected $fillable = [
      'content',
      'status',
      'user_id'
    ];
}
