<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::all();
        return view('admin.hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        return view('admin.hospitals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable',
        ]);

        Hospital::create($request->all());

        return redirect()->route('hospitals.index')->with('success', 'Data rumah sakit berhasil ditambahkan');
    }

    public function edit(Hospital $hospital)
    {
        return view('admin.hospitals.edit', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable',
        ]);

        $hospital->update($request->all());

        return redirect()->route('hospitals.index')->with('success', 'Data rumah sakit berhasil diperbarui');
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();

        return redirect()->route('hospitals.index')->with('success', 'Data rumah sakit berhasil dihapus');
    }
}
