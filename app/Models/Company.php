<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website',
        'location',
        'industry',
        'description',
        'logo',
        'status',
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class, 'company_name', 'name');
    }
}