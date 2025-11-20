<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterLowongan;
use App\Models\TransaksiPendaftar;

class GuestController extends Controller
{
    public function index()
    {
        $lowongan = MasterLowongan::with('departemen')->where('is_active', true)->get();
        return view('guest.lowongan.index', compact('lowongan'));
    }

    public function store(Request $request)
    {
         
        $validated = $request->validate([
            'lowongan_id' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'address' => 'required',
            'no_telp' => 'required',
            'university' => 'required',
            'major' => 'required',
            'ipk' => 'required|numeric',
            'cv' => 'required|mimes:pdf|max:2048',  
        ]);

         
        $path = $request->file('cv')->store('cvs', 'public');

        TransaksiPendaftar::create([
            ...$validated,
            'path_cv' => $path,
            'status' => 'P'  
        ]);

        return back()->with('success', 'Lamaran berhasil dikirim!');
    }
}
