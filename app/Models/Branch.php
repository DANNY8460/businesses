<?php

namespace App\Models;

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
}
