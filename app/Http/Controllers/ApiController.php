<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        $calculations = Calculation::join('years', 'years.id', '=', 'year_id')
            ->join('fuels', 'fuels.id', '=', 'fuel_id')
            ->join('units', 'units.id', '=', 'unit_id')
            ->select('calculations.id', 'facility_id', 'year_value', 'fuel_name', 'fuel_value', 'amount_of_fuel', 'unit_name', 'unit_value')->orderBy('calculations.created_at', 'DESC')
            ->get();

        return $calculations;
    }

    public function store(Request $request)
    {
        $request = $request->only(['facility_id', 'year_id', 'fuel_id', 'amount_of_fuel', 'unit_id']);
        $create  = Calculation::create($request);

        return response()->json(1);
    }

    public function show($id)
    {
        $calculation = Calculation::join('years', 'years.id', '=', 'year_id')
            ->join('fuels', 'fuels.id', '=', 'fuel_id')
            ->join('units', 'units.id', '=', 'unit_id')
            ->select('calculations.id', 'facility_id', 'year_id', 'year_value', 'fuel_id', 'fuel_name', 'fuel_value', 'amount_of_fuel', 'unit_id', 'unit_name', 'unit_value')->orderBy('calculations.created_at', 'DESC')
            ->find($id);
            
        return $calculation;
    }

    public function update(Request $request, $id)
    {
        $request = $request->only(['facility_id', 'year_id', 'fuel_id', 'amount_of_fuel', 'unit_id']);

        $update = Calculation::find($id)->update($request);

        return response()->json(1);
    }

    public function destroy($id)
    {
        $destroy = Calculation::destroy($id);
        return response()->json(1);
    }
}