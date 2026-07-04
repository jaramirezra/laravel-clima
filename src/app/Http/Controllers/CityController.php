<?php

namespace App\Http\Controllers;

use App\Models\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        * Muestra la vista principal de la sección de ciudades.
        * @return \Illuminate\View\View
        */
        return view('cities.index', [
            'cities' => City::all()
        ]);
    }
}