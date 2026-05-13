<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Shelter;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display the sanctuary gallery.
     */
    public function index()
    {
        $pets = Pet::with('shelter')->latest()->get();
        return view('pets.index', compact('pets'));
    }

    /**
     * Show the form for registering a new resident.
     */
    public function create()
    {
        $shelters = Shelter::all();
        return view('pets.create', compact('shelters'));
    }

    /**
     * Store a newly created resident in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'type'            => 'required|string|in:dog,cat,bird,rabbit,other',
            'breed'           => 'nullable|string|max:255',
            'gender'          => 'required|string|in:male,female,unknown',
            'age_months'      => 'nullable|integer|min:0',
            'color'           => 'nullable|string|max:100',
            'description'     => 'nullable|string',
            'status'          => 'required|string|in:available,pending,adopted,unavailable', // FIXED: added proper in: validation
            'shelter_id'      => 'required|exists:shelters,id',
            'is_vaccinated'   => 'nullable|boolean',
            'is_neutered'     => 'nullable|boolean',
            'good_with_kids'  => 'nullable|boolean',
        ]);

        // FIXED: Ensure checkboxes are treated as booleans
        $validated['is_vaccinated'] = $request->has('is_vaccinated');
        $validated['is_neutered']   = $request->has('is_neutered');
        $validated['good_with_kids'] = $request->has('good_with_kids');

        Pet::create($validated);

        return redirect()->route('pets.index')
                         ->with('success', "{$request->name} was successfully welcomed to the sanctuary!");
    }

    /**
     * Display the detailed profile of a resident.
     */
    public function show(Pet $pet)
    {
        $pet->load('shelter');
        return view('pets.show', compact('pet'));
    }

    /**
     * Show the form for editing an existing profile.
     */
    public function edit(Pet $pet)
    {
        $shelters = Shelter::all();
        return view('pets.edit', compact('pet', 'shelters'));
    }

    /**
     * Update the resident's information.
     */
    public function update(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'type'            => 'required|string|in:dog,cat,bird,rabbit,other',
            'breed'           => 'nullable|string|max:255',
            'gender'          => 'required|string|in:male,female,unknown',
            'age_months'      => 'nullable|integer|min:0',
            'color'           => 'nullable|string|max:100',
            'description'     => 'nullable|string',
            'status'          => 'required|string|in:available,pending,adopted,unavailable', // FIXED: added proper in: validation
            'shelter_id'      => 'required|exists:shelters,id',
            'is_vaccinated'   => 'nullable|boolean',
            'is_neutered'     => 'nullable|boolean',
            'good_with_kids'  => 'nullable|boolean',
        ]);

        // FIXED: Process checkboxes
        $validated['is_vaccinated']  = $request->has('is_vaccinated');
        $validated['is_neutered']    = $request->has('is_neutered');
        $validated['good_with_kids'] = $request->has('good_with_kids');

        $pet->update($validated);

        return redirect()->route('pets.index')
                         ->with('success', "The profile for {$pet->name} has been updated.");
    }

    /**
     * Remove a resident from the system.
     */
    public function destroy(Pet $pet)
    {
        $name = $pet->name;
        $pet->delete();

        return redirect()->route('pets.index')
                         ->with('success', "{$name}'s record has been removed from the sanctuary.");
    }
}