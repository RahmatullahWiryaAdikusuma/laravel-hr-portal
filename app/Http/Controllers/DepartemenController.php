<?php

namespace App\Http\Controllers;

use App\Models\MasterDepartemen;  
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
     
    public function index()
    {
         
        $departemens = MasterDepartemen::all();
        
        
        return view('admin.departemen.index', compact('departemens'));
    }

   
    public function create()
    {
        return view('admin.departemen.create');
    }

    
    public function store(Request $request)
    {
         
        $request->validate([
            'name' => 'required|string|max:255|unique:master_departemens,name',
        ], [
            'name.required' => 'Nama departemen wajib diisi.',
            'name.unique' => 'Nama departemen sudah ada.'
        ]);

        
        MasterDepartemen::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.departemen.index')
            ->with('success', 'Departemen berhasil ditambahkan.');
    }

     
    public function edit(MasterDepartemen $departemen)
    {
        
        return view('admin.departemen.edit', compact('departemen'));
    }

     
    public function update(Request $request, MasterDepartemen $departemen)
    {
        
        $request->validate([
            'name' => 'required|string|max:255|unique:master_departemens,name,' . $departemen->id,
        ], [
            'name.required' => 'Nama departemen wajib diisi.',
            'name.unique' => 'Nama departemen sudah ada.'
        ]);

        
        $departemen->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.departemen.index')
            ->with('success', 'Departemen berhasil diperbarui.');
    }

     
    public function destroy(MasterDepartemen $departemen)
    {
         
        $departemen->delete();

        return redirect()->route('admin.departemen.index')
            ->with('success', 'Departemen berhasil dihapus.');
    }
}