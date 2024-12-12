<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ha az admin kér egy státuszt, akkor szűrjük a munkákat
        $query = Job::query();

        if ($request->has('status') && in_array($request->status, ['assigned', 'in progress', 'completed', 'failed'])) {
            $query->where('status', $request->status);
        }

        // Alapértelmezett lista: minden munka
        $jobs = $query->get();

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drivers = Driver::all(); // Fuvarozók listája a hozzárendeléshez
        return view('jobs.create', compact('drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validáljuk az adatokat
        $validated = $request->validate([
            'starting_address' => 'required|string|max:255',
            'destination_address' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:15',
            'driver_id' => 'required|exists:drivers,id',
        ]);
        $validated['status'] = 'in progress';
        // Létrehozzuk az új munkát
        Job::create($validated);

        // Visszairányítjuk a felhasználót
        return redirect()->route('jobs.index')->with('success', 'Munka sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Keresi az adott munka rekordját az ID alapján
        $job = Job::findOrFail($id);

        // Fuvarozók listája a hozzárendeléshez
        $drivers = Driver::all();

        // Továbbítja az adatokat a nézethez
        return view('jobs.edit', compact('job', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'starting_address' => 'required|string|max:255',
            'destination_address' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'driver_id' => 'required',
        ]);
        $job->update($request->all());
        return redirect()->route('jobs.index')->with('success', 'Munka sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Munka sikeresen törölve!');
    }
}
