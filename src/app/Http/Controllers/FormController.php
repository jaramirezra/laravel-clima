<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Models\City;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        * Muestra la vista principal de la sección de formularios con la lista de ciudades.
        * @return \Illuminate\View\View
        */
        $cities = City::all();
        return view('forms.index', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        * Valida los datos del formulario y crea un nuevo registro.
        * @param \Illuminate\Http\Request $request
        * @return \Illuminate\Http\RedirectResponse
        */
        $validated = $request->validate([
            'city_id'      => 'required|exists:cities,id',
            'latitude'     => ['required', 'numeric', 'between:-90,90', 'regex:/^-?\d+(\.\d{1,7})?$/'],
            'length'       => ['required', 'numeric', 'between:-180,180', 'regex:/^-?\d+(\.\d{1,7})?$/'],
            'image'        => 'nullable|image|max:2048',
        ]);

        $form = new Form();
        $form->city_id      = $validated['city_id'];
        $form->latitude     = $validated['latitude'];
        $form->length       = $validated['length'];

        if ($request->hasFile('image')) {
            $form->image = $request->file('image')->store('images', 'public');
        }

        $form->save();

        return redirect()->route('forms.index')->with('success', 'Formulario creado correctamente.');
    }
}