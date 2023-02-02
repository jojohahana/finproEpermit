<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdept extends Model
{
    use HasFactory;
    protected $table = 'subdept'; //Yohana w tambahin ini krena table routingnya ambigu jadi make protect table supaya diarahkan ke table ini
    protected $fillable = [
        'subdept_name',
        'department',
    ];
}
