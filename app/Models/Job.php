<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'position',
        'location',
        'date_applied',
        'applied_via',
        'apply_link',
        'application_status',
        'result',
        'notes',
    ];
}
