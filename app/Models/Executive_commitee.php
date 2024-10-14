<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Executive_commitee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'designation',
        'image',
        'fb_link',
        'linkedin_link',
    ];
}
