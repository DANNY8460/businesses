<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'image_path',
    ];

    /**
     * Get business image // image
     *
     */
    public function getImageAttribute()
    {
        return !empty($this->image_path) ? url('/storage/' . $this->image_path) : null;
    }
}
