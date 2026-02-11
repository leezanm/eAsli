<?php

namespace App\Http\Controllers;

use App\Models\Bahagian;
use Illuminate\Http\Request;

class BahagianController extends Controller
{
    /**
     * Display a listing of the bahagian.
     */
    public function index()
    {
        $bahagians = Bahagian::orderBy('name')->get();
        return view('bahagians.index', compact('bahagians'));
    }

    /**
     * Show the form for creating a new bahagian.
     */
    public function create()
    {
        return view('bahagians.form');
    }

    /**
     * Store a newly created bahagian in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:bahagians,name',
            'code' => 'nullable|string|max:50|unique:bahagians,code',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Bahagian::create($validated);

        return redirect()->route('bahagians.index')
            ->with('success', 'Bahagian berhasil dibuat.');
    }

    /**
     * Display the specified bahagian.
     */
    public function show(Bahagian $bahagian)
    {
        return view('bahagians.show', compact('bahagian'));
    }

    /**
     * Show the form for editing the specified bahagian.
     */
    public function edit(Bahagian $bahagian)
    {
        return view('bahagians.form', compact('bahagian'));
    }

    /**
     * Update the specified bahagian in storage.
     */
    public function update(Request $request, Bahagian $bahagian)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:bahagians,name,' . $bahagian->id,
            'code' => 'nullable|string|max:50|unique:bahagians,code,' . $bahagian->id,
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $bahagian->update($validated);

        return redirect()->route('bahagians.index')
            ->with('success', 'Bahagian berhasil diperbarui.');
    }

    /**
     * Remove the specified bahagian from storage.
     */
    public function destroy(Bahagian $bahagian)
    {
        $bahagian->delete();

        return redirect()->route('bahagians.index')
            ->with('success', 'Bahagian berhasil dihapus.');
    }
}
