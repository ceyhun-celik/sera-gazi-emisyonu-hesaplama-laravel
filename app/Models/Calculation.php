<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calculation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'calculations';

    protected $fillable = [
        'facility_id',
        'year_id',
        'fuel_id',
        'amount_of_fuel',
        'unit_id',
    ];
}
