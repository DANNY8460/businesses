<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingWeekDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'day',
        'status',
    ];

    /**
     * Get the timings of the week day
     *
     */
    public function timings()
    {
        return $this->hasMany(WorkingWeekDayTime::class, 'working_week_day_id', 'id');
    }
}
