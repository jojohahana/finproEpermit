<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $fillable = [
        'name',
        'email',
        'department',
        'position',
        'join_date',
        'phone_number',
        'rfid_tag',
        'role_type',
        'employee_id'
    ];
}
