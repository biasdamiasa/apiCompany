<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorksOn extends Model
{
    protected $fillable = ['id_emp', 'id_proj'];
}
