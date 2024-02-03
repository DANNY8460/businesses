<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingWeekDayTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'working_week_day_id',
        'start_time',
        'end_time',
    ];
}
