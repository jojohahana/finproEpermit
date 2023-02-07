<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavesSick extends Model
{
    use HasFactory;
    protected $table = 'leaves_sick';
    protected $fillable = [
        'user_id',
        'sick_type',
        'from_date',
        'to_date',
        'day',
        'data_status',
    ];

}
