<?php

namespace App\Http\Controllers;

use App\Models\AdoptionApplication;
use App\Models\Pet;
use App\Models\Shelter;
use Illuminate\Http\Request;

class AdoptionApplicationController extends Controller
{
    public function index()
    {
        $applications = AdoptionApplication::with(['pet', 'shelter', 'applicant'])
                        ->latest()->get();
        return view('adoptions.index', compact('applications'));
    }

    public function create()
    {
        $pets     = Pet::available()->get();
        $shelters = Shelter::all();
        return view('adoptions.create', compact('pets', 'shelters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pet_id'     => 'required|exists:pets,id',
            'shelter_id' => 'required|exists:shelters,id',
            'reason'     => 'required|string',
            'home_type'  => 'required|string',
        ]);

        $data            = $request->all();
        $data['user_id'] = auth()->id();
        $data['status']  = 'pending';

        AdoptionApplication::create($data);
        return redirect()->route('adoption-applications.index')
                         ->with('success', 'Application submitted!');
    }

    public function show(AdoptionApplication $adoptionApplication)
    {
        return view('adoptions.show', compact('adoptionApplication'));
    }

    public function edit(AdoptionApplication $adoptionApplication)
    {
        return view('adoptions.edit', compact('adoptionApplication'));
    }

    public function update(Request $request, AdoptionApplication $adoptionApplication)
    {
        $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected,cancelled',
        ]);

        if ($request->status === 'approved') {
            $adoptionApplication->approve(auth()->id());
        } elseif ($request->status === 'rejected') {
            $adoptionApplication->reject(auth()->id(), $request->reviewer_notes);
        } else {
            $adoptionApplication->update($request->all());
        }

        return redirect()->route('adoption-applications.index')
                         ->with('success', 'Application updated!');
    }

    public function destroy(AdoptionApplication $adoptionApplication)
    {
        $adoptionApplication->delete();
        return redirect()->route('adoption-applications.index')
                         ->with('success', 'Application deleted!');
    }
}