<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdept extends Model
{
    use HasFactory;
    protected $fillable = [
        'subdept_name',
        'department',
    ];
}
