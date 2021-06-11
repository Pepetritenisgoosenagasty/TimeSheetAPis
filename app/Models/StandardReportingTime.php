<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandardReportingTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'standard_time'
    ];
}
