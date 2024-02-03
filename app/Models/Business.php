<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'logo_path',
    ];

    /**
     * Get business logo // logo
     *
     */
    public function getLogoAttribute()
    {
        return !empty($this->logo_path) ? url('/storage/' . $this->logo_path) : null;
    }

    /**
     * Get the branches for the business
     *
     */
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}
