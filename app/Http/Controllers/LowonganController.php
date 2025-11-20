<?php

namespace App\Http\Controllers;

use App\Models\MasterLowongan;
use App\Models\MasterDepartemen;  
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongans = MasterLowongan::with('departemen')->get();
        return view('admin.lowongan.index', compact('lowongans'));
    }

     
    public function create()
    {
       
        $departemens = MasterDepartemen::all();
        
         
        return view('admin.lowongan.create', compact('departemens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dept_id' => 'required',
            'posisi' => 'required',
            'quota' => 'required|integer',
            'deskripsi' => 'required',
        ]);

        MasterLowongan::create([
            'dept_id' => $request->dept_id,
            'posisi' => $request->posisi,
            'quota' => $request->quota,
            'deskripsi' => $request->deskripsi,
            'is_active' => true,
            'user_create' => auth()->user()->name,
        ]);

        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil dibuat');
    }

    public function edit(MasterLowongan $lowongan)
    {
         
        $departemens = MasterDepartemen::all();
        return view('admin.lowongan.edit', compact('lowongan', 'departemens'));
    }

    public function update(Request $request, MasterLowongan $lowongan)
    {
        $request->validate([
            'dept_id' => 'required',
            'posisi' => 'required',
            'quota' => 'required|integer',
            'deskripsi' => 'required',
        ]);
 
        $isActive = $request->has('is_active') ? 1 : 0;
         
        if($request->has('is_active')) {
            $isActive = $request->is_active;
        }

        $lowongan->update([
            'dept_id' => $request->dept_id,
            'posisi' => $request->posisi,
            'quota' => $request->quota,
            'deskripsi' => $request->deskripsi,
            'is_active' => $isActive,
            'user_update' => auth()->user()->name,
        ]);

        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil diupdate');
    }

    public function destroy(MasterLowongan $lowongan)
    {
        $lowongan->delete();
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan dihapus');
    }
}