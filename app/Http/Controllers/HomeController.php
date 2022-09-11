<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Fuel;
use App\Models\Unit;
use App\Models\Year;

class HomeController extends Controller
{
    public function index()
    {
        $facilities = Facility::select('id', 'facility_name')->orderBy('facility_name')->get();
        $years      = Year::select('id', 'year_value')->orderBy('year_value', 'DESC')->get();
        $fuels      = Fuel::select('id', 'fuel_name', 'fuel_value')->orderBy('fuel_name')->get();
        $units      = Unit::select('id', 'unit_name', 'unit_value')->orderBy('unit_name')->get();

        return view('app', compact('facilities', 'years', 'fuels', 'units'));
    }
}
