<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'dob'];
    protected $dates = ['dob'];

    /* protected function dob(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Carbon::parse($value),
        );
    } */
}
