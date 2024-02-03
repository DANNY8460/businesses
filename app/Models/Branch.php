<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'name',
    ];

    /**
     * get the images for the branch
     *
     */
    public function images()
    {
        return $this->hasMany(BranchImage::class, 'branch_id', 'id');
    }

    /**
     * Get the working week days for the branch
     *
     */
    public function workingWeekDays()
    {
        return $this->hasMany(WorkingWeekDay::class, 'branch_id', 'id');
    }

    /**
     * Get today status // today_status
     *
     */
    public function getTodayStatusAttribute()
    {
        $date = Carbon::now();
        $isAvailable = $this->workingWeekDays->filter(function ($q) use ($date) {
            return \Str::lower($date->format('D')) == $q->day && $q->status == 1 && $q->timings->filter(function ($time) use ($date) {
                $currTime = $date->format('H:i:s');
                return $time->start_time <= $currTime && $time->end_time >= $currTime;
            });
        })->isNotEmpty();
        return $isAvailable ? 1 : 0;
    }
}
