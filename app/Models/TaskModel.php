<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description',
        'enable',
    ];

    protected $hidden = [
        'id_user',
    ];

    protected $table = 'testeUHC_tasks';
}
