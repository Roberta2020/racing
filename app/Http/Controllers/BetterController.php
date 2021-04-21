<?php

namespace App\Http\Controllers;

use App\Models\Better;
use Illuminate\Http\Request;

class BetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    if(isset($request->horse_id) && $request->horse_id !== 0)
        $betters = \App\Models\Better::where('horse_id', $request->horse_id)->orderByDesc('bet')->get();
    else
        $betters = \App\Models\Better::orderByDesc('bet')->get();
        $horses = \App\Models\Horse::orderBy('name')->get();
    return view('betters.index', ['betters' => $betters, 'horses' => $horses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horses = \App\Models\Horse::orderBy('name')->get();
        return view('betters.create', ['horses' => $horses]);
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
            'surname' => 'required|max:150',
            'bet' => 'required',
            'horse_id' => 'required',
        ]);
        $better = new Better();
        $better->fill($request->all());
        return ($better->save() !== 1)
            ? redirect('/betters')->with('status_success', 'Lažybininkas pridėtas!')
            : redirect('/betters')->with('status_error', 'Lažybininkas negali būti pridėtas!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function show(Better $better)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function edit(Better $better)
    {
        $horses = \App\Models\Horse::orderBy('name')->get();
        return view('betters.edit', ['better' => $better, 'horses' => $horses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Better $better)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'surname' => 'required|max:150',
            'bet' => 'required',
            'horse_id' => 'required',
        ]);
        $better->fill($request->all());
        return ($better->save() !== 1)
            ? redirect()->route('betters.index')->with('status_success', 'Lažybininkas paredaguotas!')
            : redirect()->route('betters.index')->with('status_error', 'Lažybininkas negali būti redaguotas!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Better $better)
    {
        $better->delete();
        return redirect('/betters')->with('status_success', 'Lažybininkas ištrintas!');
    }

    public function record($id){
        $better = Better::find($id);
        return view('betters.record', ['better' => $better]);
    }
}
