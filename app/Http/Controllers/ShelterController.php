<?php

namespace App\Http\Controllers;

use App\Models\Shelter;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    public function index()
    {
        $shelters = Shelter::latest()->get();
        return view('shelters.index', compact('shelters'));
    }

    public function create()
    {
        return view('shelters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:shelters',
            'phone'   => 'nullable|string',
            'address' => 'required|string',
            'city'    => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Shelter::create($request->all());
        return redirect()->route('shelters.index')
                         ->with('success', 'Shelter added successfully!');
    }

    public function show(Shelter $shelter)
    {
        return view('shelters.show', compact('shelter'));
    }

    public function edit(Shelter $shelter)
    {
        return view('shelters.edit', compact('shelter'));
    }

    public function update(Request $request, Shelter $shelter)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:shelters,email,' . $shelter->id,
            'phone'   => 'nullable|string',
            'address' => 'required|string',
            'city'    => 'required|string',
        ]);

        $shelter->update($request->all());
        return redirect()->route('shelters.index')
                         ->with('success', 'Shelter updated successfully!');
    }

    public function destroy(Shelter $shelter)
    {
        $shelter->delete();
        return redirect()->route('shelters.index')
                         ->with('success', 'Shelter deleted successfully!');
    }
}