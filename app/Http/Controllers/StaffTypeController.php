<?php

namespace App\Http\Controllers;

use App\Models\StaffType;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class StaffTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('StaffTypes/Index', [
            'filters' => Request::all('search'),
            'staff_types' => StaffType::filter(Request::only('search'))
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('StaffTypes/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        StaffType::create(
            Request::validate([
                'name' => ['required', 'max:100', 'string', Rule::unique('staff_types')],
            ])
        );

        return Redirect::route('staff-types.index')->with('success', 'Type de personnel créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffType $staffType)
    {
        return Inertia::render('StaffTypes/Edit', [
            'staff_type' => [
                'id' => $staffType->id,
                'name' => $staffType->name,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffType $staffType)
    {
        Request::validate([
            'name' => ['required', 'max:50', 'string', Rule::unique('staff_types')->ignore($staffType->id)],
        ]);

        $staffType->update(Request::only('name'));

        return Redirect::route('staff-types.index')->with('success', 'Type de personnel modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffType $staffType)
    {
        $staffType->delete();

        return Redirect::route('staff-types.index')->with('success', 'Type de personnel supprimé avec succès.');
    }
}
