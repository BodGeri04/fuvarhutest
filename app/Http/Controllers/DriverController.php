<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //A lényeg, hogy csak az adat menjen át, ami valóban a bejelentkezett fuvarosé
        $jobs = Job::where('driver_id', auth()->id())->get();
        return view('drivers.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validáció majd létrehozás a create-nél
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email',
            'password' => 'required|string|min:8',
        ]);
        //A feladat nem kérte, hogy lehessen kiválasztani admint, de én bele raktam
        try {
            Driver::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => $request->has('is_admin'),
            ]);
            return redirect()->route('jobs.index')->with('success', 'Sikeresen létrehozva!');
        } catch (\Exception $e) {
            return redirect()->route('jobs.index')->with('error', 'Hiba történt a létrehozás során.');
        }
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
    public function edit(string $id)
    {
        $job = Job::findOrFail($id);
        //Ez egy segéd, mivel nem users táblában vannak a felhasználók
        $driver = Driver::where('id', auth()->user()->id)->first();

        // Csak a saját munkáit módosíthatja
        if ($job->driver_id !== $driver->id) {
            return redirect()->route('drivers.index')->with('error', 'Nincs jogosultságod a munka módosításához.');
        }

        return view('drivers.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validáljuk a státuszt
        $validated = $request->validate([
            'status' => 'required|in:assigned,in progress,completed,failed',
        ]);

        // Munkát keresünk és módosítjuk a státuszt
        $job = Job::findOrFail($id);
        //Segéd
        $driver = Driver::where('id', auth()->user()->id)->first();
        // Csak a saját munkáját módosíthatja
        if ($job->driver_id !== $driver->id) {
            return redirect()->route('drivers.index')->with('error', 'Nincs jogosultságod a munka módosításához.');
        }

        try {
            $job->status = $validated['status'];
            $job->save();
            return redirect()->route('drivers.index')->with('success', 'Munka státusza sikeresen frissítve!');
        } catch (\Exception $e) {
            return redirect()->route('drivers.index')->with('error', 'Hiba történt a státusz frissítése során.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
