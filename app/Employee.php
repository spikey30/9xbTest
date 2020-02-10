<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'email', 'job_role'];

    public $dates = ['deleted_at'];
}
