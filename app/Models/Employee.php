<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $fillable = ['first_name','last_name','phone_number','email','address'];
}
