<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use Illuminate\Http\Request;

class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('horses.index', ['horses' => Horse::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'wins' => 'required',
            'runs' => 'required',
            'about' => 'required',
        ]);
        $horse = new Horse();
        $horse->fill($request->all());
        return ($horse->save() !== 1)
            ? redirect('/horse')->with('status_success', 'Arklys pridėtas!')
            : redirect('/horse')->with('status_error', 'Arklys negali būti pridėtas!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(Horse $horse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(Horse $horse)
    {
        return view('horses.edit', ['horse' => $horse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horse $horse)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'wins' => 'required',
            'runs' => 'required',
            'about' => 'required',
        ]);
        $horse->fill($request->all());
        return ($horse->save() !== 1)
            ? redirect()->route('horse.index')->with('status_success', 'Arklys paredaguotas!')
            : redirect()->route('horse.index')->with('status_error', 'Arklys negali būti redaguotas!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horse $horse)
    {
        $horse->delete();
        return redirect('/horse')->with('status_success', 'Arklys ištrintas!');

    }
}
