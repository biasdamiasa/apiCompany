<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'location'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
