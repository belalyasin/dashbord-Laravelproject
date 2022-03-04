<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialties = Specialty::all();
        return view('cms.specialties.index', ['specialties' => $specialties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cms.specialties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name_en' => 'required|string|min:3 |max:50',
            'name_ar' => 'required|string|min:3 |max:50',
            'active' => 'nullable|string|in:on'
        ]);
        $specialty = new Specialty();
        $specialty->name_en = $request->input('name_en');
        $specialty->name_ar = $request->input('name_ar');
        $specialty->active = $request->has('active');
        $isSaved = $specialty->save();
        if ($isSaved) {
            session()->flash('message', __('messages.creat_success'));
            return redirect()->back();
            //            return redirect()->route('specialties.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function show(Specialty $specialty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialty $specialty)
    {
        //
        return response()->view('cms.specialties.edit', ['specialty' => $specialty]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialty $specialty)
    {
        //
        $request->validate([
            'name_en' => 'required|string|min:3 |max:50',
            'name_ar' => 'required|string|min:3 |max:50',
            'active' => 'nullable|string|in:on',
        ]);
        $specialty->name_en = $request->input('name_en');
        $specialty->name_ar = $request->input('name_ar');
        $specialty->active = $request->has('active');
        $isUpdated = $specialty->save();
        if ($isUpdated) {
            // session()->flash('message', __('messages.update_success'));
            return redirect()->route('specialties.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty)
    {
        //
        $deleted = $specialty->delete();
        return redirect()->back();
    }
}
