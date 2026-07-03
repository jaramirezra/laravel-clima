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
        $cities = City::all();
        return view('forms.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'city_id'      => 'required|exists:cities,id',
            'latitude'     => 'required|numeric',
            'length' => 'required|numeric',
            'image'        => 'nullable|image|max:2048',
        ]);

        $form = new Form();
        $form->city_id      = $validated['city_id'];
        $form->latitude     = $validated['latitude'];
        $form->length = $validated['length'];

        if ($request->hasFile('image')) {
            $form->image = $request->file('image')->store('images', 'public');
        }

        $form->save();

        return redirect()->route('forms.index')->with('success', 'Formulario creado correctamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        //
    }
}
