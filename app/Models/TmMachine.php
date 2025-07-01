<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmMachine extends Model
{
    protected $fillable = [
        'no_machine',
        'type_machine',
        'seri',
        'created_at',
        'updated_at'
    ];
}
